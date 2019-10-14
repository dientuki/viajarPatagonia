<?php

namespace App;

use App\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cruiseships extends Model
{
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
      $cruiseships = Cruiseships::select('cruiseships.id', 'cruiseships.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $cruiseships->addSelect("ct$language->id.title as title$language->id")
          ->join("cruiseships_translation as ct$language->id", 'cruiseships.id', '=', "ct$language->id.fk_cruiseship")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $cruiseships->get();
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $cruiseship = Cruiseships::select('cruiseships.id', 'cruiseships.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $cruiseship->addSelect("ct$language->id.title as title_$language->id", "l$language->id.id as fk_language_$language->id")
          ->join("cruiseships_translation as ct$language->id", 'cruiseships.id', '=', "ct$language->id.fk_cruiseship")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      $result = $cruiseship->where('cruiseships.id', $id)->get()->first();
  
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
    
}