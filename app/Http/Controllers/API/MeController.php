<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\ActiveUserTransformer;
use App\Http\Controllers\BaseApiController as Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $this->getUser();

        return ActiveUserTransformer::transform($user);
    }
}
