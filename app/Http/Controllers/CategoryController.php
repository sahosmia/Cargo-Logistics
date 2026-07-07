<?php

namespace App\Http\Controllers;

use App\Actions\Categories\BulkDeleteCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\ListCategoryAction;
use App\Actions\Categories\StoreCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request, ListCategoryAction $listCategoryAction)
    {
        $categories = $listCategoryAction->execute($request);

        return Inertia::render('Categories/Index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return Inertia::render('Categories/Create');
    }

    public function store(StoreCategoryRequest $request, StoreCategoryAction $storeCategoryAction)
    {
        $storeCategoryAction->execute($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        return Inertia::render('Categories/Show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $updateCategoryAction)
    {
        $updateCategoryAction->execute($category, $request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category, DeleteCategoryAction $deleteCategoryAction)
    {
        $deleteCategoryAction->execute($category);

        return back()->with('success', 'Category deleted successfully!');
    }

    public function bulkDestroy(Request $request, BulkDeleteCategoryAction $bulkDeleteCategoryAction)
    {
        $bulkDeleteCategoryAction->execute($request->input('ids', []));

        return back()->with('success', 'Categories deleted successfully');
    }
}
