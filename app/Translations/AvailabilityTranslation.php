<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class AvailabilityTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'availability_translation';

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
    protected $fillable = ['fk_language', 'fk_availability', 'availability'];    

    static function getLists() {
      return Region::orderBy('availability')->pluck('availability', 'id');
    }

    static function getEdit($where){

      $result = AvailabilityTranslation::select('id', 'fk_language', 'fk_availability', 'availability');

      if (is_array($where)) {
        $result->where($where);
      } else {
        $result->where('id', $id);
      }
    
      return $result->get()->first();
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
