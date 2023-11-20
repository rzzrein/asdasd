<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Requests\Backend\UserRequest;
use Yajra\DataTables\EloquentDataTable;
use Facades\App\Support\ImageUploader;
use Illuminate\Http\Request;

class UserRepository extends ModelRepository
{
    function __construct(User $user, ImageRepository $imageRepository, Role $role)
    {
        $this->imageRepository = $imageRepository;
        $this->model = $user;
        $this->role = $role;
    }

    /**
     * Get Datatables Data
     * @return Json Array
     */
    public function datatable()
    {
        $appRoles = $this->model->getAppRoles();
        $data = User::query();

        if (request()->has('active')) {
            $data->whereIn('active', request()->active);
        }

        if (request()->start_date && request()->end_date) {
            $start = strtotime(request()->start_date . ' 00:00:00');
            $end = strtotime(request()->end_date . ' 23:59:59');
            $data->whereBetween('created_at', [$start, $end]);
        }

        // TEMP filter
        // ->where('type', '!=', 'customer')->orWhereNull('type');
        return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    $html = view('backend.layouts._action-dt', ['id' => $data->id, 'page' => 'admin/users', 'permission' => 'admin-user'])->render();
                    return $html;
                })
                ->editColumn('role_array', function ($data) {
                    return implode(', ', $data->role_array);
                })
                ->editColumn('active', function ($data) {
                    return $data->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->editColumn('created_at', function ($data) {
                    return date('d M Y H:i', strtotime($data->created_at));
                })
                ->editColumn('updated_at', function ($data) {
                    return date('d M Y H:i', strtotime($data->updated_at));
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
    }

    /**
     * Get role array of a user
     *
     * @param   User::id  $id  User's ID
     *
     * @return  array
     */
    public function getRoleArray($id)
    {
        $existing_role = User::findOrFail($id);
        $arr = [];
        if ($existing_role->roles) {
            foreach ($existing_role->roles as  $value) {
                $arr[] = $value->id;
            }
        }
        return $arr;
    }

    public function getAppRoles()
    {
        return $this->role->whereIn('name', ['customer', 'seller'])
            ->get()->pluck('id', 'name');
    }
}
