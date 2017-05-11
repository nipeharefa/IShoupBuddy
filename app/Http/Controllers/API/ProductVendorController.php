<?php

namespace App\Http\Controllers\API;

use App\Models\ProductVendor;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Helpers\Transformers\ProductVendorTransformer;
use App\Helpers\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendor = Vendor::find($request->user()->id);

        $data  = [
            "status"    =>  "OK",
            "message"   =>  null,
            "products"  =>  ProductVendorTransformer::transform($vendor->ProductVendor)
        ];

        return response()->json($data, 200);
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
        $data = [
            "product_id"    =>  $request->productID,
            "harga"         =>  $request->price,
            "status"        =>  $request->status ?? 1
        ];


        $vendor = Vendor::find($request->user()->id);


        $firstParam = [
            "product_id"    =>  $request->productID
        ];
        $res = $vendor->ProductVendor()->updateOrCreate($firstParam, $data);

        $productInstance = Product::find($request->productID);

        $response = [
            "status"    =>  "created",
            "product"   =>  ProductTransformer::transform($productInstance),
            "message"   =>  null
        ];

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVendor $productVendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVendor $productVendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVendor $productVendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductVendor  $productVendor
     * @return \Illuminate\Http\Response
     */
    public function destroy($productVendor, Request $request)
    {
        try {

            $productVendor = ProductVendor::findOrFail($productVendor);

            $productVendor->delete();


        } catch (ModelNotFoundException $e) {

        }
    }

    public function restore($productVendor) {
        try {

            $productVendor = ProductVendor::withTrashed()->findOrFail($productVendor);

            $result = $productVendor->restore();

            $response = [
                "status"    =>  "OK",
                "product"   =>  $result,
                "message"   =>  null
            ];
            return response()->json($response, 200);

        } catch (ModelNotFoundException $e) {
            $response = [
                "status"    =>  "OK",
                "product"   =>  $e->getMessage(),
                "message"   =>  null
            ];
            return response()->json($response, 400);
        }
    }
}
