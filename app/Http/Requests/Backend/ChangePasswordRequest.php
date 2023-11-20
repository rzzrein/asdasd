<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OldPassword;

class ChangePasswordRequest extends FormRequest
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
        if (!empty($this->password) || !empty($this->old_password)) {
            return [
                'old_password' => new OldPassword,
                'password'     => 'required|min:6|confirmed'
            ];
        }
        return [];
    }
}
