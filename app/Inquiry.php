<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inquiries';

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
    protected $fillable = ['region'];   
    
    static function getAll() {
      $inquiries = Inquiry::select('inquiries.id', 'name', 'timestamp', 'product', 'product_id', 'languages.iso', 'is_readed', 'comment');
      $inquiries->join("languages", "languages.id", '=', "inquiries.fk_language");


      return $inquiries->get();
    }

    static function getEdit($id){

      $result = Inquiry::select('id', 'region')
          ->where('id', $id)
          ->get()->first();
  
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  
      //Laravel 4 fallback
      return abort(404);
  
      //throw (new ModelNotFoundException)->setModel(get_class($this->model));
    }
    
}
