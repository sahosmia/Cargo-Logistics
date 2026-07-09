<?php

namespace App\Actions\Users;

use App\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $data): bool
    {
        $roleName = $data['role'] ?? null;
        unset($data['role']);

        if ($roleName) {
            $user->syncRoles([$roleName]);
        }

        return $user->update($data);
    }
}
