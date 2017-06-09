<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;
use App\Models\Product;
use App\Models\Vendor;
use App\Helpers\Transformers\ProductVendorTransformer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = null;

        $user = $request->user();

        try {
            $vendor = Vendor::find($user->id);

            if ($request->type == "own") {

                $product = $vendor->ProductVendor->transform(function($item){

                    return ProductVendorTransformer::transform($item);
                });

            } else {

                $product = transform(Product::get());
            }

            $response = [
                "products"  =>  $product,
                "message"   =>  null,
                "status"    =>  "OK"
            ];

            return response()->json($response);
        } catch (Exception $e) {

            $err = [
                "message"   =>  $e->getMessage()
            ];

            return response()->json($err, 400);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function transformOwnProduct($pv) {

        return [
            "id"    =>  $pv->id,
            "product"   =>  $pv->Product,
            "harga" =>  $pv->harga
        ];
    }
}
