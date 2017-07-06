<?php

namespace App\Helpers\Transformers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer as BaseAbstractTransformer;

class AbstractTransformer extends BaseAbstractTransformer
{
    protected function getProduction()
    {
        return env('APP_ENV') == "production";
    }

    protected function renderArrayImage()
    {
        return [];
    }

    protected function generateUserPictureLinks($filename)
    {
        $secure = $this->getProduction();

        if ($filename) {
            return [
                "small"     =>  url('/image/small', $filename, $secure),
                "medium"    =>  url('/image/medium', $filename, $secure),
                "large"     =>  url('/image/large', $filename, $secure)
            ];
        }

        return null;
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
    protected function formatRupiah($nominal = 0, $sign = 'Rp. ', $end = ',-', $presisi = 0)
    {
        return $sign . number_format($nominal, $presisi, ',', '.');
    }
}
