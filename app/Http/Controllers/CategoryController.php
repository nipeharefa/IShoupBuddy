<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;
use App\Helpers\Transformers\ProductTransformer;

class CategoryController extends Controller
{
    public function getCategoryProduct($categorySlug, Request $request)
    {
        try {

            $category = Category::whereSlug($categorySlug)->firstOrFail();

            $user = $request->user() ?? null;

            $js = mix('js/g-show-category-product.js');
            $css = mix('css/g-show-category-product.css');

            $data = [
                "category"  =>  $category,
                "products"   =>  ProductTransformer::transform($category->Product)
            ];

            $view = view('pages.category.show-product', $data);


            if ($user) {
                switch ($user->role) {
                    case 0:
                        // admin
                        $js = mix('js/a-show-category-product.js');
                        $css = mix('css/admin/home/index.css');
                        break;
                    case 1:
                        // Member
                        $js = mix('js/mhome.js');
                        $css = mix('css/member/home.css');
                        break;
                    default:
                        // Vendor
                        $js = mix('js/vhome.js');
                        $css = mix('css/vendor/home.css');
                        break;
                }
            }

            return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('css', $css);

        } catch (ModelNotFoundException $e) {
            Log::info($e->getMessage());

            abort(404);
        }
    }
}
