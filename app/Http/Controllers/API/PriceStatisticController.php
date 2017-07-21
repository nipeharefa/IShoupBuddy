<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\PricesStatisticTransformer;
use App\Http\Controllers\Controller;
use App\Models\ProductVendor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

class PriceStatisticController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required',
            'vendor_id'    => 'required',
            ]);

        $range = $request->range ?? 7;

        if ($validator->fails()) {
            $response = [
                'status'    => 'ERROR',
                'message'   => 'Missing parameters',
                'statistic' => [],
            ];

            return response()->json($response, 400);
        }

        try {
            $productVendor = ProductVendor::where('product_id', $request->product_id)
                ->where('vendor_id', $request->vendor_id)->firstOrFail();

            $s = $productVendor->Statistic()->orderByDesc('updated_at')->take($range)->get()
                ->reverse()->flatten();

            $s4 = $s->map(function ($item) {
                return PricesStatisticTransformer::transform($item);
            });

            $response = [
                'status'    => 'OK',
                'message'   => null,
                'statistic' => $s4,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            $response = [
                'status'    => 'OK',
                'message'   => $e->getMessage(),
                'statistic' => [],
            ];

            return response()->json($response, 200);
        }
    }

    public function all(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id'   => 'required',
            ]);

        $range = $request->range ?? 7;

        if ($validator->fails()) {
            $response = [
                'status'    => 'ERROR',
                'message'   => 'Missing parameters',
                'statistic' => [],
            ];

            return response()->json($response, 400);

        }

         $productVendor = ProductVendor::where('product_id', $request->product_id)
                ->get()->transform(function($item) use ($range) {

                    $data = $item->Statistic()->select('harga')
                                    ->orderByDesc('updated_at')
                                    ->take($range)->get()->reverse()->flatten();
                    return [
                        'label' =>  $item->Vendor->name,
                        "data" =>  collect($data)->map(function($item){
                            return $item->harga;
                        })
                    ];
                });

         return $productVendor;
    }

    protected function transformDate($c) {

        return $c['updated_at']->format('d/m/y');
    }

    protected function transformHarga($c) {

    }
}
