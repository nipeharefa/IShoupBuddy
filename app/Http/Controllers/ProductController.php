<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        $view = view('pages.product.show');
        $user = $request->user();

        if ($user) {
            switch ($user->role) {
                case 0:
                    $view->with('js', mix('js/a-product_detail.js'));
                    $view->with('css', mix('css/member/product-detail.css'));
                    break;
                case 1:
                    $view->with('js', mix('js/mproduct-detail.js'));
                    $view->with('css', mix('css/member/product-detail.css'));
                    break;
                case 2:
                    $view->with('js', mix('js/v-product_detail.js'));
                    $view->with('css', mix('css/member/product-detail.css'));
                    break;

                default:
                    break;
            }
        } else {
            $view->with('js', mix('js/product_detail.js'));
            $view->with('css', mix('css/guest/product_detail.css'));
        }

        $view->with('title', $product->name)
            ->with('id', $product->id)
            ->with('categories', $this->getViewCategories());
        $view->with('user', $user ? $user->toJson() : json_encode([]));

        return $view;
    }
}
