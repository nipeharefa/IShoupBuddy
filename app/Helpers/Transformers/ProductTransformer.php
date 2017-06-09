<?php


namespace App\Helpers\Transformers;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;

class ProductTransformer extends AbstractTransformer {


    public function transformModel(Model $product){

        $secure = env('APP_ENV') == "production";

        $options = @$this->options;

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
            "total_review"  =>  $product->Review()->count(),
            "total_vendor"  =>  $product->ProductVendor()->count(),
            "total_rating"  =>  $product->Review()->count(),
            "avg_rating"    =>  $product->Review()->avg('rating'),
            "minimum_price" =>  $product->ProductVendor()->min('harga'),
            "minimum_price_string" =>  $this->formatRupiah($product->ProductVendor()->min('harga')),
            "minumumPrice"  =>  $product->ProductVendor()->min('harga'),
            "liked"         =>  false,
            "recentReview"  =>  []
        ];

        if ($this->isRelationshipLoaded($product, 'Review')) {
            $arr['review'] = $product->Review == null ? ReviewTransformer::transform($product->Review) : null;
        }


        if (Auth::guard('api')->check()) {

            $user = Auth::guard('api')->user();
            $arr['liked']   =   true;

            if ($user->role == 2) {
                $productVendor = $product->ProductVendor()->withTrashed()
                    ->where('vendor_id', $user->id)->first();
                Log::info($product);
                $arr['inTrash']             =   $productVendor ? $productVendor->trashed() : false;
                $arr['product_vendor_id']   =   $productVendor->id ?? null;
            }
        }

        if ($options['markUsed']) {

            $vendor = $options['vendor'];
            $arr['used'] = (Boolean)$product->ProductVendor()
                ->whereVendorId($vendor->id)->count();
        }

        return $arr;
    }
}
