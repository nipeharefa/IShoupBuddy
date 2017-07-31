<?php

namespace App\Http\Controllers;

use App\Helpers\Transformers\ProductTransformer;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
