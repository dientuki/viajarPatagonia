<?php

namespace App;

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
  }