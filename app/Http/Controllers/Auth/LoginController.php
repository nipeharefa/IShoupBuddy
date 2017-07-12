<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function loginViaAjax(Request $request)
    {
        return $this->login($request);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([], 204);
        }

        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        $links = '/';

        switch ($user->role) {
            case 0:
                $links = '/admin/product';
                break;
            case 1:
                $links = '/';
                break;
            default:
                $links = '/vendor/product';
                break;
        }
        if ($request->expectsJson()) {
            return [
                'message'       => '',
                'status'        => 'OK',
                'user'          => $user,
                'redirect_to'   => $links,
            ];
        }

        return 1;
    }
}
