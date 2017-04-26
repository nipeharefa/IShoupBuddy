<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\Vendor;

class RegisterVendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function register (Request $request) {

        $validator = $this->validator($request->toArray());

        if ($validator->fails()) {
            return 1;
        }

        $data = $request->toArray();
        return $this->create($data);
    }

    protected function validator(array $data) {

        return Validator::make($data, [
                'name'      =>  'required',
                'email'     =>  'required',
                'password'  =>  'required',
                'phone'     =>  'required'
            ]);
    }

    protected function validateEmail($email){

        return true;
    }

    protected function create(array $data)
    {
        return Vendor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'confirmed' =>  false
        ]);
    }
}
