<?php

namespace App;

use App\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExcursionsTypes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'excursions_types';

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
    //protected $fillable = ['region'];    

    static public function getAll(){
      $excursionsTypes = ExcursionsTypes::select('excursions_types.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $excursionsTypes->addSelect("ct$language->id.type as type$language->id", "l$language->id.iso as iso$language->id")
          ->join("excursions_types_translation as ct$language->id", 'excursions_types.id', '=', "ct$language->id.fk_excursion_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $excursionsTypes->get();
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $excursionsTypes = ExcursionsTypes::select('excursions_types.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $excursionsTypes->addSelect("ct$language->id.type as language_$language->id", "l$language->id.id as fk_language_$language->id")
          ->join("excursions_types_translation as ct$language->id", 'excursions_types.id', '=', "ct$language->id.fk_excursion_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      $result = $excursionsTypes->where('excursions_types.id', $id)->get()->first();
  
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