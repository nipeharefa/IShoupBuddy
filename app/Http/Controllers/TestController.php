<?php

namespace App\Http\Controllers;

use App\Helpers\NaiveBayes;
use App\Helpers\Transformers\ProductTransformer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            $cU['pemakaian'],
        ];

        // return $compSource;
        $ids = $classifier->predict($compSource);

        $d = [];

        for ($i = 0; $i < $target; $i++) {
            if (isset($ids[$i])) {
                try {
                    $p = Product::findOrFail($ids[$i]);
                    if ($p->ProductVendor()->count()) {
                        array_push($d, ProductTransformer::transform($p));
                    }
                } catch (ModelNotFoundException $e) {

                }
            }
        }

        return $d;
    }
}
