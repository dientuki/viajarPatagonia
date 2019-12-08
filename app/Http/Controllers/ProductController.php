<?php

namespace App\Http\Controllers;

use App\Packages;
use App\Excursions;
use App\Cruiseships;
use App\PackagePrices;
use App\ExcursionsPrices;
use App\CruiseshipsPrices;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPackage($locale, $name, $id)
    {
        $product = Packages::getShow($id);
        $price = PackagePrices::getPrice($id);
        $relateds = Packages::getRelated($id);
        $excursionsUnrelated = Excursions::getUnrelatedPackage($id);
        $excursionsRelated = Excursions::getRelatedPackage($id);
        $productType = 'package';

        return view('front/product/index', compact('product', 'price', 'relateds', 'excursionsUnrelated', 'excursionsRelated', 'productType'));
    }

    public function showExcursion($locale, $name, $id)
    {
        $product = Excursions::getShow($id);
        $price = ExcursionsPrices::getPrice($id);
        $relateds = Excursions::getRelated($id);
        $productType = 'excursion';

        return view('front/product/index', compact('product', 'price', 'relateds', 'productType'));      
    }    

    public function showCruiseship($locale, $name, $id)
    {
        $product = Cruiseships::getShow($id);
        $price = CruiseshipsPrices::getPrice($id);
        $relateds = Cruiseships::getRelated($id);
        $productType = 'cruiseship';

        return view('front/product/index', compact('product', 'price', 'relateds', 'productType'));      
    }    

    public function listPackages($locale, $name, $id)
    {
        $products = Packages::getHome();
        $productType = 'package';

        return view('front/product/list', compact('product', 'price', 'relateds', 'excursionsUnrelated', 'excursionsRelated', 'productType'));
    }    
}