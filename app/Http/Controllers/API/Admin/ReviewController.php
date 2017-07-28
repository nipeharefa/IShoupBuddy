<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\Transformers\ReviewTransformer;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = ReviewTransformer::transform(Review::withTrashed()->get());

        $data = [
            'status'    => 'OK',
            'reviews'   => $review,
            'messsage'  => null,
        ];

        return response()->json($data, 200);
    }
}
