<?php

namespace App\Http\Controllers\Admin;

use Exception;

use App\Packages;
use App\Excursions;
use App\Homeslider;
use App\Cruiseships;
use Illuminate\Http\Request;
use App\Translations\Language;
use App\Http\Requests\EditSlider;
use App\Http\Requests\StoreSlider;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Requests\CreateHomeslider;
use App\Translations\HomesliderTranslation;

class HomesliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeslider = Homeslider::getAll();
        $languages = Language::getAll();

        return view('admin/homeslider/index', compact('homeslider', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $homeslider = new Homeslider();
        $action = 'create';
        $form_data = array('route' => 'admin.homeslider.store', 'method' => 'POST');
        $languages = Language::getAll();
        $products = [
          'package' => Packages::getSlider(),
          'excursion' => Excursions::getSlider(),
          'cruiseships' => Cruiseships::getSlider()
        ];
        
        return view('admin/homeslider/create', compact('action', 'homeslider',  'form_data', 'languages', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExcursion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlider $request)
    {      
        $data = $request->validated();

        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['order'] = Homeslider::getLastOrder() + 1;
        $data['url'] = $this->buildUrl($data);

        $slider = Homeslider::create($data);

        $this->storeLanguages($slider->id, $data);
        $this->storeImages($slider, $data);

        return redirect()->route('admin.homeslider.index');
    }  

    private function buildUrl($data) {
      return isset($data['products']) ? $data['products'] : $data['urlstring'];
    }
    
    private function storeLanguages($id, $data)
    {
      $languages = Language::getAll();

      foreach ($languages as $language) {
        if (isset($data['fk_language_' . $language->id])) {
          HomesliderTranslation::create([
            'fk_language' => $data['fk_language_' . $language->id],
            'fk_slider' => $id,
            'title' => $data['title_' . $language->id],
            'date' => $data['date_' . $language->id],
            'description' => $data['description_' . $language->id]
          ]);
        }
      }
    }

    private function storeImages($model, $data) {
      if (isset($data['images'])) {
        $model->addMedia(storage_path('tmp/uploads/' . $data['images']))->toMediaCollection('sliderHome');
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
        $homeslider = Homeslider::find($id);
        $homesliderTranslation = HomesliderTranslation::getEdit($id);

        $action    = 'update';
        $form_data = array('route' => array('admin.homeslider.update', $homeslider->id), 'method' => 'PATCH');
        $languages = Language::getAll();
        $products = [
          'package' => Packages::getSlider(),
          'excursion' => Excursions::getSlider(),
          'cruiseships' => Cruiseships::getSlider()
        ];        

        return view('admin/homeslider/edit', compact('action', 'homeslider', 'form_data', 'languages', 'homesliderTranslation', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EditSlider  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSlider $request, $id)
    {
        $slider = Homeslider::getEdit($id);

        $data = $request->validated();
        
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['url'] = $this->buildUrl($data);

        $slider->fill($data)->save();

        $this->updateLanguages($id, $data);
        $this->updateImage($id, $data);
        $this->storeImages($slider, $data);

        return redirect()->route('admin.homeslider.index');
    }    

    private function updateLanguages($id, $data)
    {
        $languages = Language::getAll();
        foreach ($languages as $language) {
            if (isset($data['fk_language_' . $language->id])) {

                $where = array(
                    ['fk_language', $data['fk_language_' . $language->id]],
                    ['fk_slider', $id]
                );

                $excursionTranslation = HomesliderTranslation::getUpdate($where);

                $excursionTranslation->fill([
                    'title' => $data['title_' . $language->id],
                    'date' => $data['date_' . $language->id],
                    'description' => $data['description_' . $language->id]
                ])->save();
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
        $slider = Homeslider::findOrFail($id);

        try {
            HomesliderTranslation::where('fk_slider', $id)->delete();
            $slider->delete();

            Alert::success('Registro eliminado correctamente!')->flash();
        } catch (Exception $e) {
            Alert::error('No puedes eliminar el registro!')->flash();
        }  

        return redirect()->route('admin.homeslider.index');
    }

    public function order(Request $request) {
      $data = json_decode($request->getContent(), true);

      foreach($data as $order) {
        Homeslider::updateOrder($order['id'], $order['order']);
      }
    }
}