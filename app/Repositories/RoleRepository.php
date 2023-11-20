<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Requests\Backend\UserRequest;
use Yajra\DataTables\EloquentDataTable;

class RoleRepository extends ModelRepository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
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
        $data = Role::active()->get();
        $html = '<select style="width:100%;" id="'.$id.'" name="'.$id.'" '.$additional.'>';
        $html .= '<option value="">-</option>';
        foreach ($data as $row) {
            $select = !empty($selected) && in_array($row->id, $selected) ? 'selected' : '';
            $html .= '<option '.$select.' value="'.$row->id.'">'.$row->name.'</option>';
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
        $datas = $this->model->where('type', 'admin');

        if (request()->has('active')) {
            $datas->whereIn('active', request()->active);
        }

        if (request()->start_date && request()->end_date) {
            $start = request()->start_date . ' 00:00:00';
            $end = request()->end_date . ' 23:59:59';
            $datas->whereBetween('created_at', [$start, $end]);
        }

        $data = datatables()->of($datas)
            ->editColumn('name', function ($data) {
                return $data->name;
            })
            ->editColumn('display_name', function ($data) {
                return $data->display_name;
            })
            ->editColumn('active', function ($data) {
                return $data->active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->editColumn('description', function ($data) {
                return $data->description;
            })
            ->editColumn('created_at', function ($data) {
                return date('d M Y H:i', strtotime($data->created_at));
            })
            ->addColumn('action', function ($data) use ($url) {
                $html = view('backend.layouts._action-dt', ['id' => $data->id, 'page' => 'admin/roles', 'permission' => 'admin-role'])->render();
                return $html;
            })
            ->rawColumns(['action', 'active'])
            ->make(true);
        return $data;
    }

    public function getSelectList($where = null)
    {
        $data = new Role();

        if (is_array($where)) {
            $data = $data->where(array_keys($where)[0], array_values($where)[0]);
        }
        return $data->admin()->orderBy('id')->pluck('name', 'id')->all();
    }
}
