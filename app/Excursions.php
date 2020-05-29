<?php

namespace App;

use App\Currency;
use App\ExcursionsPrices;
use App\Package2destination;
use App\Http\Helpers\Helpers;
use App\Translations\Language;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Translations\ExcursionsTranslation;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Excursions extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'excursions';

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
    protected $fillable = ['is_active', 'map', 'fk_excursion_type', 'fk_destination', 'fk_availability', 'fk_duration'];    

    static public function getAll(){
      $request = request();
      $excursions = Excursions::select('excursions.id', 'excursions.is_active');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $excursions->addSelect("ct$language->id.name as title$language->id")
          ->join("excursions_translation as ct$language->id", 'excursions.id', '=', "ct$language->id.fk_excursion")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $excursions->orderBy('excursions.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $excursions->orderBy('excursions.id', 'desc');
        $queries['order'] = 'desc';
      }        

      return $excursions->simplePaginate(20)->appends($queries);
    }

    static public function getSlider(){
      return Excursions::orderBy('name')
        ->join("excursions_translation", 'excursions.id', '=', "fk_excursion")
        ->where('excursions.is_active', 1)
        ->where('fk_language', 1)
        ->pluck('name', 'excursions.id');
    }        

    static function getLists() {
      return ExcursionsTranslation::orderBy('name')
        ->where('fk_language', request()->session()->get('locale')['id'])
        ->pluck('name', 'fk_excursion');
    }  

    static function getPackageCombo() {
      $excursions = Excursions::select('excursions.id as id', 'excursions_translation.name as name', 'fk_destination');
      $excursions->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $excursions->where('is_active', true);
      $excursions->where('fk_language', '1');
      $excursions->orderBy('name');

      return $excursions->get();
    }     

    static function getEdit($id){

      $excursions = Excursions::select('id', 'is_active', 'map', 'fk_excursion_type', 'fk_destination', 'fk_availability', 'fk_duration');
      $result = $excursions->where('id', $id)->get()->first();
  
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  
      //Laravel 4 fallback
      return abort(404);
    }

    static function getList($limit = false) {
      $request = request();
      $queries = [];
      $columns = array('duration', 'destination');      
      
      $list = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary', 'availability_translation.availability', 'duration_translation.duration');
      $list->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $list->join("languages", 'languages.id', '=', "excursions_translation.fk_language");

      $list->join("availability", 'availability.id', '=', "excursions.fk_availability");
      $list->join("availability_translation", 'availability.id', '=', "availability_translation.fk_availability");
      $list->join("languages as la", 'la.id', '=', "availability_translation.fk_language");

      $list->join("duration", 'duration.id', '=', "excursions.fk_duration");
      $list->join("duration_translation", 'duration.id', '=', "duration_translation.fk_duration");
      $list->join("languages as ld", 'ld.id', '=', "duration_translation.fk_language");      

      $list->where('is_active', 1)
        ->where('languages.iso', App::getLocale())
        ->where('la.iso', App::getLocale())
        ->where('ld.iso', App::getLocale());

      foreach ($columns as $column) {
        if ($request->has($column)) {
          $list->where('excursions.fk_'.$column, $request->get($column));
          $queries[$column] = $request->get($column);
        }
      }

      if ($limit != false) {
        $list = $list->limit($limit)->get();
      } else {
        $list = $list->simplePaginate(10)->appends($queries);      
      }

      return $list;
    }    

    static function getShow($id) {
      $excursion = Excursions::select('excursions.id', 'map', 'excursions_translation.name', 'excursions_translation.summary', 'excursions_translation.body');
      $excursion->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $excursion->join("languages", 'languages.id', '=', "excursions_translation.fk_language");
      $excursion->where([
        ['excursions.id', '=', $id],
        ['languages.iso', '=', App::getLocale()]
      ]);

      return $excursion->get()->first();
    }  
    
    public function getBodyHtmlAttribute() {
      return Helpers::draft2html($this->attributes['body']);
    }    

    static function getRelatedPackage($id) {
      $home = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary', 'availability_translation.availability', 'duration_translation.duration');
      $home->join("package2excursion", 'excursions.id', '=', "package2excursion.fk_excursion");

      $home->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $home->join("languages", 'languages.id', '=', "excursions_translation.fk_language");
      
      $home->join("availability", 'availability.id', '=', "excursions.fk_availability");
      $home->join("availability_translation", 'availability.id', '=', "availability_translation.fk_availability");
      $home->join("languages as la", 'la.id', '=', "availability_translation.fk_language");

      $home->join("duration", 'duration.id', '=', "excursions.fk_duration");
      $home->join("duration_translation", 'duration.id', '=', "duration_translation.fk_duration");
      $home->join("languages as ld", 'ld.id', '=', "duration_translation.fk_language");

      $home->where('is_active', 1)
        ->where('languages.iso', App::getLocale())
        ->where('la.iso', App::getLocale())
        ->where('ld.iso', App::getLocale())
        ->where('package2excursion.fk_package', $id);
      
      return $home->limit(3)->get();
    }

    static function getUnrelatedPackage($id) {
      $currentDestinations = Package2destination::orderBy('id')->where('fk_package', $id)->pluck('fk_destination');
      $currentExcursions = Package2excursion::orderBy('id')->where('fk_package', $id)->pluck('fk_excursion');
      
      $home = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary', 'availability_translation.availability', 'duration_translation.duration');
      $home->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $home->join("languages", 'languages.id', '=', "excursions_translation.fk_language");
      //$home->join("package2excursion", 'excursions.id', '=', "package2excursion.fk_excursion");

      $home->join("availability", 'availability.id', '=', "excursions.fk_availability");
      $home->join("availability_translation", 'availability.id', '=', "availability_translation.fk_availability");
      $home->join("languages as la", 'la.id', '=', "availability_translation.fk_language");

      $home->join("duration", 'duration.id', '=', "excursions.fk_duration");
      $home->join("duration_translation", 'duration.id', '=', "duration_translation.fk_duration");
      $home->join("languages as ld", 'ld.id', '=', "duration_translation.fk_language");      

      $home->where('is_active', 1)
        ->where('languages.iso', App::getLocale())
        ->where('la.iso', App::getLocale())
        ->where('ld.iso', App::getLocale())        
        ->whereNotIn('excursions.id', $currentExcursions)
        ->whereIn('excursions.fk_destination', $currentDestinations);
      
      return $home->limit(3)->get();
    }

    static function getRelated($id) {
      $currentDestinations = Package2destination::orderBy('id')->where('fk_package', $id)->pluck('fk_destination');

      $home = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary');
      $home->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $home->join("languages", 'languages.id', '=', "excursions_translation.fk_language");


      $home->where('is_active', 1)
        ->where('languages.iso', App::getLocale())
        ->whereIn('excursions.fk_destination', $currentDestinations);   
        
      return $home->limit(3)->get();        
    }

    public function getPrice(){
      $price = ExcursionsPrices::getPrice($this->id);
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
      return ExcursionsTranslation::where('fk_excursion', $id)
        ->where('fk_language', session('locale')['id'])
        ->pluck('name');
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