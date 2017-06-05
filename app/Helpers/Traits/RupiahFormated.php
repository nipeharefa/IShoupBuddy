<?php


namespace App\Helpers\Traits;

trait RupiahFormated {

    public  function formatRupiah($nominal = 0, $sign = 'Rp. ', $end = ',-', $presisi = 0) {
        return $sign . number_format($nominal, $presisi, ',', '.');
    }

}
