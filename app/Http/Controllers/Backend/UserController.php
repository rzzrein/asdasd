<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Http\Requests\Backend\UserRequest;
use Facades\App\Repositories\UserRepository;
use Facades\App\Repositories\RoleRepository;

class UserController extends Controller
{
    function __construct(User $user, Role $role, RoleUser $role_user)
    {
        $this->user = $user;
        $this->role = $role;
        $this->role_user = $role_user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // checkPerm('admin-user-index', true);
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        checkPerm('admin-user-create', true);
        $roles = RoleRepository::getSelectList();
        return view('backend.user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        checkPerm('admin-user-create', true);
        $requests = $request->all();
        $requests['password'] = bcrypt($requests['password']);
        $requests['active'] = empty($requests['active']) ? 1 : 1;
        $requests['email_verified_at'] = time();
        $user = UserRepository::createNew($requests, true);
        $this->user->refreshRoles($user->id, /*$request->get('role_id')*/ 1);

        setAlert('success', 'User successfully created');
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        checkPerm('admin-user-show', true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        checkPerm('admin-user-update', true);
        $roles = RoleRepository::getSelectList();
        $item = $this->user->findOrFail($id);
        return view('backend.user.form', compact('item', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        checkPerm('admin-user-update', true);
        if (!$request->validated()) {
            return back()->withError();
        }
        $requests = $request->all();
        if ($request->get('password') == '') {
            unset($requests['password']);
        } else {
            $requests['password'] = bcrypt($requests['password']);
        }
        $requests['active'] = empty($requests['active']) ? 0 : 1;
        $save = UserRepository::updateById($id, $requests, true);
        UserRepository::refreshRoles($id, $request->get('role_id'));

        if ($save) {
            setAlert('success', 'User has been updated');
        } else {
            setAlert('warning', 'Failed to update user');
        }

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPerm('admin-user-delete', true);
        UserRepository::deleteById($id, true);
        return response()->json([
            'status'  => true,
            'message' => 'User is deleted successfully.'
        ], 200);
    }

    /**
     * Ajax Request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'datatable':
                return UserRepository::datatable();
                break;
        }
    }
}
