<?php

namespace App;

use App\Http\Helpers\Helpers;
use App\Translations\Language;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Translations\CruiseshipsTranslation;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cruiseships extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cruiseships';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['is_active', 'map', 'fk_cruiseship_type'];    

    static public function getAll(){
      $request = request();
      $cruiseships = Cruiseships::select('cruiseships.id', 'cruiseships.is_active');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $cruiseships->addSelect("ct$language->id.name as title$language->id")
          ->join("cruiseships_translation as ct$language->id", 'cruiseships.id', '=', "ct$language->id.fk_cruiseship")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $cruiseships->orderBy('cruiseships.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $cruiseships->orderBy('cruiseships.id', 'desc');
        $queries['order'] = 'desc';
      }        

      return $cruiseships->simplePaginate(20)->appends($queries);
    }

    static public function getSlider(){
      return Cruiseships::orderBy('name')
        ->join("cruiseships_translation", 'cruiseships.id', '=', "fk_cruiseship")
        ->where('cruiseships.is_active', 1)
        ->where('fk_language', 1)
        ->pluck('name', 'cruiseships.id');
    }    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $cruiseship = Cruiseships::select('id', 'is_active', 'map', 'fk_cruiseship_type');
      $result = $cruiseship->where('id', $id)->get()->first();
  
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  
      //Laravel 4 fallback
      return abort(404);
  
      //throw (new ModelNotFoundException)->setModel(get_class($this->model));
    }

    static function getShow($id) {
      $cruiseship = Cruiseships::select('cruiseships.id', 'map', 'cruiseships_translation.name', 'cruiseships_translation.summary', 'cruiseships_translation.body');
      $cruiseship->join("cruiseships_translation", 'cruiseships.id', '=', "cruiseships_translation.fk_cruiseship");
      $cruiseship->join("languages", 'languages.id', '=', "cruiseships_translation.fk_language");
      $cruiseship->where([
        ['cruiseships.id', '=', $id],
        ['languages.iso', '=', App::getLocale()]
      ]);

      return $cruiseship->get()->first();
    }

    static function getList($limit = false) {
      $list = Cruiseships::select('cruiseships.id', 'cruiseships_translation.name', 'cruiseships_translation.summary');
      $list->join("cruiseships_translation", 'cruiseships.id', '=', "cruiseships_translation.fk_cruiseship");
      $list->join("languages", 'languages.id', '=', "cruiseships_translation.fk_language");
      $list->where('is_active', 1)->where('languages.iso', App::getLocale());

      if ($limit != false) {
        $list = $list->limit($limit)->get();
      } else {
        $list = $list->simplePaginate(10);      
      }

      return $list;
    }

    static function getRelated($id) {
      $home = Cruiseships::select('cruiseships.id', 'cruiseships_translation.name', 'cruiseships_translation.summary');
      $home->join("cruiseships_translation", 'cruiseships.id', '=', "cruiseships_translation.fk_language");
      $home->join("languages", 'languages.id', '=', "cruiseships_translation.fk_cruiseship");
      $home->where('cruiseships.id', '!=', $id)->where('is_active', 1)->where('languages.iso', App::getLocale());

      return $home->get();
    }    
    
    
    public function getPrice(){
      $price = CruiseshipsPrices::getPrice($this->id);
      $finalPrice = $price->is_active == 1 ? $price->discount : $price->price;
      $iso = $price->iso;

      if (session()->has('currency')) {
        if (session('currency')['iso'] != $price->iso) {
          $finalPrice = $finalPrice * Currency::getAmount(session('currency')['id']);
          $iso = session('currency')['iso'];
        }
      }

      return $iso . ' ' . ceil($finalPrice);
    }

    static function getName($id) {
      return CruiseshipsTranslation::where('fk_cruiseship', $id)
        ->where('fk_language', session('locale')['id'])
        ->pluck('name');
    }      

    public function getBodyHtmlAttribute() {
      return Helpers::draft2html($this->attributes['body']);
    }      

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('backoffice')
          ->fit(Manipulations::FIT_CROP, 120, 120)
          ->optimize();
    
        $this->addMediaConversion('slider')
          ->fit(Manipulations::FIT_CROP, 760, 420)
          ->optimize();            

        $this->addMediaConversion('preview')
          ->fit(Manipulations::FIT_CROP, 370, 204)
          ->optimize();             

        $this->addMediaConversion('facebook')
          ->fit(Manipulations::FIT_CROP, 500, 261)
          ->optimize();            
    }
  }