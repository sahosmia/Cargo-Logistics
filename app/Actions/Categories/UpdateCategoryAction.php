<?php

namespace App\Actions\Categories;

use App\Models\Category;

class UpdateCategoryAction
{
    public function execute(Category $category, array $data): bool
    {
        return $category->update($data);
    }
}
