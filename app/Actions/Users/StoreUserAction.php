<?php

namespace App\Actions\Users;

use App\Models\User;

class StoreUserAction
{
    public function execute(array $data): User
    {
        $roleName = $data['role'] ?? null;
        unset($data['role']);

        $user = User::create($data);

        if ($roleName) {
            $user->assignRole($roleName);
        }

        return $user;
    }
}
