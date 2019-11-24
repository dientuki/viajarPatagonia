<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class CruiseshipsTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cruiseships_translation';

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
    protected $fillable = ['fk_language', 'fk_cruiseship', 'name', 'summary', 'body'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }

    static function getName($fk) {
      return CruiseshipsTranslation::where('fk_cruiseship', $fk)
        ->where('fk_language', 1)
        ->limit(1)
        ->value('name');          
    }

    static function getEdit($id){

      return CruiseshipsTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where('fk_cruiseship', $id)
        ->orderBy('fk_language')
        ->get();
    }    

    static function getUpdate($where){

      return CruiseshipsTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where($where)
        ->get()->first();
    }    
}
