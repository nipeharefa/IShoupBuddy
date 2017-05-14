<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\Exceptions\GetReviewException;
use App\Http\Controllers\Controller;
use App\Helpers\Sentimen\Stemmer;
use App\Helpers\Sentimen\Sentimen;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use App\Helpers\Transformers\ReviewTransformer;
use App\Models\ProductVendor;
use App\Models\Review;
use DB;
use Illuminate\Contracts\Validation\Validator as ValidatorContracts;
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
    public function index(Request $request)
    {

        $trustedParameters = ['user_id', 'vendor_id', 'product_id'];

        try {

            $checkParameter = collect($request->only($trustedParameters))->filter()->count();

            if (!$checkParameter) {
                throw new GetReviewException("Error Processing Request", 1);
            }
            $review = Review::orderByDesc('created_at');

            if ($request->user_id) {

                $review->whereUserId($request->user_id);
            }


            if ($request->product_id) {

                $id = $request->product_id;
                $review->whereHas('productvendor', function($query) use ($id){
                    return $query->whereProductId($id);
                });
            }

            if ($request->vendor_id) {
                $id = $request->vendor_id;
                $review->whereHas('productvendor', function($query) use ($id){
                    return $query->whereVendortId($id);
                });
            }
            $review = $review->get();
            $total_reviews = $review->count();

            $response = [
                "status"        =>  "OK",
                "message"       =>  null,
                "reviews"       =>  ReviewTransformer::transform($review),
                "total_reviews" =>  $total_reviews,
                "youReview"     =>  new \stdClass()
            ];

            return response()->json($response, 200);

        } catch (Exception $e) {

            if ($e instanceOf GetReviewException) {

                $err = [
                    "status"        =>  "OK",
                    "message"       =>  null,
                    "reviews"       =>  "Check Parameter"
                ];

                return response()->json($err, 400);
            }
        }
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

        $this->validator($request->all());

        $user = $request->user();

        try {

            $review = $user->Review()->findOrFail($id);

            $product_vendor = ProductVendor::whereVendorId($request->vendor_id)
                ->firstOrFail();

            $product_vendor_id = $product_vendor->id;

            DB::beginTransaction();
            $data =  [
                "rating"            =>  $request->rating,
                "body"              =>  $request->body,
                "product_vendor_id" =>  $product_vendor_id
            ];

            $review->update($data);

            $response = [
                "status"    =>  "OK",
                "review"    =>  ReviewTransformer::transform($review),
                "message"   =>  null,
            ];
            DB::commit();
            return $response;

        } catch (Exception $e) {
            DB::rollback();

            $err = [
                "status"    =>  "ERROR",
                "message"   =>  $e->getMessage(),
                "review"    =>  null
            ];

            return response()->json($err, 400);
        }
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

    protected function validator(array $data) {

        $validator = Validator::make($data, [
            'product_id'    =>  'required',
            'vendor_id'     =>  'required',
            'rating'        =>  'required',
            'body'          =>  'required'
        ]);

        return $validator->validate();
    }
}
