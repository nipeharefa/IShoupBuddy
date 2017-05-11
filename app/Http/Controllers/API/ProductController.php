<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\ProductVendor;
use App\Helpers\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Validator;
use Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $product = Product::orderByDesc('created_at');


        if (!$request->query('without_filter')) {
            $product->whereHas('productvendor', function($pv){
                return $pv;
            });
        }

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
    public function store(Request $request)
    {
        // $this->authorize('update', Product::class);

        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'barcode'       =>  'required',
            'name'          =>  'required',
            'picture_url'   =>  'required',
            'description'   =>  'required',
            'category_id'   =>  'required'
        ]);

        $validator->validate();

        $data = $request->toArray();
        $data['slug'] = str_slug($request->name);

        try {

            $product = Product::create($data);

            if ($user->role == 2) {


                $product_vendor = $this->createProductVendor($data, $product->id, $user->id);

                $response = [
                    "status"    =>  "OK",
                    "product"   =>  $product,
                    "message"   =>  null
                ];
            }

            return $product;

        } catch (QueryException $e) {

            $product = Product::whereBarcode($request->barcode)->first();

            if ($user->role == 2) {

                return $this->createProductVendor($data, $product->id, $user->id);
            }

            $err = [
                "status"    =>  "OK",
                "product"   =>  null,
                "message"   =>  "Duplicate Error"
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
    public function show($id, Request $request)
    {
        if ($request->barcode) {
            # code...
        }

        try {

            $product = Product::findOrFail($id);


            $response = [
                "status"    =>  "OK",
                "product"   =>  ProductTransformer::transform($product),
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
}
