<?php

namespace App;

use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CruiseshipsTypes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cruiseships_types';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    static public function getAll(){
      $request = request();
      $cruiseshipsTypes = CruiseshipsTypes::select('cruiseships_types.id');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $cruiseshipsTypes->addSelect("ct$language->id.type as type$language->id", "l$language->id.iso as iso$language->id")
          ->join("cruiseships_types_translation as ct$language->id", 'cruiseships_types.id', '=', "ct$language->id.fk_cruiseship_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $cruiseshipsTypes->orderBy('cruiseships_types.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $cruiseshipsTypes->orderBy('cruiseships_types.id', 'desc');
        $queries['order'] = 'desc';
      }  

      return $cruiseshipsTypes->simplePaginate(20)->appends($queries);
    }

    static function getLists() {
      $cruiseshipsTypes = CruiseshipsTypes::join('cruiseships_types_translation', 'cruiseships_types.id', '=', 'cruiseships_types_translation.fk_cruiseship_type');
      $cruiseshipsTypes->join('languages', 'languages.id', '=', 'cruiseships_types_translation.fk_language');
      $cruiseshipsTypes->where('languages.iso', 'es');
      $cruiseshipsTypes->orderBy('cruiseships_types_translation.type');

      return $cruiseshipsTypes->pluck('cruiseships_types_translation.type', 'cruiseships_types.id');
    }  

    static function getEdit($id){

      $cruiseshipsTypes = CruiseshipsTypes::select('cruiseships_types.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $cruiseshipsTypes->addSelect("ct$language->id.type as language_$language->id", "l$language->id.id as fk_language_$language->id")
          ->join("cruiseships_types_translation as ct$language->id", 'cruiseships_types.id', '=', "ct$language->id.fk_cruiseship_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      $result = $cruiseshipsTypes->where('cruiseships_types.id', $id)->get()->first();
  
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