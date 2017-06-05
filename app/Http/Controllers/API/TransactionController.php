<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Exception;

use App\Helpers\Transformers\TransactionTransformer;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $with = explode(",", $request->with);

        $user = $request->user();
        $trans = $user->Transaction;

        collect($with)->each(function($item) use ($trans) {
            switch ($item) {
                case 'd':
                    $trans->load('Detail');
                    break;
                default:
                    break;
            }
        });

        $response = [
            "message"   =>  null,
            "status"    =>  "OK",
            "transactions" => TransactionTransformer::transform($trans)
        ];

        return response()->json($response, 200);
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
        $user  = $request->user();
        try {

            $cart = $user->Cart;

            $saldo = $user->Saldo->nominal ?? 0;

            $total_belanja = $cart->sum(function($item){
                    return $item->quantity * $item->harga;
                });

            if ($total_belanja > $saldo) {
                throw new Exception("Saldo tidak cukup", 1);
            }

            if (!$cart->count()) {
                throw new Exception("Cart null", 2011);
            }
            DB::beginTransaction();

            // Transaction
            $data = [
                "nominal"   =>  $total_belanja,
                "status"    =>  0,
                "user_id"   =>  $user->id
            ];

            $trans = $user->Transaction()->create($data);

            $cart->each(function($item) use ($trans) {

                $data =  collect($item)->toArray();
                $trans->Detail()->create($data);
                $item->delete();
            });

            DB::commit();
            return transform($trans->load('Detail'));


        } catch (Exception $e) {
            DB::rollback();

            $err = [
                "message"   =>  $e->getMessage()
            ];

            return response()->json($err, 400);
        }
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
