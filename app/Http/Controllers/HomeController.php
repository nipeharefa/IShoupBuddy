<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {

            $user = $request->user();


            return view('pages.me.home.index')
                ->with('user', $user);

        }
        return view('pages.guest.home');
    }
}
