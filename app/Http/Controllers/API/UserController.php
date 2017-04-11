<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Helpers\Traits\ApiResponse;
use App\Helpers\Contracts\DefaultAPIResponse;

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


        $update = $user->update($request->all());


        if ($update) {
            
            $response = [
                "status"     => "ok",
                "user"       => $user,
                "message"    => "Akun telah di update"
            ];

            return $this->onSuccess($response);
        }
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
