<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

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
    protected $fillable = ['sign', 'code', 'currency', 'amount'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

        $result = Currency::select('id', 'sign', 'code', 'currency', 'amount')
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
