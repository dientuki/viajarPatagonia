<?php

namespace App\Http\Controllers;

use App\Packages;
use App\Excursions;
use App\Cruiseships;
use Illuminate\Http\Request;
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
        $packages = Packages::getHome();
        $cruiseships = Cruiseships::getHome();
        $excursions = Excursions::getHome();

        return view('front/home', compact('packages', 'cruiseships', 'excursions'));
    }

    public function setLocale() {
      return redirect(app()->getLocale());
    }
}
