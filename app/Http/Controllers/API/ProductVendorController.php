<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\ProductTransformer;
use App\Helpers\Transformers\ProductVendorTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductVendor;
use App\Models\Product;
use App\Models\ProductVendor;
use App\Models\Vendor;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

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

        $data = [
            'status'    => 'OK',
            'message'   => null,
            'products'  => ProductVendorTransformer::transform($vendor->ProductVendor),
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductVendor $request)
    {
        try {
            $data = [
                'product_id'    => $request->productID,
                'harga'         => $request->price,
                'status'        => $request->status ?? 1,
            ];

            $vendor = Vendor::find($request->user()->id);

            $firstParam = [
                'product_id'    => $request->productID,
            ];

            DB::beginTransaction();
            $res = $vendor->ProductVendor()->updateOrCreate($firstParam, $data);

            $productInstance = Product::find($request->productID);

            $response = [
                'status'    => 'created',
                'product'   => ProductTransformer::transform($productInstance),
                'message'   => null,
            ];

            DB::commit();

            return response()->json($response, 201);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'message'   => $e->getMessage(),
                'product'   => null,
                'status'    => 'ERROR',
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProductVendor $productVendor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ProductVendor $productVendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProductVendor $productVendor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductVendor $productVendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductVendor       $productVendor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductVendor $productVendor)
    {
        try {
            $user = $request->user();

            DB::beginTransaction();

            $productVendor->update(['harga' =>  $request->price]);

            DB::commit();

            $response = [
                'status'    => 'OK',
                'message'   => null,
                'product'   => ProductVendorTransformer::transform($productVendor),
            ];

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'message'   => $e->getMessage(),
                'status'    => 'ERROR',
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProductVendor $productVendor
     *
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

    public function restore($productVendor)
    {
        try {
            DB::beginTransaction();

            $productVendor = ProductVendor::withTrashed()->findOrFail($productVendor);

            $result = $productVendor->restore();

            $response = [
                'status'    => 'OK',
                'product'   => $result,
                'message'   => null,
            ];

            DB::commit();

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            DB::rollback();

            $response = [
                'status'    => 'OK',
                'product'   => $e->getMessage(),
                'message'   => null,
            ];

            return response()->json($response, 400);
        }
    }
}
