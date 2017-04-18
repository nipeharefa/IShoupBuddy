<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeController extends Controller
{
    public function index(Request $request) {

    	return view('pages.me.index');
    }

    public function edit() {

    	return view('pages.me.edit');

    }

    public function change_password() {

        return view('pages.me.change_password');
    }
}
