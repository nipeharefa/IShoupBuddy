<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Cart';

        $user = $request->user() ?? null;
        $js = mix('js/home.js');
        $css = mix('css/guest/home.css');

        $view = view('pages.cart.index');

        $user = $request->user() ?? null;

        if ($user) {
            switch ($user->role) {
                case 1:
                    // Member
                    $js = mix('js/m-cart.js');
                    $css = mix('css/member/cart.css');
                    break;
                default:
                    // Vendor
                    $js = mix('js/cart.js');
                    $css = mix('css/cart.css');
                    break;
            }
        } else {
            return redirect('login');
        }

        return $view->with('title', $title)
                    ->with('js', $js)
                    ->with('css', $css)
                    ->with('categories', $this->getViewCategories())
                    ->with('user', $user);
    }
}
