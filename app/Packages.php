<?php

namespace App;

use App\Region;
use App\Currency;
use App\Packages;
use App\PackagePrices;
use App\Package2destination;
use App\Http\Helpers\Helpers;
use App\Translations\Language;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\App;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use App\Translations\PackageTranslation;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Packages extends Model implements HasMedia
{
  use HasMediaTrait;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages';

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
    protected $fillable = ['is_active', 'map'];    

    static public function getAll(){
      $request = request();
      $packages = Packages::select('packages.id', 'packages.is_active');
      $languages = Language::getAll();
      $queries = [];

      foreach ($languages as $language) {
        $packages->addSelect("ct$language->id.name as title$language->id")
          ->join("packages_translation as ct$language->id", 'packages.id', '=', "ct$language->id.fk_package")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      if ($request->has('order')) {
        $packages->orderBy('packages.id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $packages->orderBy('packages.id', 'desc');
        $queries['order'] = 'desc';
      }  

      return $packages->simplePaginate(20)->appends($queries);
    }

    static public function getSlider(){
      return Packages::orderBy('name')
        ->join("packages_translation", 'packages.id', '=', "fk_package")
        ->where('packages.is_active', 1)
        ->where('fk_language', 1)
        ->pluck('name', 'packages.id');
    }    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  

    static function getEdit($id){

      $package = Packages::select('id', 'is_active', 'map');
      $result = $package->where('id', $id)->get()->first();
  
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  
      //Laravel 4 fallback
      return abort(404);
    }

    static function getShow($id) {
      $package = Packages::select('packages.id', 'map', 'packages_translation.name', 'packages_translation.summary', 'packages_translation.body');
      $package->join("packages_translation", 'packages.id', '=', "packages_translation.fk_package");
      $package->join("languages", 'languages.id', '=', "packages_translation.fk_language");
      $package->where([
        ['packages.id', '=', $id],
        ['languages.iso', '=', App::getLocale()]
      ]);

      return $package->get()->first();
    }  
    
    static function getRelated($id) {
      $currentDestinations = Package2destination::orderBy('id')->where('fk_package', $id)->pluck('fk_destination');

      $related = Packages::select('packages.id', 'packages_translation.name', 'packages_translation.summary', 'package2destination.fk_destination');
      $related->join("packages_translation", 'packages.id', '=', "packages_translation.fk_package");
      $related->join("languages", 'languages.id', '=', "packages_translation.fk_language");
      $related->join("package2destination", 'packages.id', '=', "package2destination.fk_package");
      
      $related->where([
        ['packages.id', '!=', $id],
        ['languages.iso', '=', App::getLocale()],
      ])->whereIn('package2destination.fk_destination', $currentDestinations)->limit(3);

      return $related->get();
    }

    static function getList($limit = false) {
      $request = request();
      $queries = [];
      $columns = array('region', 'destination');    

      $list = Packages::select('packages.id', 'packages_translation.name', 'packages_translation.summary');
      $list->join("packages_translation", 'packages.id', '=', "packages_translation.fk_package");
      $list->join("languages", 'languages.id', '=', "packages_translation.fk_language");
      $list->where('is_active', 1)->where('languages.iso', App::getLocale());    
      
      if ($request->has('destination') || $request->has('region')) {
        $table = 'package2destination';

        $list->join('package2destination', 'packages.id', '=', "package2destination.fk_package");
        
        if ( $request->has('destination') ) {
          $list->where('package2destination.fk_destination', $request->get('destination'));
          $queries['destination'] = $request->get('destination');
        }     

        if ( $request->has('region') ) {
          $list->join('destinations', 'package2destination.fk_destination', '=', "destinations.fk_region");
          $list->where('destinations.fk_region', $request->get('region'));
          $queries['region'] = $request->get('region');
        }          
      }


      if ($limit != false) {
        $list = $list->limit($limit)->get();
      } else {
        $list = $list->simplePaginate(10)->appends($queries);   
      }

      return $list;
    }

    public function getPrice(){
      $price = PackagePrices::getPrice($this->id);
      $finalPrice = $price->is_active == 1 ? $price->discount : $price->price;
      $iso = $price->iso;

      if (session()->has('currency')) {
        if (session('currency')['iso'] != $price->iso) {
          $finalPrice = $finalPrice * Currency::getAmount(session('currency')['id']);
          $iso = session('currency')['iso'];
        }
      }

      return $iso . ' ' . ceil($finalPrice);
    }

    static function getName($id) {
      return PackageTranslation::where('fk_package', $id)
        ->where('fk_language', session('locale')['id'])
        ->pluck('name');
    }    

    public function getBodyHtmlAttribute() {
      return Helpers::draft2html($this->attributes['body']);
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('backoffice')
          ->fit(Manipulations::FIT_CROP, 120, 120)
          ->optimize();
    
        $this->addMediaConversion('slider')
          ->fit(Manipulations::FIT_CROP, 760, 420)
          ->optimize();       
          
        $this->addMediaConversion('preview')
          ->fit(Manipulations::FIT_CROP, 370, 204)
          ->optimize();               

        $this->addMediaConversion('facebook')
          ->fit(Manipulations::FIT_CROP, 500, 261)
          ->optimize();           
    }
  }