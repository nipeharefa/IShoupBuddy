<?php

namespace App\Helpers\Traits;

use App\Helpers\Sentimen\Sentimen as SentimenFactory;
use App\Helpers\Sentimen\Stemmer;

trait Sentimen {

    public function score($sentences) {

        $sentimen = new SentimenFactory;
        $stemmerFactory = new Stemmer;
        $stemmer  = $stemmerFactory->createStemmer();
        $output   = $stemmer->stem($sentences);

        return $sentimen->score($output);
    }

    public function categorise($sentence) {

        $scores = $this->score($sentence);

        //Classification is the key to the scores array
        $classification = key($scores);

        return $classification;
    }
}
