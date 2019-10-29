<?php

namespace App;

use App\Package2destination;
use Illuminate\Database\Eloquent\Model;

class Package2destination extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'package2destination';

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
    protected $fillable = ['fk_package', 'fk_destination'];    

    static function getAll($package) {
      return Package2destination::select('fk_destination')->where('fk_package', $package)->orderBy('fk_destination')->pluck('fk_destination')->all();
    }
  }