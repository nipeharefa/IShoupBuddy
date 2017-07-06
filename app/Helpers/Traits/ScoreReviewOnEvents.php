<?php

namespace App\Helpers\Traits;

use App\Models\Review;
use Cache;

trait ScoreReviewOnEvents
{
    protected function mapReview()
    {
        $a = collect($this->product->Review)->map(function ($item) {
            return $this->getScore($item->body, $item);
        })->toArray();



        $summaryAvg = [
            "pos"   =>  collect($a)->avg('pos'),
            "neg"   =>  collect($a)->avg('neg'),
            "neu"   =>  collect($a)->avg('neu')
        ];

        $count = [
            "pos"   =>  0,
            "neg"   =>  0,
            "neu"   =>  0
        ];

        foreach ($a as $key => $item) {
            $aaa = array_search(max($item), $item, true);

            $count[$aaa]++;
        }

        $this->summaryProduct =  [ "mean" => $summaryAvg, "count" =>  $count ];
    }

    protected function getScore($sentence, Review $review)
    {
        $key = "{$review->id}_{$sentence}";

        return Cache::rememberForever($key, function () use ($sentence) {
            $arr = $this->score($sentence);
            $collection = collect($arr)->only(['pos', 'neg', 'neu'])->toArray();
            return $collection;
        });
    }
}
