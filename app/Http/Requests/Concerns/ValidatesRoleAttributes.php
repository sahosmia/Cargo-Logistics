<?php

namespace App\Http\Requests\Concerns;

trait ValidatesRoleAttributes
{
    /**
     * @return array<string, mixed>
     */
    protected function roleAttributeRules(?int $roleId = null): array
    {
        return [
            'name' => 'required|string|unique:roles,name'.($roleId ? ",{$roleId}" : ''),
            'permissions' => 'nullable|array',
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function roleAttributeMessages(): array
    {
        return [
            'name.required' => 'Role name is required',
            'name.unique' => 'This role name has already been taken',
        ];
    }
}
