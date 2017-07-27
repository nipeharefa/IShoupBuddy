<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Helpers\NaiveBayes;
use App\Helpers\Transformers\ProductTransformer;

class TestController extends Controller
{
    public function knn(Request $request)
    {
        $notId = $request->id;
        $target = $request->target;

        $comp = Product::find($notId);

        $otherProduct = Product::whereNotIn('id', [$notId])->get();

        $samples = [];
        $labels = [];

        foreach ($otherProduct as $key => $item) {
            $attributes = unserialize($item->attributes);

            $data = [
                $item->category_id,
                $attributes['brand'],
                $attributes['sifat'],
                $attributes['pemakaian'],
            ];
            array_push($samples, $data);
            array_push($labels, $item->id);
        }

        // return $samples;

        $classifier = new NaiveBayes();
        $classifier->train($samples, $labels);

        $cU = unserialize($comp->attributes);

        $compSource = [
            $comp->category_id,
            $cU['brand'],
            $cU['sifat'],
            $cU['pemakaian']
        ];

        // return $compSource;
        $ids = $classifier->predict($compSource);

        $d = [];

        for ($i=0; $i <$target ; $i++) {
            if (isset($ids[$i])) {
                $p = Product::find($ids[$i]);
                array_push($d, ProductTransformer::transform($p));
            }
        }

        return $d;
    }
}
