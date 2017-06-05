<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Helpers\Transformers\CartTransformer;
use App\Models\ProductVendor;
use Exception;
use DB;
use App\Helpers\Traits\RupiahFormated;

class CartController extends Controller
{
    use RupiahFormated;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user =  $request->user();

        $carts_total = $user->Cart->sum(function ($product) {
                    return $product->harga;
                });

        $response = [
            "data"  =>  "OK",
            "message"   =>  null,
            "carts"     =>  [
                "items" =>  CartTransformer::transform($user->Cart),
                "total" =>  $carts_total,
                "total_strings" => $this->formatRupiah($carts_total)
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

            DB::beginTransaction();

            $product_vendor = ProductVendor::whereProductId($request->product_id)
                ->whereVendorId($request->vendor_id)->firstOrFail();

            $data = [
                "product_vendor_id"   =>  $product_vendor->id,
                "quantity"  =>  $request->quantity ?? 1,
                "harga"     =>  $request->quantity * $product_vendor->harga
            ];

            $cart = $user->Cart()->updateOrCreate([
                    'product_vendor_id' =>  $product_vendor->id,
                    "identify_id"       =>  $user->id
                ], $data);

            DB::commit();

            $response = [
                "status"    =>  "OK",
                "cart"      =>  CartTransformer::transform($cart),
                "message"   =>  "Cart added"
            ];

            return response()->json($response, 201);

        } catch (Exception $e) {

            DB::rollback();

            $err = [
                "status"    =>  "ERROR",
                "cart"      =>  null,
                "message"  =>   $e->getMessage()
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

        $user = $request->user();

        try {
            DB::beginTransaction();

            Validator::make($request->all(), [
                'quantity'      =>  'nullable|numeric'
            ])->validate();


            $data = collect($request->only('quantity'))->filter()->toArray();

            $cart = $user->Cart()->findOrFail($id);
            $cart->update($data);

            DB::commit();

            $response = [
                "status"    =>  "OK",
                "cart"      =>  CartTransformer::transform($cart),
                "messaage"  =>  "updated"
            ];

            return response()->json($response);

        } catch (Exception $e) {

            DB::rollback();

            $err = [
                "status"    =>  "ERROR",
                "message"   =>  $e->getMessage(),
                "cart"      =>  null
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        try {

            DB::beginTransaction();

            $user->Cart()->findOrFail($id)->delete();

            $response = [
                "status"    =>  "OK",
                "message"   =>  "Deleted"
            ];
            DB::commit();

            return response()->json($response, 204);

        } catch (Exception $e) {
            DB::rollback();

            $response = [
                "status"    =>  "ERROR",
                "message"   =>  "Something wrong"
            ];

            return response()->json($response, 400);
        }
    }
}
