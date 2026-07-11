<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ValidatesRoleAttributes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    use ValidatesRoleAttributes;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $role = $this->route('role');
        $roleId = is_object($role) ? $role->id : $role;

        return $this->roleAttributeRules($roleId);
    }

    public function messages(): array
    {
        return $this->roleAttributeMessages();
    }
}
