<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        // example.com/search?q=jasdfk&category_id=123
        $q = $request->q;
        $category_id = $request->category_id ?? null;

        if ($user) {
            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/a-search.js');
                    $css = mix('css/member/search.css');
                    break;
                case 1:
                    // Member
                    $js = mix('js/msearch.js');
                    $css = mix('css/member/search.css');
                    break;
                default:
                    // Vendor
                    $js = mix('js/v-search.js');
                    $css = mix('css/member/search.css');
                    break;
            }
        }

        $cName = $category_id ? Category::find($category_id)->name : 'Semua Kategori';

        return $view->with('keyword', $q)
                    ->with('category_id', $category_id)
                    ->with('category_string', $cName)
                    ->with('js', $js)
                    ->with('user', $user)
                    ->with('categories', $this->getViewCategories())
                    ->with('css', $css);
    }
}
