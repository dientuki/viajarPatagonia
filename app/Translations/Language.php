<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'languages';

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
    protected $fillable = ['language', 'iso'];    

    static function getLists() {
      //return Region::orderBy('region')->pluck('region', 'id');
    } 
    
    static function getAll() {
      $request = request();
      $queries = [];

      $languages = Language::select('id', 'language', 'iso');

      if ($request->has('order')) {
        $languages->orderBy('id', $request->get('order'));
        $queries['order'] = $request->get('order');
      } else {
        $languages->orderBy('id', 'asc');
        $queries['order'] = 'asc';
      }  

      return $languages->simplePaginate(20)->appends($queries);
    }

    static function getLocale($iso) {
      return Language::where('iso', $iso)->pluck('id', 'iso');
    }

    static function getEdit($id){

        $result = Language::select('id', 'language', 'iso')
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
