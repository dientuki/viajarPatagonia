<?php

namespace App;

use App\Translations\Language;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Homesliders extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homesliders';

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
      $homesliders = Homesliders::select('homesliders.id', 'homesliders.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $homesliders->addSelect("ct$language->id.title as title$language->id")
          ->join("homesliders_translation as ct$language->id", 'homesliders.id', '=', "ct$language->id.fk_homeslider")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $homesliders->get();
    }

    static function getEdit($id){

      $homesliders = homesliders::select('id', 'is_active', 'map', 'fk_excursion_type', 'fk_destination', 'fk_availability', 'fk_duration');
      $result = $homesliders->where('id', $id)->get()->first();
  
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