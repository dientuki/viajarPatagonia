<?php

namespace App;

use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;
use App\Translations\ExcursionsTypesTranslation;
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

    static public function getAll(){
      $request = request();
      $excursionsTypes = ExcursionsTypes::select('excursions_types.id');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $excursionsTypes->addSelect("ct$language->id.type as type$language->id", "l$language->id.iso as iso$language->id")
          ->join("excursions_types_translation as ct$language->id", 'excursions_types.id', '=', "ct$language->id.fk_excursion_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $excursionsTypes->orderBy('excursions_types.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $excursionsTypes->orderBy('excursions_types.id', 'desc');
        $queries['order'] = 'desc';
      }        

      return $excursionsTypes->simplePaginate(20)->appends($queries);
    }

    static function getLists() {
      return ExcursionsTypesTranslation::orderBy('type')
        ->where('fk_language', '1')
        ->pluck('type', 'fk_excursion_type');
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