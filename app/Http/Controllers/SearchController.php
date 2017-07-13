<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/search_result.js');
        $css = mix('css/guest/search_result.css');

        $view = view('pages.search.index');

        $q = $request->q;
        $category_id = $request->category_id ?? null;

        if ($user) {
            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/asearch.js');
                    break;
                case 1:
                    // Member
                    $js = mix('js/msearch.js');
                    $css = mix('css/member/search.css');
                    break;
                default:
                    // Vendor
                    $js = mix('js/vhome.js');
                    break;
            }

            $view->with('user', $user);
        }

        return $view->with('keyword', $q)
                    ->with('category_id', $category_id)
                    ->with('js', $js)
                    ->with('css', $css);
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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
