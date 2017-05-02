<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\Traits\ApiResponse;
use App\Helpers\Contracts\DefaultAPIResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;
use Hash;

class UserController extends Controller implements DefaultAPIResponse
{
    use ApiResponse;

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

        $a = User::find($id);

        $validator = Validator::make($request->all(), [
                'name'      =>  'required',
                'gender'    =>  'required|boolean'
            ]);

        $validator->validate();

        $dataUpdate = [
            "name"      =>  $request->name,
            "gender"    =>  $request->gender
        ];


        $update = $user->update($dataUpdate);


        if ($update) {

            $response = [
                "status"     => "OK",
                "user"       => $user,
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function change_password(Request $request) {

        $user = $request->user();


        $validator = Validator::make($request->toArray(),[
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
}
