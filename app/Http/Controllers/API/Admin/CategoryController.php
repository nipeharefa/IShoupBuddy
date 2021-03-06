<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategory;
use App\Models\Category;
use Cache;
use DB;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderByDesc('created_at')->get();

        $response = [
            'status'        => null,
            'categories'    => $category,
            'message'       => null,
        ];

        return response()->json($response, 200);
    }

    public function store(StoreCategory $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only('name');
            $data['picture_url'] = $request->pictureUrl ?? null;

            $category = Category::create($data);

            DB::commit();

            Cache::forget('categories_');
            Cache::remember('categories_', 1000, function () {
                return Category::orderBy('name')->get();
            });

            return response()->json($category, 201);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'message'   => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    public function update(StoreCategory $request, Category $category)
    {
        $data = $request->only('name');

        $category->update($data);

        Cache::forget('categories_');
        Cache::remember('categories_', 1000, function () {
            return Category::orderBy('name')->get();
        });

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        try {
            DB::beginTransaction();

            $category->delete();

            DB::commit();

            Cache::forget('categories_');
            Cache::remember('categories_', 1000, function () {
                return Category::orderBy('name')->get();
            });

            return response()->json($category, 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json($e->getMessage(), 400);
        }
    }
}
