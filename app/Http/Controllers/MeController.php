<?php

namespace App\Http\Controllers;

use App\Helpers\Transformers\ActiveUserTransformer;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function index(Request $request)
    {
        $user = ActiveUserTransformer::transform($request->user());

        return view('pages.me.index')
            ->with('categories', json_encode($this->getViewCategories()))
            ->with('user', json_encode($user));
    }
}
