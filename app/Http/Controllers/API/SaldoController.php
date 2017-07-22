<?php

namespace App\Http\Controllers\API;

use App\Helpers\Traits\RupiahFormated;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaldoStore;
use App\Http\Helpers\Transformers\TransactionTransformer;
use App\Models\Saldo;
use DB;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\Transformers\TransactionTransformer;

class SaldoController extends Controller
{
    use RupiahFormated;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $saldo = $user->Saldo->nominal ?? 0;

        $response = [
            'message'       => '',
            'saldo'         => $saldo,
            'saldo_string'  => $this->formatRupiah($saldo),
            'history'       => $this->getHistorySaldo($user->Saldo),
            'status'        => 'OK',
        ];

        return response()->json($response);
    }

    protected function getHistorySaldo(Saldo $saldo)
    {
        return TransactionTransformer::transform($saldo->Transaction);
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
    public function store(SaldoStore $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $reqNominal = $request->nominal;

            $userSaldo = $user->Saldo;

            if (!$userSaldo) {
                $userSaldo = $user->Saldo()->create(['nominal' => 0]);
            }

            $hasUnPaid = $userSaldo->transaction()->create([
                'nominal' => $reqNominal + rand(0, 100),
                'user_id' => $user->id,
                'status'  => false,
            ]);

            $response = [
                'status'    => 'OK',
                'message'   => null,
                'saldo'     => $this->transformUnPaind($hasUnPaid),
            ];

            DB::commit();

            return response()->json($response);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'OK',
                'message'   => $e->getMessage(),
                'saldo'     => null,
            ];

            return response()->json($err, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $userSaldo = $user->Saldo;

            $transaction = $userSaldo->Transaction()->findOrFail($id);

            $response = [
                'status'        => 'OK',
                'message'       => '',
                'transaction'   => $this->transformUnPaind($transaction),
            ];

            return $response;
        } catch (Exception $e) {
            $err = [
                'status'        => 'ERROR',
                'message'       => $e->getMessage(),
                'transaction'   => null,
            ];

            return response()->json($err, 400);
        }
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
    public function destroy($id, Request $request)
    {
        // Admin cancel topup transaction
        //

        $user = $request->user();

        try {
            DB::beginTransaction();

            $userSaldo = $user->Saldo;

            $transaction = $userSaldo->Transaction()->findOrFail($id);

            $transaction->update(['status' => 2]);

            DB::commit();

            $response = [
                'status'        => 'OK',
                'message'       => 'Transaction Canceled',
                'transaction'   => $this->transformUnPaind($transaction),
           ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'        => 'ERROR',
                'message'       => $e->getMessage(),
                'transaction'   => null,
            ];

            return response()->json($err, 400);
        }
    }

    protected function transformUnPaind($trans)
    {
        return [
            'id'                => $trans->id, // mean transaction id,
            'status'            => $trans->status,
            'nominal'           => $trans->nominal,
            'issueDate'         => $trans->updated_at->toW3cString(),
        ];
    }
}
