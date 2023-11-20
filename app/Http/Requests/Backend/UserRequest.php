<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id ?? null;
        switch ($this->method()) {
            case 'POST':
                return [
                    'username' => 'nullable|alpha_num|max:255|unique:users,username',
                    'email'   => 'required|email|max:255|unique:users,email',
                    'full_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
                    'password'   => ['required', 'min:8', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*(_|[^\w]))\S+$/'],
                    'role_id' => 'required',
                ];
                break;
            case 'PUT':
                return [
                    'username' => 'nullable|alpha_num|max:255|unique:users,username'.($id ? ','.$id : ''),
                    'email' => 'required|email|max:255|unique:users,email'.($id ? ','.$id : ''),
                    'full_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
                    'password' => ['min:8', 'regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*(_|[^\w]))\S+$/'],
                    'role_id' => 'required',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
