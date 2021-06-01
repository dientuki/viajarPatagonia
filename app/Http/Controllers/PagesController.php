<?php

namespace App\Http\Controllers;

use App\Pages;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($locale, $slug)
    {
      $page = Pages::getShow($slug);

      return view('front/pages/index', compact('page'));
    }
}
