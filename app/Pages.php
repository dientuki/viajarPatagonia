<?php

namespace App;

use App\Pages;
use App\Translations\Language;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages';

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
    protected $fillable = ['is_active', 'order'];    

    static public function getAll(){
      $request = request();
      $pages = Pages::select('pages.id', 'pages.is_active');
      $languages = Language::getAll();

      foreach ($languages as $language) {
        $pages->addSelect("ct$language->id.title as title$language->id")
          ->addSelect("ct$language->id.slug as slug$language->id")
          ->join("pages_translation as ct$language->id", 'pages.id', '=', "ct$language->id.fk_page")
          ->join("languages as l$language->id", "l$language->id.id", '=', "ct$language->id.fk_language")
          ->where("l$language->id.iso", $language->iso);
      }

      return $pages->orderBy('pages.order')->simplePaginate(20);
    }

    static function getEdit($id){

      /*
      $cruiseship = Pages::select('id', 'is_active', 'map', 'fk_cruiseship_type');
      $result = $cruiseship->where('id', $id)->get()->first();
  
      if (is_array($id)) {
        if (count($result) == count(array_unique($id))) {
          return $result;
        }
      } elseif (! is_null($result)) {
        return $result;
      }
  
      //Laravel 4 fallback
      return abort(404);
      */
    }

    static function getPage($slug) {

    }

    static function getLastOrder() {
      return Pages::orderBy('order', 'DESC')
        ->limit(1)
        ->value('order');      
    }
  }