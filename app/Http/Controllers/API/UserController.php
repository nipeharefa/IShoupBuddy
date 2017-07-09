<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\Traits\ApiResponse;
use App\Helpers\Contracts\DefaultAPIResponse;
use App\Helpers\Transformers\ActiveUserTransformer;
use App\Helpers\Traits\RupiahFormated;
use App\Models\Cart;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Hash;
use Validator;

class UserController extends Controller implements DefaultAPIResponse
{
    use ApiResponse, RupiahFormated;

    /**
     * Get User Acccount Settings
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = [
            "status"    => "ok",
            "user"      =>  $request->user(),
            "message"   => null
        ];


        return $this->onSuccess($response, 200);
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
        $user = $request->user();


        $validator = Validator::make($request->all(), [
                'name'          =>  'required',
                'gender'        =>  'required',
                'picture_url'   =>  'nullable',
                'address'       =>  'required',
                "latitude"     =>  "nullable",
                "longitude"     =>  "nullable",
            ]);

        $validator->validate();

        $dataUpdate = [
            "name"          =>  $request->name,
            "picture_url"   =>  $request->picture_url,
            "gender"        =>  $request->gender,
            "address"       =>  $request->address,
            "latitude"     =>  $request->latitude ?? null,
            "longitude"     =>  $request->longitude ?? null
        ];


        if ($request->file('picture_url') && $request->file('picture_url')->isValid()) {
            $filename = str_random(20) . ".jpg";

            $path = $request->picture_url->storeAs('original', $filename, 'public');

            $dataUpdate['picture_url'] = $filename;
        }

        $dataUpdate = collect($dataUpdate)->filter(function ($item) {
            return ($item != null || $item != '');
        })->toArray();


        $update = $user->update($dataUpdate);


        if ($update) {
            $response = [
                "status"     => "OK",
                "user"       => ActiveUserTransformer::transform($user),
                "message"    => "Akun telah di update"
            ];

            return $this->onSuccess($response);
        }


        $response = [
            "status"     => "ERROR",
            "user"       => null,
            "message"    => "Gagal memperbaharui data pengguna"
        ];

        return $this->onFailure($response, 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);

            $response = [
                "status"    => "ok",
                "user"      => $user,
                "message"   => null
            ];

            return $this->onSuccess($response);
        } catch (ModelNotFoundException $e) {
            $response = [
                "status"    => "ERROR",
                "user"      => null,
                "message"   => "Pengguna tidak ditemukan"
            ];

            return $this->onFailure($response, 404);
        }
    }
    public function update(Request $request, $id)
    {
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

    public function change_password(Request $request)
    {
        $user = $request->user();


        $validator = Validator::make($request->toArray(), [
            'current_password'      => 'required',
            'password'              => 'required|confirmed'
        ]);

        $validator->validate();

        if (Hash::check($request->current_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $response = [
                "status"    =>  "OK",
                "message"   =>  "Password berhasil dipeerbaharui"
            ];

            return response()->json($response, 200);
        }

        $err = [
            "status"    =>  "ERROR",
            "message"   =>  "Current password error"
        ];

        return response()->json($err, 400);
    }

    public function getWishlisht(User $user, Request $request)
    {
        return $user;
    }

    public function getUserSaldo(User $user, Request $request)
    {}

    public function getUserCart(User $user, Request $request)
    {
        try {

            $carts = $user->Cart()->get()->map(function ($c) {
                return $this->indexCartResponse($c->Vendor, $c);
            });

            $totalBelanja = $user->Cart->sum(function ($item) {
                return $item->Detail()->sum('price');
            });

            $response = [
                "carts"         =>  $carts,
                "message"       =>  null,
                "status"        =>  "OK",
                "total"         =>  $totalBelanja,
                "total_string"  =>  $this->formatRupiah($totalBelanja),
            ];

            return response()->json($response);

        } catch (Exception $e) {

            $response = [
                "status"    =>  "ERROR"
            ];

            return response()->json($response, 400);
        }
    }

    public function indexCartResponse(Vendor $vendor, Cart $cart)
    {
        $carts = collect($cart)->except('vendor')->toArray();
        $carts['vendor'] = transform($vendor);
        $carts["item"] = transform($cart->Detail);
        return $carts;
    }

    public function getUserCartCounter(User $user, Request $request)
    {
        try {

            $counter = $user->cart->sum(function($item){
                return count($item->Detail);
            });
            $response = [
                "cart"  =>  $counter
            ];
            return response()->json($response, 200);

        } catch (Exception $e) {

        }
    }
}
