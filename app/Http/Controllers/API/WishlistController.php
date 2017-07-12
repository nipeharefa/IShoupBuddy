<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\WishlistTransformer;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Validator;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $data = [
            'status'    => 'OK',
            'wishlist'  => WishlistTransformer::transform($user->Wishlist),
            'message'   => null,
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
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->toArray(), [
            'product_id'    => 'required',
        ]);

        $validator->validate();

        try {
            Product::findOrFail($request->product_id);

            $wish = $user->Wishlist()->updateOrCreate(['product_id' => $request->product_id]);

            $response = [
                'status'    => 'OK',
                'wishlist'  => $wish,
                'message'   => null,
            ];

            return response()->json($response, 201);
        } catch (QueryException $e) {
            $err = [
                'status'    => 'ERROR',
                'wishlist'  => null,
                'message'   => 'Terjadi kesalahan saat menyimpan data wishlist.',
            ];

            return response()->json($err, 500);
        } catch (ModelNotFoundException $e) {
            $err = [
                'status'    => 'ERROR',
                'wishlist'  => null,
                'message'   => 'Data product tidak ditemukan',
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
    {
        //
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
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        $deleted = $user->Wishlist()->delete($id);

        $response = [
            'status'       => 'OK',
            'wish'         => null,
            'message'      => 'Berhasil dihapus',
        ];

        return response()->json($response, 204);
    }
}
