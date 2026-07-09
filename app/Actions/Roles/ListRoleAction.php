<?php

namespace App\Actions\Roles;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ListRoleAction
{
    public function execute(Request $request)
    {
        return Role::with('permissions')
            ->latest()
            ->paginate(settings('paginated_quantity', 10));
    }
}
