<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\TransactionTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransaction;
use App\Models\Saldo;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $with = explode(',', $request->with);

        $user = $request->user();
        $trans = $user->Transaction;

        collect($with)->each(function ($item) use ($trans) {
            switch ($item) {
                case 'd':
                    $trans->load('Detail');
                    break;
                default:
                    break;
            }
        });

        $response = [
            'message'      => null,
            'status'       => 'OK',
            'transactions' => TransactionTransformer::transform($trans),
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
    public function store(StoreTransaction $request)
    {
        $user = $request->user();
        try {
            $cartID = $request->cart_id;

            $cart = $user->Cart()->findOrFail($cartID);

            $saldo = $user->Saldo->nominal ?? 0;

            $lat = $request->lat;

            $lng = $request->lng;

            $shipment = $request->shipment;

            $totalShipment = array_sum($shipment);

            $totalBelanja = $cart->sum(function ($item) {
                return $item->Detail()->sum('price');
            }) + $totalShipment;

            if ($totalBelanja > $saldo) {
                throw new Exception('Saldo tidak cukup', 1);
            }

            if (!$cart->count()) {
                throw new Exception('Cart null', 2011);
            }

            DB::beginTransaction();

            $currenTransactions = $cart->map(function ($cartItem, $index) use ($user, $shipment, $lat, $lng) {
                $shipmentCart = $shipment[$index];
                $data = [
                    'nominal'   => $cartItem->Detail->sum('price') + $shipmentCart,
                    'status'    => 1,
                    'user_id'   => $user->id,
                ];

                $trans = $user->Transaction()->create($data);

                $cartItem->Detail->each(function ($item, $index) use ($trans) {
                    $transactionDetail = [
                        'product_vendor_id' => $item->product_vendor_id,
                        'quantity'          => $item->quantity,
                        'harga'             => $item->ProductVendor->harga,
                        'total'             => $item->price,
                    ];
                    $trans->Detail()->create($transactionDetail);
                });

                $fillable = [
                    'lat'   => $lat,
                    'lng'   => $lng,
                    'price' => $shipmentCart,
                ];
                $trans->TransactionShippment()->create($fillable);
                $cartItem->delete();
                return $trans;
            });

            $this->payWithWallet($totalBelanja, $user);

            DB::commit();

            return transform($currenTransactions->load('Detail'));
        } catch (Exception $e) {
            DB::rollback();

            Log::info($e->getMessage());

            $err = [
                'message'   => $e->getMessage(),
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
    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $user = $request->user();

            $user->Cart()->findOrFail($id);

            $response = [
                'message'   => null,
            ];

            DB::commit();

            return response()->json($response, 204);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'message'   => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    protected function payWithWallet($nominal, User $user)
    {
        $userSaldo = $user->Saldo;

        $hasUnPaid = $userSaldo->transaction()->create([
            'nominal'       => $nominal,
            'user_id'       => $user->id,
            'status'        => true,
            'debit_credit'  => 1,
        ]);

        $userSaldo->nominal -= $nominal;
        $userSaldo->save();
    }

    public function uploadPhotoTopup(Transaction $transaction, Request $request)
    {
        if (!$transaction->type === Saldo::class) {
            return response()->json([], 400);
        }
        $datetime = Carbon::now()->timestamp;
        $filename = "{$transaction->id}_{$datetime}";

        $path = $request->image->storeAs('original', "{$filename}.jpg", 'public');

        $transaction->attachments = $filename.'.jpg';
        $transaction->status = 3;
        $transaction->save();

        $response = [
            'transaction'   => TransactionTransformer::transform($transaction),
        ];

        return response()->json($response);
    }
}
