<?php

namespace App\Helpers\Sentimen;

use Cache;
use Sastrawi\Stemmer\StemmerFactory;

class Stemmer extends StemmerFactory
{
    public function getWords($isDev = false)
    {
        $minutes = 1000;

        $words = Cache::remember('sastrawi_cache_dictionary', $minutes, function () {
            return $this->getWordsFromFile();
        });

        return $words;
    }
}
