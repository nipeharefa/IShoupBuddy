<?php

namespace App\Http\Controllers\API;

use App\Helpers\Exceptions\GetReviewException;
use App\Helpers\Sentimen\Sentimen;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use App\Helpers\Transformers\ReviewTransformer;
use App\Http\Controllers\Controller;
use App\Models\ProductVendor;
use App\Models\Review;
use Auth;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
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

        $user = Auth::guard('api')->user();

        $sortBy = $request->sortBy ?? 'created_at';
        $sortOrder = 'desc';

        $perPage = $request->perpage ?? 10;
        $page = $request->page ?? 1;

        try {
            $checkParameter = collect($request->only($trustedParameters))->filter()->count();

            $youReview = null;

            if (!$checkParameter) {
                throw new GetReviewException('Error Processing Request', 1);
            }

            switch ($request->order) {
                case 'rate_high':
                    $review = Review::orderBy('rating', 'desc');
                    break;
                case 'rate_low':
                    $review = Review::orderBy('rating', 'asc');
                    break;
                default:
                    $review = Review::orderBy('updated_at', 'desc');
                    break;
            }

            if ($request->user_id) {
                $review->whereUserId($request->user_id);
            } else {
                if ($user && $request->user_id != $user->id) {
                    // $review->where('user_id', '!=', $user->id);

                    $id = $user->id;
                    $product_id = $request->product_id ?? null;

                    $youReview = Review::whereUserId($id);

                    if ($product_id) {
                        $youReview->whereHas('productvendor', function ($item) use ($product_id) {
                            return $item->where('product_id', $product_id);
                        });
                    }

                    $youReview = $youReview->first();
                }
            }

            if ($request->product_id) {
                $id = $request->product_id;
                $review->whereHas('productvendor', function ($query) use ($id) {
                    return $query->whereProductId($id);
                });
            }

            if ($request->vendor_id) {
                $id = $request->vendor_id;
                $review->whereHas('productvendor', function ($query) use ($id) {
                    return $query->whereVendorId($id);
                });
            }

            $review = $review->get();
            $total_reviews = $review->count();

            $reviewTransform = collect(ReviewTransformer::transform($review));

            switch ($request->groupBy) {
                case 'product':
                    $reviewTransform = $reviewTransform->groupBy('product.id');
                    break;
                default:
                    // code...
                    break;
            }

            $summaryAvg = [
                'pos'   => collect($reviewTransform)->avg('sentimen.pos'),
                'neg'   => collect($reviewTransform)->avg('sentimen.neg'),
                'neu'   => collect($reviewTransform)->avg('sentimen.neu'),
            ];

            $response = [
                'status'         => 'OK',
                'message'        => null,
                'reviews'        => $reviewTransform,
                'total_reviews'  => $total_reviews,
                'average_review' => Review::avg('rating'),
                'summary'        => array_search(max($summaryAvg), $summaryAvg, true),
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            if ($e instanceof GetReviewException) {
                $err = [
                    'status'        => 'OK',
                    'message'       => null,
                    'reviews'       => 'Check Parameter',
                ];

                return response()->json($err, 400);
            }

            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'    => 'required',
            'vendor_id'     => 'required',
            'rating'        => 'required',
            'body'          => 'required',
        ]);

        $validator->validate();

        $user = $request->user();

        try {

            // Search ProductVendor
            $product_vendor = ProductVendor::whereVendorId($request->vendor_id)
                ->whereProductId($request->product_id)
                ->firstOrFail();

            $product_vendor_id = $product_vendor->id;

            DB::beginTransaction();

            $data = [
                'rating'            => $request->rating,
                'body'              => $request->body,
                'product_vendor_id' => $product_vendor_id,
            ];

            $result = $user->Review()->updateOrCreate(['product_vendor_id' => $product_vendor_id], $data);

            $response = [
                'status'    => 'OK',
                'review'    => ReviewTransformer::transform($result),
                'message'   => null,
            ];
            DB::commit();

            return response()->json($response, 201);
        } catch (Exception $e) {
            DB::rollback();

            $errMessage = $e->getMessage();

            if ($e instanceof ModelNotFoundException) {
                $errMessage = 'Terjadi kesalahan, mohon periksa product_id dan vendor_id';
            }

            $errResponse = [
                'status'    => 'ERROR',
                'review'    => null,
                'message'   => $errMessage,
            ];

            return response()->json($errResponse, 400);
        }

        return $this->score($request->body);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->all());

        $user = $request->user();

        try {
            $review = $user->Review()->findOrFail($id);

            $product_vendor = ProductVendor::whereVendorId($request->vendor_id)
                ->whereProductId($request->product_id)
                ->firstOrFail();

            $product_vendor_id = $product_vendor->id;

            DB::beginTransaction();

            $data = [
                'rating'            => $request->rating,
                'body'              => $request->body,
                'product_vendor_id' => $product_vendor_id,
            ];

            $review->update($data);

            $response = [
                'status'    => 'OK',
                'review'    => ReviewTransformer::transform($review),
                'message'   => null,
            ];

            DB::commit();

            return $response;
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => $e->getMessage(),
                'review'    => null,
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            Review::findOrFail($id)->delete();

            DB::commit();

            $response = [
                'status'    => 'OK',
                'message'   => 'deleted',
            ];

            return response()->json($response, 204);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => 'Something Wrong',
                'dev'       => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    public function checkReview(Request $request)
    {
        $trustedParameters = ['user_id', 'vendor_id', 'product_id'];

        $user = Auth::guard('api')->user();

        try {
            $checkParameter = $request->only($trustedParameters);
            // Search ProductVendor
            $product_vendor = ProductVendor::whereVendorId($request->vendor_id)
                ->whereProductId($request->product_id)
                ->firstOrFail();

            $product_vendor_id = $product_vendor->id;

            $review = Review::whereProductVendorId($product_vendor_id)->whereUserId($user->id)->firstOrFail();

            $response = [
                'status'    => 'OK',
                'review'    => ReviewTransformer::transform($review),
                'message'   => null,
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();

            $errMessage = $e->getMessage();

            if ($e instanceof ModelNotFoundException) {
                $errResponse = [
                    'status'    => 'ERROR',
                    'review'    => null,
                    'message'   => $errMessage,
                ];

                return response()->json($errResponse, 404);
            }

            $errResponse = [
                'status'    => 'ERROR',
                'review'    => null,
                'message'   => $errMessage,
            ];

            return response()->json($errResponse, 400);
        }
    }

    public function restore($id, Request $request)
    {
        try {
            DB::beginTransaction();

            Review::withTrashed()->findOrFail($id)->restore();

            DB::commit();

            $response = [
                'status'    => 'OK',
                'message'   => 'Restored',
            ];

            return response()->json($response, 204);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => 'Something Wrong',
                'dev'       => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'product_id'    => 'required',
            'vendor_id'     => 'required',
            'rating'        => 'required',
            'body'          => 'required',
        ]);

        return $validator->validate();
    }
}
