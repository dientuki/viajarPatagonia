<?php

namespace App\Http\Middleware;

use Closure;
use App\Currency;
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
      $currency = session('currency', array('iso' => '', 'id' => ''));
      $defaults = array(
        'en' => 'USD',
        'es' => 'ARS',
        'pt' => 'EUR'
      );
        
      if ($iso != $locale['iso']) {
        $tmp = Language::getLocale($iso);
        $locale = array('iso' => $iso, 'id' => $tmp->first());
        session(['locale' => $locale]);
      }

      if ($currency['iso'] == '') {
        $id = Currency::getDefault($defaults[$iso]);
        $currency = array('iso' => $defaults[$iso], 'id' => $id);
        session(['currency' => $currency]);
      }      

      app()->setLocale($iso);
      return $next($request);      
    }
}
