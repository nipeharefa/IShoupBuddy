<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Transformers\ActiveUserTransformer;

class MeController extends Controller
{
    public function index(Request $request) {

        $user = ActiveUserTransformer::transform($request->user());
    	return view('pages.me.index')
            ->with('user', json_encode($user));
    }

    public function edit(Request $request) {

        $user = ActiveUserTransformer::transform($request->user());
    	return view('pages.me.edit')
            ->with('user', json_encode($user));

    }

    public function change_password() {

        return view('pages.me.change_password');
    }
}
