<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaldoStore;
use DB;
use Exception;

class SaldoController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaldoStore $request)
    {
        $user = $request->user();

        try {

            DB::beginTransaction();

            $reqNominal = $request->nominal;

            $userSaldo = $user->Saldo;

            // Create Polifyl
            if (!$userSaldo) {

                $user->Saldo()->create(['nominal' => 0]);
            }


            $hasUnPaid = $userSaldo->getUnPaid()->first();

            if ($hasUnPaid) {

                $hasUnPaid->update(['nominal' => 1000]);



            } else {

                $hasUnPaid =  $userSaldo->getUnPaid()
                    ->create(['nominal' => 1, 'user_id' => $user->id, 'status' => false]);
            }


            $response = [
                "status"    =>  "OK",
                "message"   =>  null,
                "saldo"     =>  $this->transformUnPaind($hasUnPaid)
            ];

            return response()->json($response);

            DB::commit();

        } catch (Exception $e) {

            DB::rollback();

            $err = [
                "status"    =>  "OK",
                "message"   =>  $e->getMessage(),
                "saldo"     =>  null
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

    protected function transformUnPaind($trans) {

        return [
            "id"        =>  $trans->id, // mean transaction id,
            "status"    =>  $trans->status ? "Paid" : "Unpaid",
            "nominal"   =>  $trans->nominal,
            "issueDate" =>  $trans->updated_at->toW3cString()
        ];
    }
}
