<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicalRecordRequest;
use App\Repositories\MedicalRecordRepository;
use Illuminate\Support\Facades\Storage;

class MedicalRecordController extends Controller
{

    function __construct(private MedicalRecordRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.medical_record.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.medical_record.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MedicalRecordRequest $r)
    {
        $this->repository->create($r);
        setAlert('success', 'Medical record successfully encrypted');
        return redirect('/admin/medical-records');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->repository->delete($id);
    }

    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'datatable':
                return $this->repository->datatable();
                break;
            case 'decrypt-download':
                return $this->repository->decryptDownload($request);
                break;
            case 'encrypt':
                return $this->repository->encrypt($request);
                break;
            default:
                break;
        }
        
    }
}
