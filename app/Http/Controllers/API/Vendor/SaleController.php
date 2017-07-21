<?php

namespace App\Http\Controllers\API\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseApiController;
use Carbon\Carbon;
use App\Models\Vendor;
use Log;
use Colors\RandomColor;
use App\Models\ProductVendor;

class SaleController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $range = $request->range ?? 7;

        $vendor = Vendor::find($this->getUser()->id);

        $carbon = Carbon::now();
        $labels = [];
        for ($i = 1; $i <= $range; $i++) {
            $carbon->subDays(1);
            array_push($labels, $carbon->format('d/m/y'));
        }

        $labels = array_reverse($labels);

        $stats = $vendor->ProductVendor->map(function($item) use ($range){

            $data['label'] = $item->Product->name;
            $data['id'] = $item->id;
            $data['backgroundColor'] = RandomColor::one(['format' => 'hex', 'luminosity' => 'random']);
            $c = [];
            $carbon = Carbon::now();
            for ($i = 1; $i <= $range; $i++) {

                $a = $item->TransactionDetail()
                    ->whereDate('created_at', $carbon->toDateString())
                    ->count();
                $carbon->subDays(1);
                array_push($c, $a);
            }
            $data['data'] = array_reverse($c);
            return $data;

        });

        $response = [
            "sales" =>  [
                "labels"    =>  $labels,
                "datasets" =>  $stats
            ]
        ];

        return response()->json($response);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = ProductVendor::find($id);
        $range = $request->range ?? 7;
        $carbon = Carbon::now();
        $labels = [];
        for ($i = 1; $i <= $range; $i++) {
            $carbon->subDays(1);
            array_push($labels, $carbon->format('d/m/y'));
        }


        $data['label'] = $item->Product->name;
        $data['id'] = $item->id;
        $data['backgroundColor'] = RandomColor::one(['format' => 'hex', 'luminosity' => 'random']);
        $c = [];
        $carbon = Carbon::now();
        for ($i = 1; $i <= $range; $i++) {

            $a = $item->TransactionDetail()
                ->whereDate('created_at', $carbon->toDateString())
                ->count();
            $carbon->subDays(1);
            array_push($c, $a);
        }
        $data['data'] = array_reverse($c);

        $response = [
            "sales" =>  [
                "labels"   =>  $labels,
                "datasets" =>  [$data]
            ]
        ];

        return response()->json($response);

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
