<?php

namespace App;

use App\Package2excursion;
use Illuminate\Database\Eloquent\Model;

class Package2excursion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'package2excursion';

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
    protected $fillable = ['fk_package', 'fk_excursion'];    

    static function getAll($package) {
      return Package2excursion::select('fk_excursion')->where('fk_package', $package)->orderBy('fk_excursion')->pluck('fk_excursion')->all();
    }
  }