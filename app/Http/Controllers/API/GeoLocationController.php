<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // return $request->all();
        $data = [
            'origin'            => "{$request->origin_lat},%20{$request->origin_lng}",
            'destination'       => "{$request->dest_lat}, {$request->dest_lng}",
            'departure_time'    => 'now',
            'key'               => 'AIzaSyBcg3GPJhuPxVF5AthpRuiJEFaSt6spA30',
        ];

        $client = new Client();
        $res = $client->request('GET',
            'https://maps.googleapis.com/maps/api/directions/json',
            ['query' => [
                    'destination'       => "{$request->origin_lat}, {$request->origin_lng}",
                    'origin'            => "{$request->dest_lat}, {$request->dest_lng}",
                    'departure_time'    => 'now',
                    'key'               => 'AIzaSyBcg3GPJhuPxVF5AthpRuiJEFaSt6spA30',
                ],
            ]);

        $response1 = json_decode($res->getBody(), true);

        // dd($res);
        return response()->json($response1);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
