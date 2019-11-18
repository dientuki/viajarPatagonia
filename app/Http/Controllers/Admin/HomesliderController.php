<?php

namespace App\Http\Controllers\Admin;

use Exception;

use App\Homeslider;
use Illuminate\Http\Request;
use App\Translations\Language;
use App\Http\Requests\StoreSlider;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditHomeslider;
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
        
        return view('admin/homeslider/create', compact('action', 'homeslider',  'form_data', 'languages'));
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

        $slider = Homeslider::create($data);

        $this->storeLanguages($slider->id, $data);
        $this->storeImages($slider, $data);

        return redirect()->route('admin.homeslider.index');
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

        return view('admin/homeslider/edit', compact('action', 'homeslider', 'form_data', 'languages', 'homesliderTranslation'));
    }    

    public function destroy() {}

    public function order(Request $request) {
      $data = json_decode($request->getContent(), true);

      foreach($data as $order) {
        Homeslider::updateOrder($order['id'], $order['order']);
      }
    }
}