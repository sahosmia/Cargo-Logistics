<?php

namespace App\Actions\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ListUserAction
{
    public function execute(Request $request): LengthAwarePaginator
    {
        $perPage = $request['per_page'] ?? settings('paginated_quantity', 10);

        return User::query()
            ->when($request['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request['role'] ?? null, function ($query, $role) {
                $query->where('role', $role);
            })
            ->when(isset($request['sort']), function ($query) use ($request) {
                $query->orderBy($request['sort'], $request['direction'] ?? 'desc');
            }, function ($query) {
                $query->latest();
            })
            ->paginate($perPage)
            ->withQueryString($request);
    }
}
