<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function about(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/about.js');
        $css = mix('css/about.css');

        $view = view('pages.other.about');

        if ($user) {

            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/a-about.js');
                    break;
                case 1:
                    // Member
                    $js = mix('js/m-about.js');
                    break;
                default:
                    // Vendor
                    $js = mix('js/v-about.js');
                    break;
            }
        }
        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }

    public function privacy(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/privacy.js');
        $css = mix('css/about.css');

        $view = view('pages.other.about');

        if ($user) {

            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/a-privacy.js');
                    break;
                case 1:
                    // Member
                    $js = mix('js/m-privacy.js');
                    break;
                default:
                    // Vendor
                    $js = mix('js/v-privacy.js');
                    break;
            }
        }
        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }

    public function pengumuman(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/pengumuman.js');
        $css = mix('css/about.css');

        $view = view('pages.other.about');

        if ($user) {

            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/a-pengumuman.js');
                    break;
                case 1:
                    // Member
                    $js = mix('js/m-pengumuman.js');
                    break;
                default:
                    // Vendor
                    $js = mix('js/v-pengumuman.js');
                    break;
            }
        }
        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }

    public function sk(Request $request)
    {
        $user = $request->user() ?? null;

        $js = mix('js/syarat-ketentuan.js');
        $css = mix('css/about.css');

        $view = view('pages.other.about');

        if ($user) {

            switch ($user->role) {
                case 0:
                    // admin
                    $js = mix('js/a-syarat-ketentuan.js');
                    break;
                case 1:
                    // Member
                    $js = mix('js/m-syarat-ketentuan.js');
                    break;
                default:
                    // Vendor
                    $js = mix('js/v-syarat-ketentuan.js');
                    break;
            }
        }
        return $view->with('user', $user)
                    ->with('js', $js)
                    ->with('categories', $this->getViewCategories())
                    ->with('title', 'Shoubud.xyz:Situs Review Produk Supermarket')
                    ->with('css', $css);
    }


}
