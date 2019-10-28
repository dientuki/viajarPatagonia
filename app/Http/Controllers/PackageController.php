<?php

namespace App\Http\Controllers;


class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('admin/packages/index', compact('packages', 'languages'));
    }
}