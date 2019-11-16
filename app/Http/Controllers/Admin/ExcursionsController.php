<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Currency;
use App\Duration;
use App\Excursions;
use App\Destination;
use App\Availability;
use App\ExcursionsTypes;
use App\ExcursionsPrices;
use Illuminate\Http\Request;
use App\Translations\Language;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditExcursion;
use App\Http\Requests\StoreExcursion;
use Spatie\MediaLibrary\Models\Media;
use App\Translations\ExcursionsTranslation;

class ExcursionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excursions = Excursions::getAll();
        $languages = Language::getAll();

        return view('admin/excursions/index', compact('excursions', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $excursion = new Excursions();
        $action = 'create';
        $form_data = array('route' => 'admin.excursions.store', 'method' => 'POST');
        $excursionType = ExcursionsTypes::getLists();
        $destination = Destination::getLists();
        $currencies = Currency::getAll();
        $availability = Availability::getLists();
        $duration = Duration::getLists();

        $languages = Language::getAll();
        
        return view('admin/excursions/create', compact('action', 'excursion',  'form_data', 'languages', 'excursionType', 'currencies', 'destination', 'availability', 'duration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExcursion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExcursion $request)
    {      
        $data = $request->validated();

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;

        $excursion = Excursions::create($data);

        $this->storeLanguages($excursion->id, $data);
        $this->storeCurrencies($excursion->id, $data);
        $this->storeImages($excursion, $data);

        return redirect()->route('admin.excursions.index');
    }

    private function storeLanguages($id, $data)
    {
        $languages = Language::getAll();

        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {
                ExcursionsTranslation::create([
                    'fk_language' => $data['fk_language_' . $language->id],
                    'fk_excursion' => $id,
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

                ExcursionsPrices::create([
                    'fk_currency' => $data['fk_currency_' . $currency->id],
                    'fk_excursion' => $id,
                    'price' => $data['price_' . $currency->id],
                    'discount' => $data['discount_' . $currency->id],
                    'is_active' => isset($data['is_active_' . $currency->id]) ? true : false
                ]);
            }
        }  
    }

    private function storeImages($model, $data) {
      if (isset($data['images'])) {
        foreach ($data['images'] as $file) {
          $model->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('products');
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

        return view('admin/excursions/edit', compact('action', 'excursion', 'form_data', 'languages', 'excursionTranslation', 'excursionType', 'currencies', 'excursionPrice', 'destination', 'availability', 'duration'));
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

    private function updateLanguages($id, $data)
    {
        $languages = Language::getAll();
        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {

                $where = array(
                    ['fk_language', $data['fk_language_' . $language->id]],
                    ['fk_excursion', $id]
                );

                $excursionTranslation = ExcursionsTranslation::getUpdate($where);

                $excursionTranslation->fill([
                    'name' => $data['name_' . $language->id],
                    'summary' => $data['summary_' . $language->id],
                    'body' => $data['body_' . $language->id]
                ])->save();
            }            
        }
    }

    private function updateCurrencies($id, $data) {
        $currencies = Currency::getAll();
        foreach ($currencies as $currency) {
            if (isset($data['fk_currency_' . $currency->id]) && $data['price_' . $currency->id] != null) {

                $where = array(
                    ['fk_currency', $data['fk_currency_' . $currency->id]],
                    ['fk_excursion', $id]
                );

                $excursionType = ExcursionsPrices::getUpdate($where);

                if (is_null($excursionType)) {
                    ExcursionsPrices::create([
                        'fk_currency' => $data['fk_currency_' . $currency->id],
                        'fk_excursion' => $id,
                        'price' => $data['price_' . $currency->id],
                        'discount' => $data['discount_' . $currency->id],
                        'is_active' => isset($data['is_active_' . $currency->id]) ? 1 : 0
                    ]);
                } else {
                    $excursionType->fill([
                        'price' => $data['price_' . $currency->id],
                        'discount' => $data['discount_' . $currency->id],
                        'is_active' => isset($data['is_active_' . $currency->id]) ? 1 : 0
                    ])->save();
                }
            }            
        }
    }

    private function updateImage($id, $data) {
      if (isset($data['delete'])) {
        try {
            Media::whereIn('id', $data['delete'])->delete();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar las imagenes!')->flash();
        }  
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $excursion = Excursions::findOrFail($id);

        try {
            ExcursionsTranslation::where('fk_excursion', $id)->delete();
            ExcursionsPrices::where('fk_excursion', $id)->delete();
            $excursion->delete();

            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.excursions.index');
    }
}