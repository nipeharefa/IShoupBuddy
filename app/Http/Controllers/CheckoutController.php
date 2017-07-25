<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Vendor;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GR;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/home.js');
        $css = mix('css/guest/home.css');

        $view = view('pages.cart.checkout');

        $key = "user_{$user->id}_cart";
        $value = $request->session()->get($key);

        $shipment = $value['shipment'];
        $uLat = $shipment["lat"];
        $uLng = $shipment["lng"];

        $carts = Cart::find($value['cart'])->map(function($item) use ($shipment) {
            return $this->indexCartResponse($item->Vendor, $item, $shipment);
        });

         if ($user) {
            switch ($user->role) {
                case 0:
                    // admin
                    // $js = mix('js/ahome.js');
                    // $css = mix('css/admin/home/index.css');
                    break;
                case 1:
                    // Member
                    $js = mix('js/m-checkout.js');
                    $css = mix('css/m-checkout.css');
                    break;
                default:
                    // Vendor
                    // $js = mix('js/vhome.js');
                    // $css = mix('css/vendor/home.css');
                    break;
            }
        }

        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('css', $css)
                    ->with('cart_data', $carts);
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

    public function getCheckoutSession(Request $request) {

    }

    protected function calculateEstimates($start_lat, $start_lng, $stop_lat, $stop_lng)
    {
        $data = [
            'origin'            => "{$start_lat}, {$start_lng}",
            'destination'       => "{$stop_lat}, {$stop_lng}",
            'departure_time'    => 'now',
            'key'               => 'AIzaSyBcg3GPJhuPxVF5AthpRuiJEFaSt6spA30',
        ];

        $client = new Client();
        $res = $client->request('GET',
            'https://maps.googleapis.com/maps/api/directions/json',
            [ 'query' => $data]);

        // $s = new GR("GET", "https://maps.googleapis.com/maps/api/directions/json", [ 'query' => $data] );
        $response1 = json_decode($res->getBody(), true);

        $distance = $response1["routes"][0]["legs"][0]['distance']['value'];
        $duration = $response1["routes"][0]["legs"][0]['duration']['value'];

        $client = new \Stevenmaguire\Uber\Client(array(
            'access_token' => 'KA.eyJ2ZXJzaW9uIjoyLCJpZCI6IlZrSHQ2OWJoU2NLNXBwOHhjTGpicWc9PSIsImV4cGlyZXNfYXQiOjE1MDM1MTE5NzUsInBpcGVsaW5lX2tleV9pZCI6Ik1RPT0iLCJwaXBlbGluZV9pZCI6MX0.jb_Hh1k9VBXcm9aT2oYz0NFMxVqRHxgwbR36S_fc9RM',
            'server_token' => 'dMcBeMKnz79K9KF2l4X_KorAj8MfEazd8BlVt1aa',
            'use_sandbox'  => true, // optional, default false
            'version'      => 'v1.2', // optional, default 'v1.2'
            'locale'       => 'en_US', // optional, default 'en_US'
        ));

        $estimates = $client->getPriceEstimates(array(
            'start_latitude' => $start_lat,
            'start_longitude' => $start_lng,
            'end_latitude' => $stop_lat,
            'end_longitude' => $stop_lng
        ));

        return [
            "distance"  =>  $distance,
            "duration"  =>  $duration,
            "low_rates" =>  $estimates->prices[0]->low_estimate
        ];
    }

    protected function indexCartResponse(Vendor $vendor, Cart $cart, array $shipment)
    {
        $stop_lat = $shipment["lat"];
        $stop_lng = $shipment["lng"];

        $carts = collect($cart)->except('vendor')->toArray();
        $carts['vendor'] = transform($vendor);
        $carts['item'] = transform($cart->Detail);
        $carts['shipment'] = $this->calculateEstimates($vendor->latitude, $vendor->longitude, $stop_lat, $stop_lng);
        $carts['sub_total'] = $cart->Detail()->sum('price');
        $carts['total'] = $carts['shipment']['low_rates'] + $carts['sub_total'];
        return $carts;
    }
}
