<?php

namespace App\Actions\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ListCategoryAction
{
    public function execute(Request $request): LengthAwarePaginator
    {
        $perPage = $request['per_page'] ?? settings('paginated_quantity', 10);

        return Category::query()
            ->when($request['search'] ?? null, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
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
