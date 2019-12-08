<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Packages;
use App\Excursions;
use App\Cruiseships;
use App\Http\Helpers\Helpers;
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
        $cruiseships = Cruiseships::getList(2);
        $excursions = Excursions::getList(4);

        return view('front/home', compact('packages', 'cruiseships', 'excursions'));
    }

    public function setLocale() {
      $request = request();
      $locale = array('iso' => '', 'id' => '');

      if ($request->session()->has('locale')) {
        $locale = $request->session()->get('locale');
        return redirect($locale['iso']);
      }

      $iso = app()->getLocale();
      $languages = Helpers::getLocale();
      
      if ($languages != null) {
          foreach($languages as $key => $value) {
            $tmp = Language::getLocale($key);

            if (count($tmp) == 1) {
              $locale = array('iso' => $key, 'id' => $tmp->first());
              break;
            }
          }
      }

      $request->session()->put('locale', $locale);
      app()->setLocale($locale['iso']);
      return redirect($locale['iso']);
    }

    public function setCurrency($iso)
    {
      $id = Currency::getDefault($iso);
      $defaults = array(
        'en' => 'USD',
        'es' => 'ARS',
        'pt' => 'EUR'
      );

      if ($id == null) {
        return redirect()->route('cleanHome');
      } else {
        $currency = array('iso' => $iso, 'id' => $id);
        session(['currency' => $currency]);
        return redirect()->back();
      }
    }    
}
