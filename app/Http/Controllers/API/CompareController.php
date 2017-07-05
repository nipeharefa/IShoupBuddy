<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use DB;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        try {

            $product = Product::findOrFail($request->product_id);
            $from = [
                "category_id"       =>  $product->category_id,
                "similiartyText"    =>  100,
            ];

            $productName = $this->_cleanString($product->name);

            $hasil = Product::whereNotIn('id', [$request->product_id])->get()
                ->map(function($item) use($from, $productName) {
                    similar_text($productName, $this->_cleanString($item->name), $percent);
                    $target = [
                        "category_id"       =>  $item->category_id,
                        "similiartyText"    =>  $percent,
                    ];

                    return [
                        "id"        =>  $item->id,
                        "name"      =>  $item->name,
                        "nameSimilarity"    =>  $percent,
                        "kemiripan"    =>  ($this->similarity($from, $target) * 100)
                    ];
                });

        $sorted = collect($hasil)->sortByDesc('kemiripan')->values()->all();

        $response = [
            "sourceProductName" => $this->_cleanString($product->name),
            "target"    =>  $sorted
        ];

        return response()->json($response);

        } catch (Exception $e) {

            $err = [
                "message"   =>  $e->getMessage(),
                "status"    =>  "ERROR"
            ];

            return response()->json($err, 400);
        }
        $from = [
            "category_id"       =>  1,
            "similiartyText"    =>  1,
        ];


        $hasil = Product::get()->map(function($item) use ($from, $productName){

        });



        // return "Hasil Akhir : " . $this->similarity($from, $target);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function similarity(array $vec1, array $vec2) {
        return $this->_dotProduct($vec1, $vec2) / ($this->_absVector($vec1) * $this->_absVector($vec2));
    }
    protected function _dotProduct(array $vec1, array $vec2) {
        $result = 0;

        foreach (array_keys($vec1) as $key1) {
          foreach (array_keys($vec2) as $key2) {
        if ($key1 === $key2) $result += $vec1[$key1] * $vec2[$key2];
          }
        }

        return $result;
    }

    protected function _absVector(array $vec)
    {
        $result = 0;

        foreach (array_values($vec) as $value) {
          $result += $value * $value;
        }

        return sqrt($result);
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
}
