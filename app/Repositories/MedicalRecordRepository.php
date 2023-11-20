<?php

namespace App\Repositories;

use App\Http\Requests\MedicalRecordRequest;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MedicalRecordRepository extends ModelRepository
{
    function __construct(MedicalRecord $mr)
    {
        $this->model = $mr;
    }

    public function create(MedicalRecordRequest $request)
    {
        $path = "/public/medical-records";
        
        $filepath = Storage::put($path, $request->file('medicalrecord'));
        $ext = pathinfo($filepath, PATHINFO_EXTENSION);

        $this->model->create([
            'label' => $request->label,
            'key' => Hash::make($request->key),
            'path' => $filepath,
            'original_extension' => $ext
        ]);

        return true;
    }

    public function update($id, $data)
    {
        
    }

    public function decryptDownload(Request $request)
    {
        $mr = $this->model->findOrFail($request->id);

        if ($mr->key && !$request->key || $mr->key != Hash::check($request->key, $mr->key)) {
            abort(422);
        }

        // medical-records/filename.enc
        if (Storage::disk('public')->missing(substr($mr->path, 7))) {
            abort(404);
        }

        $mr->key = null;
        $mr->save();

        return Storage::url($mr->path);
    }

    public function delete(int $id)
    {
        $mr = $this->model->findOrFail($id);
        Storage::delete($mr->path);
        $mr->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Medical record is deleted successfully.'
        ], 200);
    }

    public function encrypt(Request $request)
    {
        $mr = $this->model->findOrFail($request->id);
        $mr->key = Hash::make($request->key);
        $mr->save();
        return response()->json([
            'status'  => true,
            'message' => 'Medical record is encrypted successfully.'
        ], 200);

    }

    /**
     * Get Datatables Data
     * @return Json Array
     */
    public function datatable()
    {
        $query = MedicalRecord::query();

        if (request()->start_date && request()->end_date) {
            $star_time = strtotime(request()->start_date);
            $end_time = strtotime(request()->end_date);
            $query->whereBetween('created_at', [$star_time, $end_time]);
        }
        return datatables()->of($query)
                ->addColumn('action', function ($data) {
                    $html = view('backend.medical_record._action-dt', ['id' => $data->id, 'page' => 'admin/medical-records', 'permission' => 'admin-user'])->render();
                    return $html;
                })
                ->addColumn('filename', function ($data) {
                    $string = basename($data->path);

                    if (strlen($data->path) > 10) {
                        $string = "..." . substr($data->path, -15);
                    } else {
                        $string = $data->path;
                    }
                    return $string;
                })
                ->editColumn('created_at', function ($data) {
                    return date('d M Y H:i', strtotime($data->created_at));
                })
                ->editColumn('updated_at', function ($data) {
                    return date('d M Y H:i', strtotime($data->updated_at));
                })
                ->editColumn('encryption', function ($data) {
                    return $data->key ? '<span class="badge badge-success">Encrypted</span>' : '<span class="badge badge-warning">Decrypted</span>';
                })
                ->rawColumns(['action', 'label', 'encryption'])
                ->filter(function ($query) {
                    $searchQuery = request()->input('search.value');
                    if (request()->has('search.value') && $searchQuery != null) {
                        $query->orWhere('path', 'like', "%" . $searchQuery . "%");
                    }
                    
                }, true)
                ->make(true);
    }
   
}
