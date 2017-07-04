<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\CategoryController as BaseCategoryController;
use App\Models\Category;
use App\Http\Requests\StoreCategory;
use DB;
use Exception;

class CategoryController extends BaseCategoryController
{
    public function store(StoreCategory $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('name');
            $data['picture_url'] = $request->pictureUrl ?? null;

            $category = Category::create($data);

            DB::commit();

            return response()->json($category, 201);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                "message"   =>  $e->getMessage()
            ];

            return response()->json($err, 400);
        }
    }

    public function update(StoreCategory $request, Category $category)
    {
        $data = $request->only('name');

        $category->update($data);

        return response()->json($category, 200);
    }
}
