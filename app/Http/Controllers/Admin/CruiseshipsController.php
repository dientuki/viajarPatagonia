<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Currency;
use App\Cruiseships;
use App\CruiseshipsTypes;
use App\CruiseshipsPrices;
use Illuminate\Http\Request;
use App\Translations\Language;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditCruiseship;
use App\Http\Requests\StoreCruiseship;
use App\Translations\CruiseshipsTranslation;

class CruiseshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cruiseships = Cruiseships::getAll();
        $languages = Language::getAll();

        return view('admin/cruiseships/index', compact('cruiseships', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cruiseship = new Cruiseships();
        $action = 'create';
        $form_data = array('route' => 'admin.cruiseships.store', 'method' => 'POST');
        $cruiseshipType = CruiseshipsTypes::getLists();
        $currencies = Currency::getAll();

        $languages = Language::getAll();
        
        return view('admin/cruiseships/create', compact('action', 'cruiseship',  'form_data', 'languages', 'cruiseshipType', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCruiseship  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCruiseship $request)
    {      
        $data = $request->validated();

        $cruiseship = Cruiseships::create($data);

        $this->storeLanguages($cruiseship->id, $data);
        $this->storeCurrencies($cruiseship->id, $data);

        if (isset($data['images'])) {
          foreach ($data['images'] as $file) {
            $cruiseship->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('products');
          }
        }

        return redirect()->route('admin.cruiseships.index');
    }

    private function storeLanguages($id, $data)
    {
        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {
                CruiseshipsTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_cruiseship' => $id,
                    'name' => $data['name_' . $language->id],
                    'summary' => $data['summary_' . $language->id],
                    'body' => $data['body_' . $language->id]
                ]);
            }
        }
    }

    private function storeCurrencies($id, $data)
    {
        $currencies = Currency::getAll();
        
        foreach ($currencies as $currency) {
            if (isset($data['fk_currency_' . $currency->id]) && $data['price_' . $currency->id] != null) {

                CruiseshipsPrices::create([
                    'fk_currency' => $data['fk_currency_' . $currency->id],
                    'fk_cruiseship' => $id,
                    'price' => $data['price_' . $currency->id],
                    'discount' => $data['discount_' . $currency->id],
                    'is_active' => isset($data['is_active_' . $currency->id]) ? true : false
                ]);
            }
        }  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cruiseship = Cruiseships::getEdit($id);
        $cruiseshipTranslation = CruiseshipsTranslation::getEdit($id);
        $cruiseshipType = CruiseshipsTypes::getLists();
        $cruiseshipPrice = CruiseshipsPrices::getEdits($id);
        $currencies = Currency::getAll();

        $action    = 'update';
        $form_data = array('route' => array('admin.cruiseships.update', $cruiseship->id), 'method' => 'PATCH');
        $languages = Language::getAll();

        return view('admin/cruiseships/edit', compact('action', 'cruiseship', 'form_data', 'languages', 'cruiseshipTranslation', 'cruiseshipType', 'currencies', 'cruiseshipPrice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditCruiseship  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCruiseship $request, $id)
    {
        $cruiseship = Cruiseships::getEdit($id);

        $data = $request->validated();

        $cruiseship->fill($data)->save();

        $languages = Language::getAll();
        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {

                $where = array(
                    ['fk_language', $data['fk_language_' . $language->id]],
                    ['fk_cruiseship', $id]
                );

                $cruiseshipTranslation = CruiseshipsTranslation::getUpdate($where);

                $cruiseshipTranslation->fill([
                    'name' => $data['name_' . $language->id],
                    'summary' => $data['summary_' . $language->id],
                    'body' => $data['body_' . $language->id]
                ])->save();
            }            
        }

        $currencies = Currency::getAll();
        foreach ($currencies as $currency) {
            if (isset($data['fk_currency_' . $currency->id]) && $data['price_' . $currency->id] != null) {

                $where = array(
                    ['fk_currency', $data['fk_currency_' . $currency->id]],
                    ['fk_cruiseship', $id]
                );

                $cruiseshipPrice = CruiseshipsPrices::getUpdate($where);

                //dd(is_null($cruiseshipPrice));

                if (is_null($cruiseshipPrice)) {
                    CruiseshipsPrices::create([
                        'fk_currency' => $data['fk_currency_' . $currency->id],
                        'fk_cruiseship' => $id,
                        'price' => $data['price_' . $currency->id],
                        'discount' => $data['discount_' . $currency->id],
                        'is_active' => isset($data['is_active_' . $currency->id]) ? true : false
                    ]);
                } else {
                    $cruiseshipTranslation->fill([
                        'price' => $data['price_' . $currency->id],
                        'discount' => $data['discount_' . $currency->id],
                        'is_active' => isset($data['is_active_' . $currency->id]) ? true : false
                    ])->save();
                }
            }            
        }

        return redirect()->route('admin.cruiseships.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cruiseship = Cruiseships::findOrFail($id);

        try {
            CruiseshipsTranslation::where('fk_cruiseship', $id)->delete();
            $cruiseship->delete();
            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.cruiseships.index');
    }
}