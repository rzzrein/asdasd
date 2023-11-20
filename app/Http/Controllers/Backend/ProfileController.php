<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProfileRequest;

class ProfileController extends Controller
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('backend.profile.form', compact('user'));
    }

    /**
     * Update Profile
     *
     * @return void
     */
    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        setAlert('success', 'Profile has been updated');

        return redirect('admin/profile');
    }

    /**
     * Handle all AJAX request
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajax(Request $request)
    {
        switch ($request->mode) {
            case 'avatar':
                return $this->user->find($request->id)->avatar;
                break;
        }
    }
}
