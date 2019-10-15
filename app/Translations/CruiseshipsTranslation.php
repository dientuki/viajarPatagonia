<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class CruiseshipsTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cruiseships_translation';

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
    protected $fillable = ['fk_language', 'fk_cruiseship', 'title', 'dropline', 'body'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }

    static function getEdits($where){

      $result = CruiseshipsTranslation::select('id', 'fk_language', 'fk_cruiseship', 'title', 'dropline', 'body');

      if (is_array($where)) {
        $result->where($where);
      } else {
        $result->where('fk_cruiseship', $where);
        $result->orderBy('fk_language');
      }
    
      return $result->get();
  /*
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  */
      //Laravel 4 fallback
      return abort(404);
  
      //throw (new ModelNotFoundException)->setModel(get_class($this->model));
    }    
}
