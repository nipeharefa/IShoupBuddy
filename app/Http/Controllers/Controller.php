<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getViewCategories()
    {
        $categories = Cache::remember('categories_', 1000, function () {
            return Category::orderBy('name')->get();
        });

        return $categories;
    }
}
