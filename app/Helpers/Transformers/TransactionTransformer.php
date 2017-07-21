<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Model;

class TransactionTransformer extends AbstractTransformer
{
    public function transformModel(Model $model)
    {
        $arr = [
            'id'                => $model->id,
            'nominal'           => $model->nominal,
            'nominal_string'    => $this->formatRupiah($model->nominal),
            'user'              => UserTransformers::transform($model->User),
            'type'              => $this->getType($model->transactable_type),
            'status'            => $model->status,
            'status_string'     => $this->getStatus($model->status),
            'updated_at'        => $model->updated_at->toW3cString(),
            'links'             => $this->getLinkAction($model),
            'shipment'          => $model->TransactionShippment,
            "attachments"       => $this->generateUserPictureLinks($model->attachments)
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
            'approve'   => "/api/admin/transaction/{$model->id}/approve",
            'cancel'    => "/api/admin/transaction/{$model->id}/cancel",
        ];
    }

    protected function getStatus($status)
    {
        switch ($status) {
            case 0:
                return 'Pending';
                break;
            case 1:
                return 'Success';
                break;
            case 3:
                return 'Attachment Uploaded';
                break;
            default:
                return 'Fail / Cancel';
                break;
        }
    }
}
