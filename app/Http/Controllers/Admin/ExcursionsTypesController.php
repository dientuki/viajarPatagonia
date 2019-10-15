<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Translations\Language;
use App\ExcursionsTypes;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Translations\ExcursionsTypesTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditExcursionsTypes;
use App\Http\Requests\StoreExcursionsTypes;

class ExcursionsTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excursionsTypes = ExcursionsTypes::getAll();
        $languages = Language::getAll();

        return view('admin/excursions-types/index', compact('excursionsTypes', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $excursionType = new ExcursionsTypes();
        $action = 'create';
        $form_data = array('route' => 'admin.excursions-types.store', 'method' => 'POST');

        $languages = Language::getAll();
        
        return view('admin/excursions-types/form', compact('action', 'excursionType',  'form_data', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExcursionsTypes  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExcursionsTypes $request)
    {      
        $data = $request->validated();

        $excursionType = ExcursionsTypes::create();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {
                ExcursionsTypesTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_excursion_type' => $excursionType->id,
                    'type' => $data['language_' . $language->id]
                ]);
            }
        }        

        return redirect()->route('admin.excursions-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $excursionType = ExcursionsTypes::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.excursions-types.update', $excursionType->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/excursions-types/form', compact('action', 'excursionType', 'form_data', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditExcursionsTypes  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditExcursionsTypes $request, $id)
    {
        $excursionType = ExcursionsTypes::getEdit($id);

        $data = $request->validated();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {

                $where = [];
                $where[] = ['fk_language', $data['fk_language_' . $language->id]];
                $where[] = ['fk_excursion_type', $id];

                $excursionTypeTranslation = ExcursionsTypesTranslation::getEdit($where);

                $excursionTypeTranslation->fill([
                    'type' => $data['language_' . $language->id]
                ])->save();
            }
        }  

        return redirect()->route('admin.excursions-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $excursionType = ExcursionsTypes::findOrFail($id);

        try {
            ExcursionsTypesTranslation::where('fk_excursion_type', $id)->delete();
            $excursionType->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.excursions-types.index');
    }
}
