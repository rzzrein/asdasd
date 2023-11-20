<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\Backend\RoleRequest;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    protected $roleRepository;
    protected $permissionRepository;


    function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPerm('admin-role-index', true);
        return view('backend.role.index');
    }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPerm('admin-role-create', true);
        $permissions = $this->permissionRepository->getOptions();
        return view('backend.role.form', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        checkPerm('admin-role-create', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $requests = $request->all();
        $requests['active'] = empty($requests['active']) ? 0 : 1;
        $role = $this->roleRepository->createNew($requests, true);
        $role->permissions()->sync($request->permission_id);
        setAlert('success', 'Role is created successfully');
        return redirect('admin/roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPerm('admin-role-update', true);
        $role = $this->roleRepository->with(['permissions'])->findOrFail($id);
        $permissions = $this->permissionRepository->getOptions();
        return view('backend.role.form', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        checkPerm('admin-role-update', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $requests = $request->all();
        $requests['active'] = empty($requests['active']) ? 0 : 1;
        $role = $this->roleRepository->updateById($id, $requests, true);
        $role->permissions()->sync($request->permission_id);
        setAlert('success', 'Role is updated successfully');
        return redirect('admin/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPerm('admin-role-delete', true);
        $this->roleRepository->deleteById($id);
        return response()->json([
            'status'  => true,
            'message' => 'Role is deleted successfully.'
        ], 200);

    }

    /**
     * Handle all AJAX request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'datatable':
                return $this->roleRepository->datatable('role', $request);
                break;
            case 'options':
                return $this->roleRepository->getOptions($request);
                break;
        }
    }
}
