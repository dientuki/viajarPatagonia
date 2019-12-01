<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helpers;
use App\Packages;
use App\Excursions;
use App\Cruiseships;
use App\Translations\Language;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $packages = Packages::getList(6);
        $cruiseships = Cruiseships::getHome();
        $excursions = Excursions::getList(4);

        return view('front/home', compact('packages', 'cruiseships', 'excursions'));
    }

    public function setLocale() {
      $locale = app()->getLocale();
      $languages = Helpers::getLocale();
      if ($languages != null) {
          foreach($languages as $key => $value) {
            if (Language::getLocale($key)) {
                $locale = $key;
                break;
            }
          }
      }
      return redirect($locale);
    }
}
