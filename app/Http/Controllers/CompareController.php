<?php

namespace App\Http\Controllers;

use App\Helpers\Transformers\ProductTransformer;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/g-compare-js.js');
        $css = mix('css/g-compare.css');

        $view = view('pages.compare.index');

        $product = Product::findOrFail($id);
        $product = json_encode(ProductTransformer::transform($product));

        if ($user) {
            switch ($user->role) {
                case 1:
                    // Member
                    $js = mix('js/m-compare.js');
                    $css = mix('css/m-compare.css');
                    break;
                default:
                    break;
            }
        }

        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('product', $product)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }

    public function getResult(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/g-compare-result.js');
        $css = mix('css/g-compare-result.css');

        $view = view('pages.compare.result');

        $source = Product::find($request->source);
        $target = Product::find($request->target);


        $source = json_encode(ProductTransformer::transform($source));
        $target = json_encode(ProductTransformer::transform($target));

        if ($user) {
            switch ($user->role) {
                case 1:
                    // Member
                    $js = mix('js/m-compare-result.js');
                    $css = mix('css/m-compare-result.css');
                    break;
                default:
                    break;
            }
        }

        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('source', $source)
                    ->with('target', $target)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }
}
