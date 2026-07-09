<?php

namespace App\Actions\Roles;

use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public function execute(Role $role, array $data): bool
    {
        $permissions = $data['permissions'] ?? [];
        unset($data['permissions']);

        $role->syncPermissions($permissions);

        return $role->update($data);
    }
}
