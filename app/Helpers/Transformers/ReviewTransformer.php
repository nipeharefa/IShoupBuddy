<?php

namespace App\Helpers\Transformers;

use App\Helpers\Traits\Sentimen as SentimenTrait;
use Cache;
use Illuminate\Database\Eloquent\Model;

class ReviewTransformer extends AbstractTransformer
{
    use SentimenTrait;

    public function transformModel(Model $review)
    {
        $arr = [
            'id'        => $review->id,
            'rating'    => $review->rating,
            'body'      => $review->body,
            'sentimen'  => $this->getScore($review->body, $review),
            'user'      => $this->getCacheUser($review->User),
            'product'   => ProductTransformer::transform($review->Product),
            'vendor'    => VendorTransformer::transform($review->Vendor),
            'date'      => $review->created_at->toW3cString(),
        ];

        $arr['summary_text']    =  collect($arr['sentimen'])->sort()->keys()
                                    ->reverse()->first();

        return $arr;
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

    protected function getCacheUser($user)
    {
        $key = "user_{$user->id}_{$user->updated_at}";

        return Cache::rememberForever($key, function () use ($user) {
            return UserTransformers::transform($user);
        });
    }
}
