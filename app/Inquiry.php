<?php

namespace App;

use DateTime;
use App\Inquiry;
use App\Translations\Language;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    protected $fillable = ['name', 'email', 'phone', 'adult', 'child', 'departure', 'timestamp', 'product', 'product_id', 'fk_language', 'comment', 'nights'];     

    public function getTimestampAttribute() {
      $current = explode('@', Route::currentRouteAction())[1];
      $date = $this->attributes['timestamp'];

      if ($current == 'edit') {
        $date = date('d/m/Y g:H:s',strtotime($this->attributes['timestamp']));
      }

      if ($current == 'index') {

        $today = new DateTime(); // This object represents current date/time
        $today->setTime(0,0,0); // reset time part, to prevent partial comparison

        $match_date = new DateTime($this->attributes['timestamp']); //DateTime::createFromFormat( "Y.m.d\\TH:i", strtotime($this->attributes['timestamp']) );
        $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

        $diff = $today->diff( $match_date );
        $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval        
        
        if ($diffDays == 0) {
          $date = date('g:H:s',strtotime($this->attributes['timestamp']));
        } else {
          $date = date('d/m/Y',strtotime($this->attributes['timestamp']));
        }
      }

      return $date;
    }

    public function setDepartureAttribute($value) {
      $date = DateTime::createFromFormat('d/m/Y', $value);
      $this->attributes['departure'] = $date->format('Y-m-d');
    }

    public function getDepartureAttribute() {
      return date('d/m/Y',strtotime($this->attributes['departure']));;
    }    

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

      $result = Inquiry::select('id', 'name', 'email', 'phone', 'adult', 'child', 'departure', 'timestamp', 'product', 'product_id', 'fk_language', 'is_readed', 'comment', 'nights')
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
