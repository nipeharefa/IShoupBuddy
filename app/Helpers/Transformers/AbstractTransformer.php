<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractTransformer
{

    protected $options;

    private function __construct($options)
    {
        $this->options = $options;
    }

    static function transform($modelOrCollection, $options = [])
    {
        $static = new static($options);

        if ($modelOrCollection instanceof Collection) {

            return $modelOrCollection->map([$static, 'transformModel'])->toArray();

        }

        return $static->transformModel($modelOrCollection);
    }

    protected function isRelationshipLoaded(Model $item, $relationshipName)
    {
        return $item->relationLoaded($relationshipName);
    }

    protected function transformModel(Model $modelOrCollection)
    {

    }

    protected function getProduction() {

        return env('APP_ENV') == "production";
    }

    protected function renderArrayImage() {

        return [];
    }

    /**
     * Convert ballace to IDR Format
     * Original Code: https://github.com/yogirzlsinatrya/terbilang/blob/master/src/Yogirzlsinatrya/Terbilang/Terbilang.php
     * @param  [type]  $nominal [description]
     * @param  string  $sign    [description]
     * @param  string  $end     [description]
     * @param  integer $presisi [description]
     * @return [type]           [description]
     */
    protected function formatRupiah($nominal = 0, $sign = 'Rp. ', $end = ',-', $presisi = 0) {
        return $sign . number_format($nominal, $presisi, ',', '.') . $end;
    }
}
