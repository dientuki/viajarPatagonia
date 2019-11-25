<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Requests\EditRegion;
use App\Http\Requests\StoreRegion;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::getAll();
        return view('admin/regions/index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region = new Region();
        $action = 'create';
        $form_data = array('route' => 'admin.regions.store', 'method' => 'POST');
        
        return view('admin/regions/form', compact('action', 'region',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegion $request)
    {      
        $data = $request->validated();

        $region = Region::create($data);

        return redirect()->route('admin.regions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region = Region::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.regions.update', $region->id), 'method' => 'PATCH');

        return view('admin/regions/form', compact('action', 'region', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditRegion  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRegion $request, $id)
    {
        $region = Region::getEdit($id);

        $data = $request->validated();

        $region->fill($data)->save();

        return redirect()->route('admin.regions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);

        try {
            $region->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.regions.index');
    }
}
