<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Region;
use App\Destination;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditDestination;
use App\Http\Requests\StoreDestination;
use Illuminate\Database\QueryException;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinations = Destination::getAll();
        return view('admin/destinations/index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destination = new Destination();
        $action = 'create';
        $form_data = array('route' => 'admin.destinations.store', 'method' => 'POST');

        $regions = Region::getLists();
        
        return view('admin/destinations/form', compact('action', 'destination',  'form_data', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDestination  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestination $request)
    {      
        $data = $request->validated();

        $destination = Destination::create($data);

        return redirect()->route('admin.destinations.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destination = Destination::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.destinations.update', $destination->id), 'method' => 'PATCH');

        $regions = Region::getLists();

        return view('admin/destinations/form', compact('action', 'destination', 'form_data', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditDestination  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDestination $request, $id)
    {
        $destination = Destination::getEdit($id);

        $data = $request->validated();

        $destination->fill($data)->save();

        return redirect()->route('admin.destinations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        try {
            $destination->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.destinations.index');
    }
}
