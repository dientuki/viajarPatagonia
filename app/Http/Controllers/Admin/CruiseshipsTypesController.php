<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\CruiseshipsTypes;
use Illuminate\Http\Request;
use App\Http\Requests\EditCruiseshipsTypes;
use App\Http\Requests\StoreCruiseshipsTypes;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;

class CruiseshipsTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cruiseshipsTypes = CruiseshipsTypes::getAll();
        return view('admin/cruiseships-types/index', compact('cruiseshipsTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cruiseshipType = new CruiseshipsTypes();
        $action = 'create';
        $form_data = array('route' => 'admin.cruiseships-types.store', 'method' => 'POST');
        
        return view('admin/cruiseships-types/form', compact('action', 'cruiseshipType',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCruiseshipsTypes  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCruiseshipsTypes $request)
    {      
        $data = $request->validated();

        $cruiseshipType = CruiseshipsTypes::create($data);

        return redirect()->route('admin.cruiseships-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cruiseshipType = CruiseshipsTypes::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.cruiseships-types.update', $cruiseshipType->id), 'method' => 'PATCH');

        return view('admin/cruiseships-types/form', compact('action', 'cruiseshipType', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditCruiseshipsTypes  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCruiseshipsTypes $request, $id)
    {
        $cruiseshipType = CruiseshipsTypes::getEdit($id);

        $data = $request->validated();

        $cruiseshipType->fill($data)->save();

        return redirect()->route('admin.cruiseships-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cruiseshipType = CruiseshipsTypes::findOrFail($id);

        try {
            $cruiseshipType->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.cruiseships-types.index');
    }
}