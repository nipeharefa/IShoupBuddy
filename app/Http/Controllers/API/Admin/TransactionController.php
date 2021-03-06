<?php

namespace App\Http\Controllers\API\Admin;

use App\Helpers\Transformers\DetailTransactionTransformer;
use App\Helpers\Transformers\TransactionTransformer;
use App\Http\Controllers\Controller;
use App\Models\Saldo;
use App\Models\Transaction;
use DB;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transaction = Transaction::orderByDesc('updated_at')->get();
        $response = [
            'transactions'  => TransactionTransformer::transform($transaction),
            'message'       => null,
            'status'        => 'OK',
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
    public function show(Transaction $transaction)
    {
        $response = [
            'status'        => 'OK',
            'message'       => null,
            'transaction'   => DetailTransactionTransformer::transform($transaction),
        ];

        return response()->json($response);
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

    public function approve(Transaction $transaction, Request $request)
    {
        if ($transaction->transactable_type === Saldo::class) {
            return $this->approveSaldo($transaction);
        } else {
            return response()->json($this->approveTransaction($transaction), 200);
        }
    }

    protected function approveTransactionBiasa(Transaction $transaction, Request $request)
    {
        return $transaction;
    }

    protected function approveTransaction(Transaction $transaction)
    {
        try {
            $saldo = $transaction->Saldo;
            DB::beginTransaction();

            // Update Transaction to Success
            $transaction->update(['status' => 1]);

            DB::commit();

            return transform($transaction);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => $e->getMessage(),

            ];

            return response()->json($err, 400);
        }
    }

    protected function approveSaldo(Transaction $transaction)
    {
        try {
            $saldo = $transaction->Saldo;
            DB::beginTransaction();

            // Update Transaction to Success
            $transaction->update(['status' => 1]);

            // Update saldo
            $saldo->nominal += $transaction->nominal;
            $saldo->save();
            DB::commit();

            return transform($transaction);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => $e->getMessage(),

            ];

            return response()->json($err, 400);
        }
    }

    protected function getType($model)
    {
        $reflector = new \ReflectionClass($model);

        return $reflector->getShortName();
    }

    public function cancelTopUp(Transaction $transaction)
    {
        try {
            DB::beginTransaction();
            // Update Transaction to Success
            $transaction->update(['status' => 4]);
            DB::commit();

            return transform($transaction);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'message'   => $e->getMessage(),

            ];

            return response()->json($err, 400);
        }
    }
}
