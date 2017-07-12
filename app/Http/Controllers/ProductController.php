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
                case 1:
                    $view->with('js', mix('js/mproduct-detail.js'));
                    $view->with('css', mix('css/member/product-detail.css'));
                    break;

                default:
                    break;
            }
        } else {
            $view->with('js', mix('js/product_detail.js'));
            $view->with('css', mix('css/guest/product_detail.css'));
        }

        $view->with('title', $product->name);
        $view->with('id', $product->id);
        $view->with('user', $user ? $user->toJson() : json_encode([]));

        return $view;
    }
}
