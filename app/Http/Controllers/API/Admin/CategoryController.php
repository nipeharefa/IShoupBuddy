<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\CategoryController as BaseCategoryController;
use App\Models\Category;

class CategoryController extends BaseCategoryController
{
    public function store(Request $request)
    {
        $data = $request->only('name');

        $category = Category::create($data);

        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->only('name');

        $category->update($data);

        return response()->json($category, 200);

    }
}
