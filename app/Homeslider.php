<?php

namespace App;

use App\Translations\Language;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Homeslider extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homeslider';

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
    protected $fillable = ['is_active', 'url', 'hotel', 'stars', 'order'];

    static public function getAll(){
      $homeslider = Homeslider::select('homeslider.id', 'homeslider.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $homeslider->addSelect("ct$language->id.title as title$language->id")
          ->join("homeslider_translation as ct$language->id", 'homeslider.id', '=', "ct$language->id.fk_slider")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $homeslider->orderBy('homeslider.order')->get();
    }

    static function getEdit($id){

      $homeslider = Homeslider::select('id', 'is_active', 'url', 'hotel', 'stars', 'order');
      $result = $homeslider->where('id', $id)->get()->first();
  
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