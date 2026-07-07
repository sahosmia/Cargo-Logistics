<?php

namespace App\Actions\Categories;

use App\Models\Category;

class BulkDeleteCategoryAction
{
    public function execute(array $ids): int
    {
        return Category::whereIn('id', $ids)->delete();
    }
}
