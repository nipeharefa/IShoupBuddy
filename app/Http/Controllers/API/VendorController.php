<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\VendorTransformer;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [
            'status'    => 'OK',
            'vendors'   => VendorTransformer::transform(Vendor::get()),
            'message'   => null,
        ];

        return response()->json($data, 200);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function show($vendor)
    {
        try {
            $result = Vendor::findOrFail($vendor);
            $response = [
                'status'    => 'OK',
                'vendor'    => VendorTransformer::transform($result),
                'message'   => null,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            $response = [
                'status'    => 'OK',
                'vendor'    => null,
                'message'   => 'Vendor tidak ditemukan',
            ];

            return response()->json($response, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Vendor       $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vendor $vendor
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function activate(Request $request)
    {
        $vendor = Vendor::find($request->product_id);

        $vendor->confirmed = true;
        $vendor->save();

        $response = [
            'status'    => 'OK',
            'vendor'    => $vendor,
            'message'   => null,
        ];

        return response()->json($response, 200);
    }

    public function getVendorTransactions(Vendor $vendor, Request $request)
    {
        $range = $request->range ?? 7;

        $labels = [];
        $transactionCounter = [];

        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i)->toDateString();
            array_push($labels, $date);

            $transactions = Transaction::whereHas('Detail', function ($item) use ($vendor) {
                return $item->whereHas('ProductVendor', function ($item) use ($vendor) {
                    return $item->where('vendor_id', $vendor->id);
                });
            })->whereDate('created_at', $date)->count();

            // $transaction = Transaction::whereDate('created_at', $date)
            array_push($transactionCounter, $transactions);
        }

        // $to = Carbon::now();
        // $from = Carbon::now()->subDay()
        //     ->startOfWeek();

        // $transactions = Transaction::whereBetween('created_at', [$from, $to])->get();
        // return $transactions;

        // $transactions = Transaction::whereHas('Detail', function($item) use($vendor)  {
        //     return $item->whereHas('ProductVendor', function($item) use($vendor) {
        //         return $item->where('vendor_id', $vendor->id);
        //     });
        // })->whereBetween('created_at', [$from, $to])->get()
        // ->groupBy(function($data){
        //     return Carbon::parse($data->created_at)->toDateString(); // grouping by years
        // });

        $response = [
            'status'        => 'OK',
            'label'         => $labels,
            'transactions'  => $transactionCounter,
            'message'       => null,
        ];

        return $response;
    }
}
