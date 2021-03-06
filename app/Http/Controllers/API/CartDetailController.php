<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Vendor;
use DB;
use Exception;
use Illuminate\Http\Request;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
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
    public function update(Request $request, Cart $cart, CartDetail $id)
    {
        try {
            DB::beginTransaction();

            $cartDetail = $id;

            $data['quantity'] = $request->quantity ?? $cartDetail->quantity;
            $data['price'] = $data['quantity'] * $cartDetail->ProductVendor->harga;

            $cartDetail->update($data);

            DB::commit();

            $response = [
                'cart'      => $this->cartResponse($cart->Vendor, $cart),
                'message'   => null,
                'status'    => 'OK',
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status'    => 'ERROR',
                'message'   => 'Something wrong',
            ];

            return response()->json($response, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cart $cart, CartDetail $id)
    {
        try {
            DB::beginTransaction();

            if ($cart->Detail->count() <= 1) {
                $cart->delete();
            } else {
                $id->delete();
            }

            DB::commit();

            return response()->json([], 204);
        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status'    => 'ERROR',
                'message'   => 'Something wrong',
            ];

            return response()->json($response, 400);
        }
    }

    protected function cartResponse(Vendor $vendor, Cart $cart)
    {
        $vendor['vendor'] = transform($vendor);
        $vendor['item'] = $cart->Detail;

        return $vendor;
    }

    public function updateQuantity(CartDetail $id, Request $request)
    {
        $id->quantity = $request->quantity;
        $id->price = $request->quantity * $id->ProductVendor->harga;
        $id->save();

        return $id;
    }
}
