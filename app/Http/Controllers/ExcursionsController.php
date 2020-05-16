<?php

namespace App\Http\Controllers;

use App\Excursions;
use App\ExcursionsPrices;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function list($locale, $name, Request $request)
    {   
        $products = Excursions::getList(false, $request->input('duration'),$request->input('destination'));           
        $productType = 'excursions';
        $route = 'excursion';

        return view('front/product/list', compact('products', 'productType', 'route'));
    }    
}