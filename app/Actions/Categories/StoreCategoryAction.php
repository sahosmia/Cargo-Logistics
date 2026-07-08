<?php

namespace App\Actions\Categories;

use App\Models\Category;

class StoreCategoryAction
{
    public function execute(array $data): Category
    {
        return Category::create($data);
    }
}
