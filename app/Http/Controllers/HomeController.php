<?php

namespace App\Http\Controllers;

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
        $user = $request->user() ?? null;

        $js = mix('js/home.js');
        $css = mix('css/guest/home.css');

        $view = view('pages.home.index');

        if ($user) {
            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/ahome.js');
                    $css = mix('css/admin/home/index.css');
                    break;
                case 1:
                    // Member
                    $js = mix('js/mhome.js');
                    $css = mix('css/member/home.css');
                    break;
                default:
                    // Vendor
                    $js = mix('js/vhome.js');
                    $css = mix('css/vendor/home.css');
                    break;
            }
        }

        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }
}
