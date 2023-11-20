<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Http\Requests\Backend\PermissionRequest;
use Facades\App\Repositories\PermissionRepository;

class PermissionController extends Controller
{
    function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        checkPerm('admin-permission-index', true);
        return view('backend.permission.index');
    }

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPerm('admin-permission-create', true);
        return view('backend.permission.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        checkPerm('admin-permission-create', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $requests = $request->all();
        $this->permission->createNew($requests, true);
        setAlert('success', 'Permission is created successfully');
        return redirect('admin/permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPerm('admin-permission-update', true);
        $item = $this->permission->findOrFail($id);
        return view('backend.permission.form', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        checkPerm('admin-permission-update', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $requests = $request->all();
        $this->permission->updateById($id, $requests, true);
        setAlert('success', 'Permission is updated successfully');
        return redirect('admin/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPerm('admin-permission-delete', true);
        $this->permission->deleteById($id);
        return response()->json([
            'status'  => true,
            'message' => 'Permission is deleted successfully.'
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
                return PermissionRepository::datatable('permission', $request);
                break;
            case 'options':
                return PermissionRepository::getOptions($request);
                break;
        }
    }
}
