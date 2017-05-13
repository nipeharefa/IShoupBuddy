<?php


namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\Sentimen as SentimenTrait;

class ReviewTransformer extends AbstractTransformer {

    use SentimenTrait;

    public function transformModel(Model $review){

        $arr = [
            "id"        =>  $review->id,
            "rating"    =>  $review->rating,
            "body"      =>  $review->body,
            "sentimen"  =>  $this->getScore($review->body),
            "user"      =>  UserTransformers::transform($review->User),
            "product"   =>  ProductTransformer::transform($review->Product),
            "vendor"    =>  VendorTransformer::transform($review->Vendor)
        ];

        return $arr;
    }

    private function getScore($sentence) {

        $arr = $this->score($sentence);
        $collection = collect($arr)->only(['pos', 'neg', 'neu'])->toArray();
        return $collection;
    }
}
