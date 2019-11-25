<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Translations\Language;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\EditLanguage;
use App\Http\Requests\StoreLanguage;
use App\Http\Controllers\Controller;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::getAll();
        return view('admin/languages/index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = new Language();
        $action = 'create';
        $form_data = array('route' => 'admin.languages.store', 'method' => 'POST');
        
        return view('admin/languages/form', compact('action', 'language',  'form_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLanguage  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLanguage $request)
    {      
        $data = $request->validated();

        $language = Language::create($data);

        return redirect()->route('admin.languages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.languages.update', $language->id), 'method' => 'PATCH');

        return view('admin/languages/form', compact('action', 'language', 'form_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditLanguage  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditLanguage $request, $id)
    {
        $language = Language::getEdit($id);

        $data = $request->validated();

        $language->fill($data)->save();

        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);

        try {
            $language->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.languages.index');
    }
}
