<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
      $cruiseshipsTypes = CruiseshipsTypes::select('cruiseships_types.id', 'cruiseships_types_translation.type', 'languages.iso')
          ->join('cruiseships_types_translation', 'cruiseships_types.id', '=', 'cruiseships_types_translation.fk_cruiseships_type')
          ->join('languages', 'languages.id', '=', 'cruiseships_types_translation.fk_language');
          //->orderBy('cruiseships_types.id');
  
      return $cruiseshipsTypes->get();
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

        $result = CruiseshipsTypes::select('id')
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
