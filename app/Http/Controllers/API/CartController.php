<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Helpers\Transformers\CartTransformer;
use App\Models\ProductVendor;
use Exception;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user =  $request->user();

        $response = [
            "data"  =>  "OK",
            "message"   =>  null,
            "carts"     =>  [
                "items" =>  CartTransformer::transform($user->Cart),
                "total" =>  $user->Cart->sum(function ($product) {
                    return $product->quantity * $product->ProductVendor->harga;
                }),
                "total_strings" =>  ""
            ]
        ];

        return response()->json($response);
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
        Validator::make($request->all(), [
                'product_id'    =>  'required',
                'vendor_id'     =>  'required',
                'quantity'      =>  'nullable|numeric'
            ])->validate();

        $user = $request->user();
        try {

            $product_vendor = ProductVendor::whereProductId($request->product_id)
                ->whereVendorId($request->vendor_id)->firstOrFail();

            $data = [
                "product_vendor_id"   =>  $product_vendor->id,
                "quantity"  =>  $request->quantity ?? 1
            ];

            $cart = $user->Cart()->create($data);


            $response = [
                "status"    =>  "OK",
                "cart"      =>  CartTransformer::transform($cart),
                "message"   =>  "Cart added"
            ];

            return response()->json($response, 201);

        } catch (Exception $e) {

            $err = [
                "status"    =>  "ERROR",
                "cart"      =>  null,
                "message"  =>   "Cek input"
            ];

            return response()->json($err, 400);
        }

        // return $user->Cart()->create(['product_vendor_id' => $request->product_id]);
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
}
