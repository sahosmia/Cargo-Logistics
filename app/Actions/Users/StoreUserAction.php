<?php

namespace App\Actions\Users;

use App\Models\User;

class StoreUserAction
{
    public function execute(array $data): User
    {
        return User::create($data);
    }
}
