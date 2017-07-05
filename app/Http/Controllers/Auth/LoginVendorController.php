<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginVendorController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm(Request $request)
    {
        return view('pages.vendor.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->firstOrFail();

            if (!$user->confirmed) {
                throw new ModelNotFoundException("Error Processing Request", 1);
            }

            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);

                return $this->sendLockoutResponse($request);
            }

            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } catch (ModelNotFoundException $e) {
            $err = [
                "status"    =>  "OK",
                "message"   =>  "Invalid Login"
            ];
            return response()->json($err, 401);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        $data = [
            "err"   =>  "OK",
            "user"  =>  "user",
            "message"   =>  null
        ];
        return response()->json($data, 200);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $data = [
            "err"       =>  "OK",
            "user"      =>  null,
            "message"   =>  "Invalid Login"
        ];
        return response()->json($data, 401);
    }

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
        $data['role'] = 2;
        return $data;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return response()->json([], 204);
    }
}
