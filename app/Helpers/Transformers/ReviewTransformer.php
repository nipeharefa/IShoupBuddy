<?php


namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\Sentimen as SentimenTrait;
use Cache;

class ReviewTransformer extends AbstractTransformer {

    use SentimenTrait;

    public function transformModel(Model $review){

        $arr = [
            "id"        =>  $review->id,
            "rating"    =>  $review->rating,
            "body"      =>  $review->body,
            "sentimen"  =>  $this->getScore($review->body, $review),
            "user"      =>  UserTransformers::transform($review->User),
            "product"   =>  ProductTransformer::transform($review->Product),
            "vendor"    =>  VendorTransformer::transform($review->Vendor),
            "date"      =>  $review->created_at->toW3cString()
        ];

        return $arr;
    }

    private function getScore($sentence, Model $review) {

        $key = "{$review->id}_{$sentence}";

        return Cache::rememberForever($key, function() use ($sentence) {
            $arr = $this->score($sentence);
            $collection = collect($arr)->only(['pos', 'neg', 'neu'])->toArray();
            return $collection;
        });
    }
}
