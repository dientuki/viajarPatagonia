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
    protected $fillable = ['sign', 'iso', 'currency', 'amount'];    

    static function getOrder() {
      return Currency::select('id', 'iso')->orderBy('order')->get();
    }

    static function getDefault($iso){
      return Currency::where('iso', $iso)->value('id');
    }

    static function getDolar() {
      return Currency::where('iso', 'USD')->value('id');
    }

    static function getAmount($id) {
      return Currency::where('id', $id)->value('amount');
    }

    static function getAll() {
      $request = request();
      $queries = [];

      $currencies = Currency::select('id', 'sign', 'iso', 'currency', 'amount');

      return $currencies->orderBy('order')->simplePaginate(20);
      
    }

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $result = Currency::select('id', 'sign', 'iso', 'currency', 'amount')
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

    static function updateOrder($id, $order) {
      Currency::where('id', $id)->update(['order' => $order]);
    }    
    
}
