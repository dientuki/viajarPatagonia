<?php

namespace App\Http\Controllers;

use App\Packages;
use App\Excursions;
use App\PackagePrices;
use App\Http\Controllers\Controller;

class PackagesController extends Controller
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
        $excursionsUnrelated = Excursions::getUnrelatedPackage($id);
        $excursionsRelated = Excursions::getRelatedPackage($id);
        $productType = 'package';

        return view('front/product/index', compact('product', 'price', 'relateds', 'excursionsUnrelated', 'excursionsRelated', 'productType'));
    }

    public function list($locale, $name)
    {
        $products = Packages::getList();
        $productType = 'package';

        return view('front/product/list', compact('products', 'productType'));
    }    
}