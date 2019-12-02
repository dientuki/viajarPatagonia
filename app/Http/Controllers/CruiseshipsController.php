<?php

namespace App\Http\Controllers;

use App\Cruiseships;
use App\CruiseshipsPrices;
use App\Http\Controllers\Controller;

class CruiseshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($locale, $name, $id)
    {
        $product = Cruiseships::getShow($id);
        $price = CruiseshipsPrices::getPrice($id);
        $relateds = Cruiseships::getRelated($id);
        $productType = 'cruise';

        return view('front/product/index', compact('product', 'price', 'relateds', 'productType'));      
    }    

    public function list($locale, $name)
    {
        $products = Cruiseships::getList();
        $productType = 'cruiseships';
        $route = 'cruise';

        return view('front/product/list', compact('products', 'productType', 'route'));
    }    
}