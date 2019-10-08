<?php

namespace App;

use App\Language;
use App\CruiseshipsTypes;
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['region'];    

    static public function getAll(){
      $cruiseshipsTypes = CruiseshipsTypes::select('cruiseships_types.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $cruiseshipsTypes->addSelect("ct$language->id.type as type$language->id", "l$language->id.iso as iso$language->id")
          ->join("cruiseships_types_translation as ct$language->id", 'cruiseships_types.id', '=', "ct$language->id.fk_cruiseships_type")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $cruiseshipsTypes->get();
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

        $cruiseshipsTypes = CruiseshipsTypes::select('cruiseships_types.id', 'cruiseships_types_translation.type', 'languages.iso')
          ->join('cruiseships_types_translation', 'cruiseships_types.id', '=', 'cruiseships_types_translation.fk_cruiseships_type')
          ->join('languages', 'languages.id', '=', 'cruiseships_types_translation.fk_language')
          ->where('id', $id)
          ->get()->first();
    
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
