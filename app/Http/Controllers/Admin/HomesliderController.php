<?php

namespace App\Http\Controllers\Admin;

use Exception;

use App\Homesliders;
use Illuminate\Http\Request;
use App\Translations\Language;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditHomeslider;
use Spatie\MediaLibrary\Models\Media;
use App\Translations\HomeslidersTranslation;

class HomesliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homesliders = Homesliders::getAll();
        $languages = Language::getAll();

        return view('admin/homesliders/index', compact('homesliders', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $excursion = Excursions::find($id);
        $excursionTranslation = ExcursionsTranslation::getEdit($id);
        $excursionType = ExcursionsTypes::getLists();
        $destination = Destination::getLists();
        $excursionPrice = ExcursionsPrices::getEdits($id);
        $currencies = Currency::getAll();
        $availability = Availability::getLists();
        $duration = Duration::getLists();        

        $action    = 'update';
        $form_data = array('route' => array('admin.excursions.update', $excursion->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/homesliders/edit', compact('action', 'excursion', 'form_data', 'languages', 'excursionTranslation', 'excursionType', 'currencies', 'excursionPrice', 'destination', 'availability', 'duration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditExcursion  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditExcursion $request, $id)
    {
        $excursion = Excursions::getEdit($id);

        $data = $request->validated();
        
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        $excursion->fill($data)->save();

        $this->updateLanguages($id, $data);
        $this->updateCurrencies($id, $data);
        $this->updateImage($id, $data);
        $this->storeImages($excursion, $data);

        return redirect()->route('admin.excursions.index');
    }
}