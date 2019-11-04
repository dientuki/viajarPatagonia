<?php

namespace App\Http\Controllers;

use App\Packages;
use App\PackagePrices;
use App\Http\Controllers\Controller;

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
        $price = PackagePrices::getPrice($id);
        $relateds = Packages::getRelated($id);

        return view('front/product/index', compact('product', 'price', 'relateds'));
    }
}