<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helpers\Transformers\ProductTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Validator;

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

        if ($request->keyword != null) {

            $product->where('name', 'LIKE',
                "%{$request->keyword}%");
        }

        if ($request->category_id != null) {

            $product->where('category_id',$request->category_id);
        }

        $data = [
            "status"    =>  "OK",
            "products"  =>  ProductTransformer::transform($product->get()),
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

        $validator = Validator::make($request->all(), [
            'barcode'       =>  'required|unique:products,barcode',
            'name'          =>  'required',
            'picture_url'   =>  'required',
            'description'   =>  'required',
            'category_id'   =>  'required'
        ]);

        $validator->validate();

        $data = $request->toArray();
        $data['slug'] = str_slug($request->name);
        $product = Product::create($data);

        return $product;

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
