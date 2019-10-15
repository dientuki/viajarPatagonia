<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Translations\Language;
use App\CruiseshipsTypes;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Translations\CruiseshipsTypesTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditCruiseshipsTypes;
use App\Http\Requests\StoreCruiseshipsTypes;

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
        $languages = Language::getAll();

        return view('admin/cruiseships-types/index', compact('cruiseshipsTypes', 'languages'));
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

        $languages = Language::getAll();
        
        return view('admin/cruiseships-types/form', compact('action', 'cruiseshipType',  'form_data', 'languages'));
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

        $cruiseshipType = CruiseshipsTypes::create();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {
                CruiseshipsTypesTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_cruiseship_type' => $cruiseshipType->id,
                    'type' => $data['language_' . $language->id]
                ]);
            }
        }        

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
        $languages = Language::getAll();

        return view('admin/cruiseships-types/form', compact('action', 'cruiseshipType', 'form_data', 'languages'));
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

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {

                $where = [];
                $where[] = ['fk_language', $data['fk_language_' . $language->id]];
                $where[] = ['fk_cruiseship_type', $id];

                $cruiseshipTypeTranslation = CruiseshipsTypesTranslation::getEdit($where);

                $cruiseshipTypeTranslation->fill([
                    'type' => $data['language_' . $language->id]
                ])->save();
            }
        }  

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
            CruiseshipsTypesTranslation::where('fk_cruiseship_type', $id)->delete();
            $cruiseshipType->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.cruiseships-types.index');
    }
}
