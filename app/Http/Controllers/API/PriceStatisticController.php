<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\ProductVendor;
use Carbon\Carbon;
use App\Helpers\Transformers\PricesStatisticTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Log;

class PriceStatisticController extends Controller
{
    public function index(Request $request) {

        $validator = Validator::make($request->all(), [
            'product_id'   =>   'required',
            'vendor_id'    =>   'required'
            ]);

        $range = $request->range ?? 7;

        if ($validator->fails()) {

            $response = [
                "status"    =>  "ERROR",
                "message"   =>  "Missing parameters",
                "statistic" =>  []
            ];

            return response()->json($response, 400);
        }

        try {

            $productVendor = ProductVendor::where('product_id', $request->product_id)
                ->where('vendor_id', $request->vendor_id)->firstOrFail();


            $s = $productVendor->Statistic()->orderByDesc('created_at')->take($range)->get()
                ->reverse()->flatten();

            $s4 = $s->map(function($item){
                return PricesStatisticTransformer::transform($item);
            });

            $response = [
                "status"    =>  "OK",
                "message"   =>  null,
                "statistic" =>  $s4
            ];

            return response()->json($response, 200);

        } catch (ModelNotFoundException $e) {

            $response = [
                "status"    =>  "OK",
                "message"   =>  null,
                "statistic" =>  []
            ];

            return response()->json($response, 200);
        }
    }
}
