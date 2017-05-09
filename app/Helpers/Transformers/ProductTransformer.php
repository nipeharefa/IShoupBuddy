<?php


namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;
use Auth;

class ProductTransformer extends AbstractTransformer {


    public function transformModel(Model $product){

        $secure = env('APP_ENV') == "production";

        $arr = [
            "id"            =>  $product->id,
            "name"          =>  $product->name,
            "category"      =>  $product->Category,
            "barcode"       =>  (double)$product->barcode,
            "picture_url"   =>
            [
                "small"     =>  url('/image/small', $product->picture_url, $secure),
                "medium"    =>  url('/image/medium', $product->picture_url, $secure),
                "large"     =>  url('/image/large', $product->picture_url, $secure),
            ],
            "description"   =>  "",
            "vendors"       =>  ProductVendorTransformer::transform($product->ProductVendor),
            "total_review"  =>  0,
            "total_vendor"  =>  $product->ProductVendor()->count(),
            "total_rating"  =>  0,
            "minimum_price" =>  $product->ProductVendor()->min('harga'),
            "minumumPrice"  =>  $product->ProductVendor()->min('harga'),
            "liked"         =>  false,
            "recentReview"  =>  []
        ];


        if (Auth::guard('api')->check()) {

            $user = Auth::guard('api')->user();
            $arr['liked']   =   true;

            if ($user->role == 2) {
                $arr['inTrash']             =   true;
                $arr['product_vendor_id']   =   $product->ProductVendor()
                                                ->where('vendor_id', $user->id)->first()->id ?? null;
            }
        }

        return $arr;
    }
}
