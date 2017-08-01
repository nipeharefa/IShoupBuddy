<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseApiController;
use App\Models\TransactionShippment;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Transformers\TransactionTransformer;

class TransactionShipmentController extends BaseApiController
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
        //
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

    public function postAcceptShipment(TransactionShippment $id)
    {
        $this->authorize('update', $id);

        try {
            DB::beginTransaction();

            $id->accepted_at = Carbon::now();
            $id->save();
            DB::commit();

            $trans = $id->Transaction->load('Detail');

            $response = [
                "status"        =>  "OK",
                "transaction"   =>  TransactionTransformer::transform($trans),
                "message"       =>  null
            ];

            return response()->json($response);

        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['err' => $e->getMessage()], 400);
        }
    }
}
