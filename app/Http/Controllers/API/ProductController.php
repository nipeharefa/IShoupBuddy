<?php

namespace App\Http\Controllers\API;

use App\Helpers\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Models\Product;
use App\Models\ProductVendor;
use App\Models\Vendor;
use Auth;
use DB;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function __construct(Product $product)
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

        $perPage = $request->perpage ?? 10;
        $page = $request->page ?? 1;

        if (!$request->query('without_filter')) {
            $product->whereHas('productvendor', function ($pv) {
                return $pv;
            });
        }

        if ($request->keyword != null) {
            $product->where('name', 'LIKE',
                "%{$request->keyword}%");
        }

        if ($request->category_id != null) {
            $product->where('category_id', $request->category_id);
        }

        if ($request->vendor_id != null) {
            $id = $request->vendor_id;
            $product->whereHas('productvendortrashed', function ($pv) use ($id) {
                return $pv->where('vendor_id', $id);
            });
        }

        if ($request->query('with')) {
            $with = explode(',', $request->query('with'));

            $product = $product->with(['Review']);
        }

        $options = [];

        $pagination = $product->paginate($perPage, ['*'], 'page', $page);
        // dd();
        $data = [
            'status'    => 'OK',
            'products'  => ProductTransformer::transform($pagination->getCollection(), $options),
            'message'   => null,
            'link'      => [
                'next'  => $pagination->nextPageUrl(),
                'total' => $pagination->lastPage(),
            ],
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {
        // $this->authorize('update', Product::class);

        $user = $request->user();
        $data = $request->toArray();

        $data['slug'] = str_slug($request->name);
        $data['attributes'] = serialize($data['attributes']);

        try {
            DB::beginTransaction();

            if (Product::whereBarcode($request->barcode)->count()) {
                $err = [
                    'status'    => 'OK',
                    'product'   => null,
                    'message'   => 'Duplicate',
                ];

                return response()->json($err, 409);
            }
            $product = Product::create($data);

            DB::commit();

            return ProductTransformer::transform($product, 201);

        } catch (QueryException $e) {
            DB::rollback();

            $err = [
                'status'    => 'OK',
                'product'   => null,
                'message'   => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    protected function createProductVendor(array $data, $product_id, $user)
    {
        $vendor = Vendor::find($user);

        $arr = [
            'product_id'    => $product_id,
            'harga'         => $data['price'],
            'status'        => true,
        ];

        return $vendor->ProductVendor()->updateOrCreate(['product_id' => $product_id, 'vendor_id' => $vendor->id], $arr);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, Request $request)
    {
        if ($request->query('with')) {
            $with = explode(',', $request->query('with'));
            foreach ($with as $key => $value) {
                switch ($value) {
                    case 'review':
                        $product->load('Review');
                        break;
                    default:
                        break;
                }
            }
        }

        $response = [
            'status'    => 'OK',
            'product'   => ProductTransformer::transform($product),
            'message'   => null,
        ];

        return response()->json($response, 200);
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
    public function update(Request $request, Product $product)
    {
        $data = collect($request->all())->filter()->toArray();

        try {
            DB::beginTransaction();
            $data['attributes'] = serialize($data['attributes']);
            $product->update($data);
            $response = [
                'status'    => 'OK',
                'product'   => ProductTransformer::transform($product),
                'message'   => null,
            ];

            DB::commit();

            return response()->json($response, 200);
        } catch (Exception $e) {
            DB::rollback();

            $err = [
                'status'    => 'ERROR',
                'product'   => null,
                'message'   => $e->getMessage(),
            ];

            return response()->json($err, 400);
        }
    }

    public function barcode($barcode)
    {
        try {
            $product = Product::whereBarcode($barcode)->firstOrFail();

            $response = [
                'status'    => 'OK',
                'product'   => ProductTransformer::transform($product),
                'message'   => null,
            ];

            return response()->json($response, 200);
        } catch (ModelNotFoundException $e) {
            $err = [
                'status'    => 'OK',
                'product'   => null,
                'message'   => 'Produk tidak ditemukan',
            ];

            return response()->json($err, 404);
        }
    }

    protected function guard()
    {
        return Auth::guard('api');
    }

    protected function isAdmin()
    {
        $guard = $this->guard()->user();

        if ($guard && $guard->role == 0) {
            return $guard;
        }

        return false;
    }

    public function getGroupRating(Product $product)
    {
        $arr = $product->Review->groupBy(function ($item) {
            return strval(round($item->rating));
        })->map(function ($item) {
            return count($item);
        })->toArray();
        $arr = Arr::wrap($arr);
        for ($i = 1; $i <= 5; $i++) {
            if (!array_key_exists($i, $arr)) {
                $arr[$i] = 0;
            }
        }

        return response()->json($arr, 200);
    }

    public function getNewestProduct(Request $request)
    {
        $perPage = $request->perpage ?? 10;
        $page = $request->page ?? 1;

        $product = Product::whereHas('productvendor', function ($pv) {
                return $pv;
            })->orderByDesc('created_at');

        $pagination = $product->paginate($perPage, ['*'], 'page', $page);

        $repsonse = [
            'messge'        => null,
            'products'      => ProductTransformer::transform($pagination->getCollection()),
            'pagination'    => [
                'prev'  => $pagination->previousPageUrl(),
                'next'  => $pagination->nextPageUrl(),
                'total' => $pagination->lastPage(),
            ],
        ];

        return response()->json($repsonse);
    }

    public function getProductTrending(Request $request)
    {

        $product = Product::withCount('Review')
            ->whereHas('productvendor', function ($pv) {
                return $pv;
            })->orderBy('review_count', 'desc');

        $perPage = $request->perpage ?? 10;
        $page = $request->page ?? 1;

        $pagination = $product->paginate($perPage, ['*'], 'page', $page);

        $repsonse = [
            'messge'        => null,
            'products'      => ProductTransformer::transform($pagination->getCollection()),
            'pagination'    => [
                'prev'  => $pagination->previousPageUrl(),
                'next'  => $pagination->nextPageUrl(),
                'total' => $pagination->lastPage(),
            ],
        ];

        return response()->json($repsonse);
    }
}
