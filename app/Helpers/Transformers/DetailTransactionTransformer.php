<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;

class DetailTransactionTransformer extends AbstractTransformer
{
    public function transformModel(Model $model)
    {
        $arr = [
            "id"                =>  $model->id,
            "type"              =>  $this->getType($model->transactable_type),
            "detail"            =>  $this->transformDetail($model),
            "user"              =>  UserTransformers::transform($model->User)
        ];

        if ($this->isRelationshipLoaded($model, 'Detail')) {
            $arr['detail'] = DetailTransformer::transform($model->Detail);
        }

        return $arr;
    }

    protected function getType($model)
    {
        $reflector = new \ReflectionClass($model);
        return $reflector->getShortName();
    }

    protected function getLinkAction($model)
    {
        return [
            "approve"   =>  "/api/admin/transaction/{$model->id}/approve",
            "cancel"    =>  "/api/admin/transaction/{$model->id}/cancel"
        ];
    }

    protected function transformDetail(Model $model)
    {
        if ($this->getType($model->transactable_type) == "Saldo") {
            $detail = [
                "name"  =>  "Penambahan Saldo",
                "quantity"  => 1,
                "harga"    =>  $model->nominal,
                "harga_string" =>  $this->formatRupiah($model->nominal),
                "total"     =>  $model->nominal,
                "total_string" =>  $this->formatRupiah($model->nominal),
            ];

            return [$detail];
        }

        return $model->Detail;
    }

    protected function getStatus($status)
    {
        switch ($status) {
            case 0:
                return "Pending";
                break;
            case 1:
                return "Success";
                break;
            default:
                return "Fail / Cancel";
                break;
        }
    }
}
