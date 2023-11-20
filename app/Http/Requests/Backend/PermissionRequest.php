<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'         => 'required|max:50|unique:permissions',
                    'display_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:50'],
                    'description'  => 'max:50',
                ];
                break;
            case 'PUT':
                return [
                    'name'         => "required|max:50|unique:permissions,name,{$this->id}",
                    'display_name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:50'],
                    'description'  => 'max:50',
                ];
                break;
            default:
                return [];
                break;
        }
    }
}
