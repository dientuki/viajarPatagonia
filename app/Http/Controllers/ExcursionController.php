<?php

namespace App\Http\Controllers;

use App\Excursions;
use App\ExcursionsPrices;
use App\Http\Controllers\Controller;

class ExcursionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $name, $id)
    {
        $product = Excursions::getShow($id);
        $price = ExcursionsPrices::getPrice($id);
        //$relateds = Packages::getRelated($id);
        $productType = 'excursion';

        return view('front/product/index', compact('product', 'productType'));      
    }
}