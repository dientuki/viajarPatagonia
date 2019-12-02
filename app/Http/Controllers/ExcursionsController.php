<?php

namespace App\Http\Controllers;

use App\Excursions;
use App\ExcursionsPrices;
use App\Http\Controllers\Controller;

class ExcursionsController extends Controller
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
        $relateds = Excursions::getRelated($id);
        $productType = 'excursion';

        return view('front/product/index', compact('product', 'price', 'relateds', 'productType'));      
    }      

    public function list($locale, $name)
    {
        $products = Excursions::getList();
        $productType = 'excursions';
        $route = 'excursion';

        return view('front/product/list', compact('products', 'productType', 'route'));
    }    
}