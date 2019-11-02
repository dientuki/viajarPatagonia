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
      $result = null;
      $price = PackagePrices::select('price', 'discount', 'is_active', 'currencies.iso');
      $price->join("currencies", 'currencies.id', '=', "packages_prices.fk_currency");

      if (session()->has('appcurrency')) {
        $price->where('fk_currency', Session::get('appcurrency'));
        $result = $price->get()->first();
      }
      
      if ($result == null || session()->has('appcurrency') == false ) {
        $price->where('currencies.iso', 'ars');
        $result = $price->get()->first();
      }

      return $result;

    }
    
}