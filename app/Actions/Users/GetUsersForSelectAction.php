<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Support\Collection;

class GetUsersForSelectAction
{
    public function execute(): Collection
    {
        return User::orderBy('name')->get(['id', 'name']);
    }
}
