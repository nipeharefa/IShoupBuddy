<?php

namespace App\Http\Controllers\API;

use App\ProductVendor;
use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Helpers\Transformers\ProductVendorTransformer;

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
        //
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
    public function destroy(ProductVendor $productVendor)
    {
        //
    }
}
