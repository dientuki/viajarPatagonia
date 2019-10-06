<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'destinations';

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
    protected $fillable = ['destination', 'fk_region'];    

    static function getLists() {
      //return Region::orderBy('region')->lists('region', 'id');
    }

    static public function getAll(){
      $destinations = Destination::select('destinations.id', 'destinations.destination', 'regions.region')
          ->join('regions', 'regions.id', '=', 'destinations.fk_region')
          ->orderBy('regions.region')->orderBy('destinations.destination');
  
      return $destinations->get();
    }
  

    static function getEdit($id){

        $result = Destination::select('id', 'destination', 'fk_region')
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
