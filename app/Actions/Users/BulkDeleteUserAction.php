<?php

namespace App\Actions\Users;

use App\Models\User;

class BulkDeleteUserAction
{
    public function execute(array $ids): int
    {
        return User::whereIn('id', $ids)->delete();
    }
}
