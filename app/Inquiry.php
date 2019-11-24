<?php

namespace App;

use App\Translations\Language;
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

    static function getIso($id) {
      return Language::where('id', $id)
        ->limit(1)
        ->value('iso');  
    }    
    
    static function getAll() {
      $request = request();
      $inquiries = Inquiry::select('inquiries.id', 'name', 'timestamp', 'product', 'product_id', 'languages.iso as iso', 'is_readed', 'comment');
      $inquiries->join("languages", "languages.id", '=', "inquiries.fk_language");
      $queries = [];
      $columns = array('product', 'iso', 'is_readed');

      foreach ($columns as $column) {
        if ($request->has($column)) {
          $inquiries->where($column, $request->get($column));
          $queries[$column] = $request->get($column);
        }
      }

      if ($request->has('order')) {
        $inquiries->orderBy('id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $inquiries->orderBy('id', 'desc');
        $queries['order'] = 'desc';
      }   

      return $inquiries->simplePaginate(20)->appends($queries);
    }

    static function getEdit($id){

      $result = Inquiry::select('id', 'name', 'email', 'phone', 'adult', 'child', 'departure', 'timestamp', 'product', 'product_id', 'fk_language', 'is_readed', 'comment')
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
