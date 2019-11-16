<?php

namespace App;

use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;
use App\Translations\DurationTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Duration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'duration';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    static public function getAll(){
      $excursionsTypes = Duration::select('duration.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $excursionsTypes->addSelect("ct$language->id.duration as duration$language->id", "l$language->id.iso as iso$language->id")
          ->join("duration_translation as ct$language->id", 'duration.id', '=', "ct$language->id.fk_duration")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $excursionsTypes->get();
    }

    static function getLists() {
      return DurationTranslation::orderBy('duration')
        ->where('fk_language', '1')
        ->pluck('duration', 'fk_duration');
    }  

    static function getEdit($id){

      $excursionsTypes = Duration::select('duration.id');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $excursionsTypes->addSelect("ct$language->id.duration as language_$language->id", "l$language->id.id as fk_language_$language->id")
          ->join("duration_translation as ct$language->id", 'duration.id', '=', "ct$language->id.fk_duration")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      $result = $excursionsTypes->where('duration.id', $id)->get()->first();
  
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