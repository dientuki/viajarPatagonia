<?php

namespace App;

use App\PackagePrices;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PackagePrices extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages_prices';

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
    protected $fillable = ['price', 'discount', 'is_active', 'fk_currency', 'fk_package'];    

    static function getEdits($where){

      $result = PackagePrices::select('id', 'price', 'discount', 'is_active', 'fk_currency');

      if (is_array($where)) {
        $result->where($where);
      } else {
        $result->where('fk_package', $where);
        $result->orderBy('fk_currency');
      }
    
      return $result->get();
  
      //Laravel 4 fallback
      return abort(404);
  
      //throw (new ModelNotFoundException)->setModel(get_class($this->model));
    }

    static function getEdit($id){

      return PackagePrices::select('id', 'price', 'discount', 'is_active', 'fk_currency')
        ->where('fk_package', $id)
        ->orderBy('fk_currency')
        ->get();
    }    

    static function getUpdate($where){

      return PackagePrices::select('id', 'price', 'discount', 'is_active', 'fk_currency')
        ->where($where)
        ->get()->first();
    }   

    static function getPrice($id) {
      $results = null;
      $price = PackagePrices::select('packages_prices.id', 'price', 'discount', 'is_active', 'currencies.iso', 'currencies.amount');
      $price->join("currencies", 'currencies.id', '=', "packages_prices.fk_currency");
      $price->where('fk_package', $id);

      if (session()->has('currency')) {
        $currency = clone $price;
        $return = $currency->where('fk_currency', session('currency')['id'])->get()->first();
        if ($return != null) {
          return $return;
        }
      }      

      $dolar = Currency::getDolar();
      $price->where('fk_currency', $dolar);
      return $price->get()->first();
    }      
    
}