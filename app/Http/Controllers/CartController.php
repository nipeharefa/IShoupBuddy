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
        $title = "Cart";

        $user = $request->user() ?? null;
        $js     = mix('js/home.js');
        $css    = mix('css/guest/home.css');

        $view = view('pages.cart.index');


        $user = $request->user() ?? null;

        if ($user->role) {
            switch ($user->role) {
                case 1:
                    # Member
                    $js     = mix('js/m-cart.js');
                    $css    = mix('css/member/cart.css');
                    break;
                default:
                    # Vendor
                    $js = mix('js/cart.js');
                    $css = mix('css/cart.css');
                    break;
            }
        }

        return $view->with('title', $title)
                    ->with('js', $js)
                    ->with('css', $css);
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
        //
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
        //
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
