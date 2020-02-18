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
      $homeslider = Homeslider::select('homeslider.id', 'homeslider.is_active', 'homeslider.order');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $homeslider->addSelect("ct$language->id.title as title$language->id")
          ->join("homeslider_translation as ct$language->id", 'homeslider.id', '=', "ct$language->id.fk_slider")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }
      
      return $homeslider->orderBy('homeslider.order')->simplePaginate(20);
    }

    static function getHome() {
      $homeslider = Homeslider::select('homeslider.id', 'url', 'hotel', 'stars', 'title', 'date', 'description');
      $homeslider->join("homeslider_translation", 'homeslider.id', '=', "homeslider_translation.fk_slider");

      $homeslider->orderBy('order', 'ASC');
      $homeslider->where('homeslider.is_active', 1);
      $homeslider->where("homeslider_translation.fk_language", session('locale')['id']);

      return $homeslider->get();
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

    static function updateOrder($id, $order) {
      Homeslider::where('id', $id)->update(['order' => $order]);
    }

    static function getLastOrder() {
      return Homeslider::orderBy('order', 'DESC')
        ->limit(1)
        ->value('order');      
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('backoffice')
          ->fit(Manipulations::FIT_CROP, 120, 120)
          ->optimize();
    
        $this->addMediaConversion('slider_desktop')
          ->fit(Manipulations::FIT_CROP, 2000, 580)
          ->optimize();            

        $this->addMediaConversion('slider_tablet')
          ->fit(Manipulations::FIT_CROP, 1024, 297)
          ->optimize();        
          
        $this->addMediaConversion('slider_mobile')
          ->fit(Manipulations::FIT_CROP, 768, 223)
          ->optimize();            
    }
  }