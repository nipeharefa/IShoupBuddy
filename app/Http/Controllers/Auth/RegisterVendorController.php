<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterVendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->toArray())->validate();

        $data = $request->toArray();
        $user = $this->create($data);

        $response = [
            'status'    => 'OK',
            'user'      => $user,
            'message'   => null,
        ];

        return response()->json($response, 201);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
                'name'      => 'required|max:255',
                'email'     => 'required|email|max:255|unique:users',
                'password'  => 'required',
                'phone'     => 'required',
            ]);
    }

    protected function validateEmail($email)
    {
        return true;
    }

    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'phone'     => $data['phone'],
            'confirmed' => false,
            'role'      => 2,
        ]);
    }
}
