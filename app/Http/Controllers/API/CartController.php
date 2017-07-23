<?php

namespace App\Http\Controllers\API;

use App\Helpers\Traits\RupiahFormated;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\ProductVendor;
use App\Models\Vendor;
use DB;
use Exception;
use Illuminate\Http\Request;
use Validator;

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
        try {
            $user = $request->user();

            $carts = $user->Cart()->get()->map(function ($c) {
                return $this->indexCartResponse($c->Vendor, $c);
            });

            $totalBelanja = $user->Cart->sum(function ($item) {
                return $item->Detail()->sum('price');
            });

            $response = [
                'carts'         => $carts,
                'message'       => null,
                'status'        => 'OK',
                'total'         => $totalBelanja,
                'total_string'  => $this->formatRupiah($totalBelanja),
            ];

            return response()->json($response);
        } catch (Exception $e) {
            return $e->getMessage();
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
                'product_vendor_id' => 'required',
                'quantity'          => 'nullable|numeric',
            ])->validate();

        $user = $request->user();

        try {
            DB::beginTransaction();

            $productVendor = ProductVendor::findOrFail($request->product_vendor_id);

            $dataCart = [
                'vendor_id'   => $productVendor->Vendor->id,
            ];

            // Create Cart vendor

            $cart = $user->Cart()->updateOrCreate($dataCart);

            $dataCartDetails = [
                'quantity'  => $request->quantity ?? 1,
                'price'     => $request->quantity * $productVendor->harga,
            ];

            $cartDetails = $cart->Detail()->updateOrCreate([
                    'cart_id'           => $cart->id,
                    'product_vendor_id' => $productVendor->id,
                ],
            $dataCartDetails);

            $carts = $this->cartResponse($productVendor->Vendor, $cart);

            $response = [
                'cart'      => $carts,
                'message'   => 'Added',
                'status'    => 'OK',
            ];

            DB::commit();

            return response()->json($response, 201);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'cart'      => null,
                'message'   => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {}

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
        $user = $request->user();

        try {
            DB::beginTransaction();

            Validator::make($request->all(), [
                'quantity'      => 'nullable|numeric',
            ])->validate();

            $data = collect($request->only('quantity'))->filter()->toArray();

            $cart = CartDetail::findOrFail($id);
            $cart->update($data);

            DB::commit();

            $response = [
                'status'    => 'OK',
                'cart'      => CartDetailTransformer::transform($cart),
                'messaage'  => 'updated',
            ];

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => $e->getMessage(),
                'cart'      => null,
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $user->Cart()->findOrFail($id)->delete();

            $response = [
                'status'    => 'OK',
                'message'   => 'Deleted',
            ];
            DB::commit();

            return response()->json($response, 204);
        } catch (Exception $e) {
            DB::rollback();

            $response = [
                'status'    => 'ERROR',
                'message'   => 'Something wrong',
            ];

            return response()->json($response, 400);
        }
    }

    public function indexCartResponse(Vendor $vendor, Cart $cart)
    {
        $carts = collect($cart)->except('vendor')->toArray();
        $carts['vendor'] = transform($vendor);
        $carts['item'] = transform($cart->Detail);

        return $carts;
    }

    protected function cartResponse(Vendor $vendor, Cart $cart)
    {
        $vendor['vendor'] = transform($vendor);
        $vendor['item'] = $cart->Detail;

        return $vendor;
    }

    public function getSubTotalCart(Request $request)
    {
        $totalBelanja = Cart::find($request->arrayIds)->sum(function ($item) {
                return $item->Detail()->sum('price');
        });

        $response = [
            'total'         => $totalBelanja,
            'total_string'  => $this->formatRupiah($totalBelanja)
        ];

        return response()->json($response);
    }
}
