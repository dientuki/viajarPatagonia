<?php

namespace App;

use App\Translations\Language;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Packages extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

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
    protected $fillable = ['is_active', 'map'];    

    static public function getAll(){
      $packages = Packages::select('packages.id', 'packages.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $packages->addSelect("ct$language->id.name as title$language->id")
          ->join("packages_translation as ct$language->id", 'packages.id', '=', "ct$language->id.fk_package")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $packages->get();
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $package = Packages::select('id', 'is_active', 'map');
      $result = $package->where('id', $id)->get()->first();
  
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

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('backoffice')
          ->fit(Manipulations::FIT_CROP, 120, 120)
          ->optimize();
    
    }
  }