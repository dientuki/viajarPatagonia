<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Translations\Language;
use App\Duration;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Translations\DurationTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditDuration;
use App\Http\Requests\StoreDuration;

class DurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $duration = Duration::getAll();
        $languages = Language::getAll();

        return view('admin/duration/index', compact('duration', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $duration = new Duration();
        $action = 'create';
        $form_data = array('route' => 'admin.duration.store', 'method' => 'POST');

        $languages = Language::getAll();
        
        return view('admin/duration/form', compact('action', 'duration',  'form_data', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDuration  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDuration $request)
    {      
        $data = $request->validated();

        $duration = Duration::create();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {
                DurationTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_duration' => $duration->id,
                    'duration' => $data['language_' . $language->id]
                ]);
            }
        }        

        return redirect()->route('admin.duration.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $duration = Duration::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.duration.update', $duration->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/duration/form', compact('action', 'duration', 'form_data', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditDuration  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditDuration $request, $id)
    {
        $duration = Duration::getEdit($id);

        $data = $request->validated();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {

                $where = [];
                $where[] = ['fk_language', $data['fk_language_' . $language->id]];
                $where[] = ['fk_duration', $id];

                $durationTranslation = DurationTranslation::getEdit($where);

                $durationTranslation->fill([
                    'duration' => $data['language_' . $language->id]
                ])->save();
            }
        }  

        return redirect()->route('admin.duration.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $duration = Duration::findOrFail($id);

        try {
            DurationTranslation::where('fk_duration', $id)->delete();
            $duration->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.duration.index');
    }
}
