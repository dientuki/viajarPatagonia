<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class ExcursionsTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'excursions_translation';

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
    protected $fillable = ['fk_language', 'fk_excursion', 'name', 'summary', 'body'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }

    static function getEdit($id){

      return ExcursionsTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where('fk_excursion', $id)
        ->orderBy('fk_language')
        ->get();
    }    

    static function getName($fk) {
      return ExcursionsTranslation::where('fk_excursion', $fk)
        ->where('fk_language', 1)
        ->limit(1)
        ->value('name');          
    }    

    static function getUpdate($where){

      return ExcursionsTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where($where)
        ->get()->first();
    }    
}
