<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                    'name'          => 'required|regex:/^[\pL\s\-]+$/u|max:50|unique:roles,name',
                    'description'   => 'max:100',
                ];
                break;
            case 'PUT':
                return [
                    'name'          => 'required|regex:/^[\pL\s\-]+$/u|max:50|unique:roles,name,'.$id,
                    'description'   => 'max:100',
                ];
                break;
            default:
                return [];
                break;
        }             
    }
}
