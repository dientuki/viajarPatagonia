<?php

namespace App;

use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;
use App\Translations\AvailabilityTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Availability extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'availability';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    static public function getAll(){
      $request = request();
      $availability = Availability::select('availability.id');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $availability->addSelect("ct$language->id.availability as availability$language->id", "l$language->id.iso as iso$language->id")
          ->join("availability_translation as ct$language->id", 'availability.id', '=', "ct$language->id.fk_availability")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $availability->orderBy('availability.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $availability->orderBy('availability.id', 'desc');
        $queries['order'] = 'desc';
      }  

      return $availability->simplePaginate(20)->appends($queries);
    }

    static function getLists() {
      return AvailabilityTranslation::orderBy('availability')
        ->where('fk_language', '1')
        ->pluck('availability', 'fk_availability');
    }  

    static function getEdit($id){

      $availability = Availability::select('availability.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $availability->addSelect("ct$language->id.availability as language_$language->id", "l$language->id.id as fk_language_$language->id")
          ->join("availability_translation as ct$language->id", 'availability.id', '=', "ct$language->id.fk_availability")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      $result = $availability->where('availability.id', $id)->get()->first();
  
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