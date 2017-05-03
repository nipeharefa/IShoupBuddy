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
}
