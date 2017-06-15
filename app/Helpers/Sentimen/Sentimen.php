<?php


namespace App\Helpers\Sentimen;

use Storage;
use Exception;
use Carbon\Carbon;
use Log;
use Cache;


class Sentimen
{
    # Type drive filesystem
    protected $drive;

    # Panjang minimal token
    private $minTokenLength = 1;

    # Panjang maksimal token yang akan di analisa
    private $maxTokenLength = 15;


    private $classTokCounts = array(
        'pos' => 0,
        'neg' => 0,
        'neu' => 0
    );

    private $prior = array(
        'pos' => 0.333333333333,
        'neg' => 0.333333333333,
        'neu' => 0.333333333334
    );

    private $dictionary = [];

    function __construct()
    {
        # Constructor
        # Mengisi variabel $drive dengan instance storage dengan disk type local
        $this->drive = Storage::disk('local');
        # Buka kamus
        $this->loadDefaults();
    }

    # Getters untuk mengambil instance drive
    public function getDrive() {

        return $this->drive;

    }

    # Class atau type yang akan di analisa
    # ada 3
    # pos sebagai positif
    # neg sebagai negatif
    # neu sebagai netral
    private $classes = array('pos', 'neg', 'neu');


    private function loadDefaults() {
        # Lakukan perulangan sebanyak class (type) yang akan di analisa
        foreach ($this->classes as $class) {
            # Jalankan functions setDictonory dengan parameter key dari class
            # Jika terjadi error maka buat exception
            # dengan pesan peringan Dictonorary dengan type terkait tidak dapat dibuka
            # Code error 23
            if (!$this->setDictionary($class)) {
                throw new Exception("Dictionary for class ${class} could not be loaded",23);
            }
        }
    }

    private function setDictionary($class) {
        # Paramete $class yang merupkan tipe dari class
        # akan langsung di masukkan ke dalam tempalte string sebagai filename
        $fn = "sentimen/{$class}.json";

        # Check apakah file tersedia di storage (drive)
        # Jika tidak maka return false
        if (!$this->drive->exists($fn)) {
            return false;
        }

        # Ubah data json menjadi bentuk array
        // $words = json_decode($this->drive->get($fn), true);
        $words = Cache::remember($fn, 3600, function()  use ($fn) {
            $words = json_decode($this->drive->get($fn), true);
            return $words;
        });

        # Lakukan perulangan untuk semua kata
        foreach ($words as $word) {
            # Check apakah kata dan class sudah berisi nilai
            if (!isset($this->dictionary[$word][$class])) {

                //Add to this word to the dictionary and set counter value as one. This function ensures that if a word is in the text file more than once it still is only accounted for one in the array
                # Jika belum maka tambahkan array baru ke dictionary
                # Dimensi pertama adalah kata
                # Dimensi kedua adalah class atau type.
                $this->dictionary[$word][$class] = 1;
            }//Close If statement
        }
        return true;
    }


    public function score($sentence) {

        $start = Carbon::now();

        #
        $tokens = $this->_getTokens($sentence);

        # Inisialisasi score
        $total_score = 0;

        # Inisilaisasi array $score
        $scores = array();


        //Loop through all of the different classes set in the $classes variable
        # lakukan perulangan ke semua class atau type
        foreach ($this->classes as $class) {
            # Buat array baru dengan key adalah value dari class
            $scores[$class] = 1;

            //For each of the individual words used loop through to see if they match anything in the $dictionary
            # Lakukan perulangan ke semua token(kata yang sudah dipisahkan berdasarkan
            # spasi ke bentuk array)
            #
            foreach ($tokens as $token) {

                if (strlen($token) > $this->minTokenLength
                    && strlen($token) < $this->maxTokenLength
                    // && !in_array($token, $this->ignoreList)
                    ) {

                        if (isset($this->dictionary[$token][$class])) {
                            //Set count equal to it
                            $count = $this->dictionary[$token][$class];
                            Log::info('__COUNT__DICT : ' . $count);
                        } else {
                            $count = 0;
                        }

                        $scores[$class] *= ($count + 1);
                        Log::info($scores);
                }
            }

            //Score for this class is the prior probability multiplyied by the score for this class
            $scores[$class] = $this->prior[$class] * $scores[$class];
        }

        //Makes the scores relative percents
        foreach ($this->classes as $class) {
            $total_score += $scores[$class];
        }

        foreach ($this->classes as $class) {
            $scores[$class] = round($scores[$class] / $total_score, 3);
        }

        $end = Carbon::now();

        $scores['sentences'] = $sentence;
        $scores['took'] = $end->diffInSeconds($start, true);

        //Sort array in reverse order
        arsort($scores);

        return $scores;
    }

    public function getList($type) {
        $wordList = [];

        $fn = "sentimen/{$class}.json";

        if (!$this->drive->exists($fn)) {
            return false;
        }

        $words = json_decode($this->drive->get($fn), true);
        //Loop through results
        foreach ($words as $word) {
            //remove any slashes
            $word = stripcslashes($word);
            //Trim word
            $trimmed = trim($word);

            //Push results into $wordList array
            array_push($wordList, $trimmed);
        }
       //Return $wordList
       return $wordList;
    }

    private function _cleanString($string) {

        $diac =
                /* A */ chr(192) . chr(193) . chr(194) . chr(195) . chr(196) . chr(197) .
                /* a */ chr(224) . chr(225) . chr(226) . chr(227) . chr(228) . chr(229) .
                /* O */ chr(210) . chr(211) . chr(212) . chr(213) . chr(214) . chr(216) .
                /* o */ chr(242) . chr(243) . chr(244) . chr(245) . chr(246) . chr(248) .
                /* E */ chr(200) . chr(201) . chr(202) . chr(203) .
                /* e */ chr(232) . chr(233) . chr(234) . chr(235) .
                /* Cc */ chr(199) . chr(231) .
                /* I */ chr(204) . chr(205) . chr(206) . chr(207) .
                /* i */ chr(236) . chr(237) . chr(238) . chr(239) .
                /* U */ chr(217) . chr(218) . chr(219) . chr(220) .
                /* u */ chr(249) . chr(250) . chr(251) . chr(252) .
                /* yNn */ chr(255) . chr(209) . chr(241);

        return strtolower(strtr($string, $diac, 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn'));
    }

    private function _getTokens($string) {

        // Replace line endings with spaces
        $string = str_replace("\r\n", " ", $string);

        //Clean the string so is free from accents
        $string = $this->_cleanString($string);

        //Make all texts lowercase as the database of words in in lowercase
        $string = strtolower($string);

        //Break string into individual words using explode putting them into an array
        $matches = explode(" ", $string);

        //Return array with each individual token
        return $matches;
    }
}
