<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class CruiseshipsTypesTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cruiseships_types_translation';

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
    protected $fillable = ['fk_language', 'fk_cruiseships_type', 'type'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    }  
    
}
