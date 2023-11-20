<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleUser;
use App\Http\Requests\Backend\UserRequest;
use Yajra\DataTables\EloquentDataTable;

class PermissionRepository extends ModelRepository
{
    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    /**
     * Provide select2 role
     *
     * @param   string  $id          Select2's DOM id
     * @param   array   $selected    selected values
     * @param   string  $additional  additional attributes for Select2
     *
     * @return  string
     */
    public function selectBox($id, $selected = array(), $additional = '')
    {
        $data = Role::get();
        $html = '<select style="width:100%;" id="'.$id.'" name="'.$id.'" '.$additional.'>';
        $html .= '<option value="">-</option>';
        foreach ($data as $row) {
            $select = !empty($selected) && in_array($row->id, $selected) ? 'selected' : '';
            $html .= '<option '.$select.' value="'.$row->id.'">'.$row->display_name.'</option>';
        }
        $html .= '</select>';
        return $html;
    }

    /**
     * Get Datatables Data
     *
     * @param   string  $url
     * @param   \Request  $request
     *
     * @return Json Array
     */
    public function datatable($url, $request)
    {
        $search = $request->search;
        $datas = Permission::whereType('admin');

        $data = datatables()->of($datas)
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('display_name', function ($data) {
                return $data->display_name;
            })
            ->editColumn('description', function ($data) {
                return $data->description;
            })
            ->editColumn('created_at', function ($data) {
                return date('d M Y H:i', strtotime($data->created_at));
            })
            ->addColumn('action', function ($data) use ($url) {
                $html = view('backend.layouts._action-dt', ['id' => $data->id, 'page' => 'admin/permissions', 'permission' => 'admin-permission'])->render();
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $data;
    }

    public function getOptions()
    {
        return $this->model->where('type', 'admin')->orderBy('name')
                ->get()->pluck('display_name', 'id');
    }
}
