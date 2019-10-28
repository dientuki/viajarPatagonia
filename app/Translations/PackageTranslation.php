<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class PackageTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'packages_translation';

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
    protected $fillable = ['fk_language', 'fk_package', 'name', 'summary', 'body'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }

    static function getEdit($id){

      return PackageTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where('fk_package', $id)
        ->orderBy('fk_language')
        ->get();
    }    

    static function getUpdate($where){

      return PackageTranslation::select('id', 'fk_language', 'name', 'summary', 'body')
        ->where($where)
        ->get()->first();
    }    
}
