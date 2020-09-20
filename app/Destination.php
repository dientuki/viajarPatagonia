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
      return Destination::orderBy('destination')->pluck('destination', 'id');
    }

    static function getListsByRegions() {
      $request = request();
      if ($request->has('region')) {
        return Destination::orderBy('destination')
          ->join("regions", 'regions.id', '=', "fk_region")
          ->where('fk_region', $request->get('region'))
          ->pluck('destination', 'destinations.id');
      } else {
        return Destination::orderBy('destination')->pluck('destination', 'id');
      }
    }    

    static public function getAll(){
      $request = request();
      $queries = [];

      $destinations = Destination::select('destinations.id', 'destinations.destination', 'regions.region')
          ->join('regions', 'regions.id', '=', 'destinations.fk_region');
          //->orderBy('regions.region')->orderBy('destinations.destination');

      if ($request->has('order')) {
        $destinations->orderBy('regions.region', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $destinations->orderBy('regions.region', 'asc');
        $queries['order'] = 'asc';
      }            
  
      return $destinations->simplePaginate(20)->appends($queries);
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
