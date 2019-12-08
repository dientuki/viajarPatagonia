<?php

namespace App\Http\Middleware;

use Closure;
use App\Translations\Language;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $iso = $request->segment(1);
      $locale = session('locale', array('iso' => '', 'id' => ''));
        
      if ($iso != $locale['iso']) {
        $tmp = Language::getLocale($iso);
        $locale = array('iso' => $iso, 'id' => $tmp->first());
        session(['locale' => $locale]);
      }

      app()->setLocale($iso);
      return $next($request);      
    }
}
