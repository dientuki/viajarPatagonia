<?php

namespace App;

use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExcursionsPrices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'excursions_prices';

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
    protected $fillable = ['price', 'discount', 'is_active', 'fk_currency', 'fk_excursion'];    

    static function getEdits($where){

      $result = ExcursionsPrices::select('id', 'price', 'discount', 'is_active', 'fk_currency');

      if (is_array($where)) {
        $result->where($where);
      } else {
        $result->where('fk_excursion', $where);
        $result->orderBy('fk_currency');
      }
    
      return $result->get();
  
      //Laravel 4 fallback
      return abort(404);
  
      //throw (new ModelNotFoundException)->setModel(get_class($this->model));
    }

    static function getEdit($id){

      return ExcursionsPrices::select('id', 'price', 'discount', 'is_active', 'fk_currency')
        ->where('fk_excursion', $id)
        ->orderBy('fk_currency')
        ->get();
    }    

    static function getUpdate($where){

      return ExcursionsPrices::select('id', 'price', 'discount', 'is_active', 'fk_currency')
        ->where($where)
        ->get()->first();
    }    

    static function getPrice($id) {
      $result = null;
      $price = ExcursionsPrices::select('price', 'discount', 'is_active', 'currencies.iso', 'currencies.amount');
      $price->join("currencies", 'currencies.id', '=', "excursions_prices.fk_currency");
      $price->where('fk_excursion', $id);

      if (session()->has('appcurrency')) {
        $price->where('fk_currency', Session::get('appcurrency'));
        $result = $price->get()->first();
      }

      
      dd($price->toSql());
      if ($result == null || session()->has('appcurrency') == false ) {
        $price->where('currencies.iso', 'ars');
        $result = $price->get()->first();
      }

      return $result;

      /*
            $result = null;
      $currency = 'ars';

      if (session()->has('currency') == false) {
        $currency = session()->get('currency');
      } else {
        session()->set('currency', $currency);
      }


      $price = PackagePrices::select('price', 'discount', 'is_active', 'currencies.iso');
      $price->join("currencies", 'currencies.id', '=', "packages_prices.fk_currency");
      
      $tmp = $price;
      $tmp->where('currencies.iso', $currency);
      $result = $tmp->get()->first();

      if ($result == null) {
        $tmp = $price;
        $tmp->where('currencies.iso', 'usd');
        $result = $tmp->get()->first();
      }

      return $result;
      */

    }    
    
}