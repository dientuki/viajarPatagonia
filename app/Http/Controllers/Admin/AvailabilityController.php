<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Translations\Language;
use App\Availability;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Translations\AvailabilityTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditAvailability;
use App\Http\Requests\StoreAvailability;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availability = Availability::getAll();
        $languages = Language::getAll();

        return view('admin/availability/index', compact('availability', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availability = new Availability();
        $action = 'create';
        $form_data = array('route' => 'admin.availability.store', 'method' => 'POST');

        $languages = Language::getAll();
        
        return view('admin/availability/form', compact('action', 'availability',  'form_data', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAvailability  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAvailability $request)
    {      
        $data = $request->validated();

        $availability = Availability::create();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {
                AvailabilityTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_availability' => $availability->id,
                    'availability' => $data['language_' . $language->id]
                ]);
            }
        }        

        return redirect()->route('admin.availability.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $availability = Availability::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.availability.update', $availability->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/availability/form', compact('action', 'availability', 'form_data', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditAvailability  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAvailability $request, $id)
    {
        $availability = Availability::getEdit($id);

        $data = $request->validated();

        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['language_' . $language->id]) && isset($data['fk_language_' . $language->id])) {

                $where = [];
                $where[] = ['fk_language', $data['fk_language_' . $language->id]];
                $where[] = ['fk_availability', $id];

                $availabilityTranslation = AvailabilityTranslation::getEdit($where);

                $availabilityTranslation->fill([
                    'availability' => $data['language_' . $language->id]
                ])->save();
            }
        }  

        return redirect()->route('admin.availability.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $availability = Availability::findOrFail($id);

        try {
            AvailabilityTranslation::where('fk_availability', $id)->delete();
            $availability->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.availability.index');
    }
}
