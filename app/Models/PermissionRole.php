<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id', 'role_id'
    ];

    public function getMatrix()
    {
        $arr = [];
        $data = Self::all();
        foreach ($data as  $value) {
            $arr[$value->permission_id.'-'.$value->role_id] = $value->role_id;
        }
        return $arr;
    }

    public function setPermissionRole(Request $request)
    {
        $role = Role::findOrFail($request->get('role_id'));
        if ($request->get('state')=='1') {
            # attach role
            return $role->permissions()->attach([$request->get('permission_id')]);
        } else {
            # detach role
            return $role->permissions()->detach([$request->get('permission_id')]);
        }
    }
}
