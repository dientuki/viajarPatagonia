<?php

namespace App\Translations;

use Illuminate\Database\Eloquent\Model;

class PagesTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_translation';

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
    protected $fillable = ['fk_language', 'fk_page', 'title', 'slug', 'body'];    

    static function getEdit($id){
      
      return PagesTranslation::select('id', 'fk_language', 'fk_page', 'title', 'slug', 'body')
        ->where('fk_page', $id)
        ->orderBy('fk_language')
        ->get();   
    }  
    
    static function getSlugByLang($slug, $language){
      
      $pageId = PagesTranslation::where('slug', $slug)->value('fk_page');
      return PagesTranslation::where('fk_page', $pageId)->where('fk_language', $language)->value('slug');
    }     

    static function getUpdate($where){

      return PagesTranslation::select('id', 'fk_language', 'fk_page', 'title', 'slug', 'body')
        ->where($where)
        ->get()->first();
    }    
}
