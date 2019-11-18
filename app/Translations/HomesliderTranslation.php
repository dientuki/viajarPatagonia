<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class HomesliderTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'homeslider_translation';

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
    protected $fillable = ['fk_language', 'fk_slider', 'title', 'date', 'description'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }

    static function getEdit($id){

      return HomesliderTranslation::select('id', 'fk_language', 'title', 'date', 'description')
        ->where('fk_slider', $id)
        ->orderBy('fk_language')
        ->get();
    }    

    static function getUpdate($where){

      return HomesliderTranslation::select('id', 'fk_language', 'title', 'date', 'description')
        ->where($where)
        ->get()->first();
    }    
}
