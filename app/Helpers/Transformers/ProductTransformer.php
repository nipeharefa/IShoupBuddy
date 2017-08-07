<?php

namespace App\Helpers\Transformers;

use App\Helpers\Traits\Sentimen as SentimenTrait;
use Auth;
use Cache;
use Illuminate\Database\Eloquent\Model;
use Log;
use App\Helpers\Transformers\ReviewTransformer;

class ProductTransformer extends AbstractTransformer
{
    use SentimenTrait;

    public function transformModel(Model $product)
    {
        $secure = env('APP_ENV') == 'production';

        $options = @$this->options;

        $defaultSerializer = [
            'brand'     => 0,
            'sifat'     => 0,
            'pemakaian' => 0,
        ];

        $arr = [
            'id'            => $product->id,
            'name'          => $product->name,
            'category'      => $product->Category,
            'barcode'       => (float) $product->barcode,
            'description'   => $product->description,
            'picture_url'   => [
                'small'     => url('/image/small', $product->picture_url, $secure),
                'medium'    => url('/image/medium', $product->picture_url, $secure),
                'large'     => url('/image/large', $product->picture_url, $secure),
            ],
            'description'          => $product->description,
            'vendors'              => ProductVendorTransformer::transform($product->ProductVendor()->whereStatus(1)->get()),
            'total_review'         => $product->Review()->count(),
            'total_vendor'         => $product->ProductVendor()->count(),
            'total_rating'         => $product->Review()->count(),
            'avg_rating'           => round($product->Review()->avg('rating'), 1),
            'minimum_price'        => $product->ProductVendor()->min('harga'),
            'minimum_price_string' => $this->formatRupiah($product->ProductVendor()->min('harga')),
            'minumumPrice'         => $product->ProductVendor()->min('harga'),
            'liked'                => false,
            'recentReview'         => $this->getRecentReview($product),
            'attributes'           => $product->attributes ? unserialize($product->attributes) : $defaultSerializer,
        ];

        if ($this->isRelationshipLoaded($product, 'Review')) {
            $arr['review'] = ReviewTransformer::transform($product->Review) ?? null;
        }

        if (Auth::guard('api')->check()) {
            $user = Auth::guard('api')->user();

            $arr['liked'] = $user->wished($product->id);

            if ($user->role == 2) {
                $productVendor = $product->ProductVendor()->withTrashed()
                    ->where('vendor_id', $user->id)->first();
                Log::info($product);
                $arr['inTrash'] = $productVendor ? $productVendor->trashed() : false;
                $arr['product_vendor_id'] = $productVendor->id ?? null;
            }
        }

        if (isset($options['markUsed']) && $options['markUsed']) {
            $vendor = $options['vendor'];
            $arr['used'] = (bool) $product->ProductVendor()
                ->whereVendorId($vendor->id)->count();
        }

        $a = collect($product->Review)->map(function ($item) {
            return $this->getScore($item->body, $item);
        })->toArray();

        $summaryAvg = [
            'pos'   => collect($a)->avg('pos'),
            'neg'   => collect($a)->avg('neg'),
            'neu'   => collect($a)->avg('neu'),
        ];

        $count = [
            'pos'   => 0,
            'neg'   => 0,
            'neu'   => 0,
        ];

        foreach ($a as $key => $item) {
            $aaa = array_search(max($item), $item, true);

            $count[$aaa]++;
        }

        Log::info($count);
        $arr['summary'] = ['mean' => $summaryAvg, 'count' =>  $count];
        $arr['summary_string'] = collect($summaryAvg)->sort()->reverse()->keys()->first();

        return $arr;
    }

    protected function getRecentReview($product)
    {
        $review = $product->Review()
            ->with('user')
            ->orderByDesc('id')->take(10)->get();
        return $review;
    }

    private function getScore($sentence, Model $review)
    {
        $key = "{$review->id}_{$sentence}";

        return Cache::rememberForever($key, function () use ($sentence) {
            $arr = $this->score($sentence);
            $collection = collect($arr)->only(['pos', 'neg', 'neu'])->toArray();

            return $collection;
        });
    }
}
