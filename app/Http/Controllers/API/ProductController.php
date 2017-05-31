<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\ProductVendor;
use App\Helpers\Transformers\ProductTransformer;
use DB;
use Auth;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Validator;
use Log;

class ProductController extends Controller
{
    function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::orderByDesc('created_at');

        if ($request->keyword != null) {

            $product->where('name', 'LIKE',
                "%{$request->keyword}%");
        }

        if ($request->category_id != null) {

            $product->where('category_id',$request->category_id);
        }

        if ($request->vendor_id != null) {
            $id = $request->vendor_id;
            $product->whereHas('productvendortrashed', function($pv) use ($id) {
                return $pv->where('vendor_id', $id);
            });
        }

        if ($request->query('with')) {

            $with = explode(",", $request->query('with'));

            return $product->with(['review'])->get();

            return 1;
        }

        $options = [];

        $data = [
            "status"    =>  "OK",
            "products"  =>  ProductTransformer::transform($product->get(), $options),
            "message"   =>  NULL
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        // $this->authorize('update', Product::class);

        $user = $request->user();
        $data = $request->toArray();

        $data['slug'] = str_slug($request->name);

        try {

            DB::beginTransaction();

            if (Product::whereBarcode($request->barcode)->count()) {

                $err = [
                    "status"    =>  "OK",
                    "product"   =>  null,
                    "message"   =>  "Duplicate"
                ];

                return response()->json($err, 409);
            }
            $product = Product::create($data);

            DB::commit();

            return $product;

        } catch (QueryException $e) {

            DB::rollback();

            $err = [
                "status"    =>  "OK",
                "product"   =>  null,
                "message"   =>  $e->getMessage()
            ];

            return response()->json($err, 400);

        }

    }

    protected function createProductVendor(array $data, $product_id,  $user) {

        $vendor = Vendor::find($user);

        $arr = [
            'product_id'    =>  $product_id,
            'harga'         =>  $data['price'],
            'status'        =>  true
        ];


        return $vendor->ProductVendor()->updateOrCreate(["product_id" => $product_id, "vendor_id" => $vendor->id], $arr);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        if ($request->barcode) {
            # code...
        }

        // $product = Product::with('Review')->find($product)->first();

        try {

            if ($request->query('with')) {

                $with = explode(",", $request->query('with'));

                foreach ($with as $key => $value) {

                    switch ($value) {
                        case 'review':
                            $this->product = $this->product->with('Review');
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                // // $this->product->with('Review')->find($product)->first();
                // $p = $this->product->find($product)->first();
                // dd($p->relationLoaded('Review'));
            }

            $pro = $this->product->find($product)->first();

            $response = [
                "status"    =>  "OK",
                "product"   =>  ProductTransformer::transform($pro),
                "message"   =>  null
            ];

            return response()->json($response, 200);

        } catch (ModelNotFoundException $e) {

            $err = [
                "status"    =>  "ERROR",
                "product"   =>  [],
                "message"   =>  "Produk tidak ditemukan"
            ];

            return response()->json($err, 404);
        }
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
    public function update(Request $request, Product $product)
    {
        $data = collect($request->all())->filter()->toArray();

        try {
            DB::beginTransaction();

            $product->update($data);
            $response = [
                "status"    =>  "OK",
                "product"   =>  ProductTransformer::transform($product),
                "message"   =>  null
            ];

            DB::commit();

            return response()->json($response, 200);

        } catch (Exception $e) {

            DB::rollback();

            $err = [
                "status"    =>  "ERROR",
                "product"   =>  null,
                "message"   =>  $e->getMessage()
            ];
            return response()->json($err, 400);

        }
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

    public function barcode($barcode) {

        try {

            $product = Product::whereBarcode($barcode)->firstOrFail();

            $response = [
                "status"    =>  "OK",
                "product"   =>  ProductTransformer::transform($product),
                "message"   =>  null
            ];

            return response()->json($response, 200);

        } catch (ModelNotFoundException $e) {

            $err = [
                "status"    =>  "OK",
                "product"   =>  null,
                "message"   =>  "Produk tidak ditemukan"
            ];

            return response()->json($err, 404);
        }
    }

    protected function guard() {

        return Auth::guard('api');

    }

    protected function isAdmin() {

        $guard = $this->guard()->user();

        if ($guard && $guard->role == 0) {

            return $guard;
        }

        return false;
    }
}
