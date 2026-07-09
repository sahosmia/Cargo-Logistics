<?php

namespace App\Actions\Roles;

use Spatie\Permission\Models\Role;

class StoreRoleAction
{
    public function execute(array $data): Role
    {
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $role = Role::create($data);
        $role->syncPermissions($permissions);

        return $role;
    }
}
