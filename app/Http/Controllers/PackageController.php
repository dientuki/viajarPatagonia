<?php

namespace App\Http\Controllers;

use App\Packages;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $name, $id)
    {
        $product = Packages::getShow($id);

        return view('front/product', compact('product'));
    }
}