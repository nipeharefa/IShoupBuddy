<?php


namespace App\Helpers\Contracts;

interface Sentimen {

    public function score($sentence);
    public function categorise($sentence);
    public function getList($type);
    private function _cleanString($string);
    private function loadDefaults();
    public function setDictionary();
}
