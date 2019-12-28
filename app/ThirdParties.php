<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdParties extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'third_parties';

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
    protected $fillable = ['name', 'code', 'is_active'];    

    static public function getAll(){
      $request = request();
      $queries = [];

      $thirdParties = ThirdParties::select('id', 'name', 'code', 'is_active');

      if ($request->has('order')) {
        $thirdParties->orderBy('id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $thirdParties->orderBy('id', 'asc');
        $queries['order'] = 'asc';
      }            
  
      return $thirdParties->simplePaginate(20)->appends($queries);
    }

    static function getEdit($id){

      $result = ThirdParties::select('id', 'name', 'code', 'is_active')
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

    static function getValue($key) {
      return ThirdParties::where('name', $key)
        ->where('is_active', 1)
        ->limit(1)
        ->value('code');
    }
}
