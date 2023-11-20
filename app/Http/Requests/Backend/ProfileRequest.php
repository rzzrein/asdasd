<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'full_name' => 'required',
            'email'     => 'required|unique:users,email,'.auth()->user()->id,
            'username'  => 'unique:users,username,'.auth()->user()->id
        ];
        if (!empty($this->password)) {
            $rules['password'] =['required', 'string', 'min:8', 'confirmed'];
        }
        return $rules;
    }
}
