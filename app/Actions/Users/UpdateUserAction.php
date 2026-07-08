<?php

namespace App\Actions\Users;

use App\Models\User;

class UpdateUserAction
{
    public function execute(User $user, array $data): bool
    {
        return $user->update($data);
    }
}
