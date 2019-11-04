<?php

namespace App;

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
    protected $fillable = ['is_active', 'map', 'fk_excursion_type', 'fk_destination'];    

    static public function getAll(){
      $excursions = Excursions::select('excursions.id', 'excursions.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $excursions->addSelect("ct$language->id.name as title$language->id")
          ->join("excursions_translation as ct$language->id", 'excursions.id', '=', "ct$language->id.fk_excursion")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $excursions->get();
    }

    static function getLists() {
      return ExcursionsTranslation::orderBy('name')
        ->where('fk_language', '1')
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

      $excursions = Excursions::select('id', 'is_active', 'map', 'fk_excursion_type', 'fk_destination');
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

    static function getHome() {
      $home = Excursions::select('excursions.id', 'excursions_translation.name', 'excursions_translation.summary');
      $home->join("excursions_translation", 'excursions.id', '=', "excursions_translation.fk_excursion");
      $home->join("languages", 'languages.id', '=', "excursions_translation.fk_language");
      $home->where('is_active', 1)->where('languages.iso', App::getLocale());

      return $home->limit(4)->get();
    }    

    public function getPrice() {
      return 'ARS ' . number_format(rand(5000, 199999), 0, null, '.');
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