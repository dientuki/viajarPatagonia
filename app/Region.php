<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regions';

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
    protected $fillable = ['region'];    

    static function getAll() {
      $request = request();
      $queries = [];
      
      $regions = Region::select('id', 'region');
      
      if ($request->has('order')) {
        $regions->orderBy('id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $regions->orderBy('id', 'desc');
        $queries['order'] = 'desc';
      }  

      return $regions->simplePaginate(20)->appends($queries);      
    }

    static function getLists() {
      return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $result = Region::select('id', 'region')
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
