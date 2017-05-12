<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Sentimen\Stemmer;
use App\Helpers\Sentimen\Sentimen;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use App\Helpers\Transformers\ReviewTransformer;
use App\Models\ProductVendor;
use App\Models\Review;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Validator;

class ReviewController extends Controller
{
    use SentimenTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Review::orderByDesc('created_at');



        $response = [
            "status"    =>  "OK",
            "message"   =>  null,
            "reviews"   =>  ReviewTransformer::transform($review->get())
        ];

        return $response;
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
        $validator = Validator::make($request->all(), [
            'product_id'    =>  'required',
            'vendor_id'     =>  'required',
            'rating'        =>  'required',
            'body'          =>  'required'
        ]);

        $validator->validate();

        $user = $request->user();
        try {


            $product_vendor = ProductVendor::whereVendorId($request->vendor_id)
                ->firstOrFail();

            $product_vendor_id = $product_vendor->id;


            DB::beginTransaction();

            $data =  [
                "rating"            =>  $request->rating,
                "body"              =>  $request->body,
                "product_vendor_id" =>  $product_vendor_id
            ];

            $result = $user->Review()->create($data);


            $response = [
                "status"    =>  "OK",
                "review"    =>  ReviewTransformer::transform($result),
                "message"   =>  null,
            ];
            DB::commit();
            return $response;

        } catch (Exception $e) {

            DB::rollback();

            $errMessage = $e->getMessage();

            if ($e instanceOf ModelNotFoundException) {

                $errMessage = "Terjadi kesalahan, mohon periksa product_id dan vendor_id";
            }

            $errResponse = [
                "status"    =>  "ERROR",
                "review"    =>  null,
                "message"   =>  $errMessage
            ];
            return response()->json($errResponse, 400);
        }

        return $this->score($request->body);
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
