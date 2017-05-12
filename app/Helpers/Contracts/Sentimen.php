<?php


namespace App\Helpers\Contracts;

interface Sentimen {

    public function score($sentence);
    public function categorise($sentence);
    public function getList($type);
    public function setDictionary();
}
