<?php

namespace App\Http\Controllers;

use App\Helpers\Transformers\ProductTransformer;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Log;

class CategoryController extends Controller
{
    public function getCategoryProduct($categorySlug, Request $request)
    {
        try {
            $category = Category::whereSlug($categorySlug)->firstOrFail();

            $user = $request->user() ?? null;

            $js = mix('js/g-show-category-product.js');
            $css = mix('css/g-show-category-product.css');

            $product = $category->Product()->whereHas('productvendor', function ($pv) {
                return $pv;
            })->get();
            $data = [
                'category'   => $category,
                'products'   => ProductTransformer::transform($product),
            ];

            $view = view('pages.category.show-product', $data);

            if ($user) {
                switch ($user->role) {
                    case 0:
                        // admin
                        $js = mix('js/a-show-category-product.js');
                        $css = mix('css/g-show-category-product.css');
                        break;
                    case 1:
                        // Member
                        $js = mix('js/m-show-category-product.js');
                        $css = mix('css/g-show-category-product.css');
                        break;
                    default:
                        // Vendor
                        $js = mix('js/v-show-category-product.js');
                        $css = mix('css/g-show-category-product.css');
                        break;
                }
            }

            return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('js', $js)
                    ->with('categories', $this->getViewCategories())
                    ->with('css', $css);
        } catch (ModelNotFoundException $e) {
            Log::info($e->getMessage());

            abort(404);
        }
    }
}
