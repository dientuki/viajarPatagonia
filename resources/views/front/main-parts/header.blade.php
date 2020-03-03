<?php 

use App\Currency;
use App\Http\Helpers\Helpers;
use App\Translations\Language;
use Illuminate\Support\Facades\Route;

?>

<header class="header">
  <div class="wrapper">
    <a class="header__logo text-hidden" href="{{route('home', app()->getLocale())}}" title="{{ __('front.go_to_home') }}">Viajar por patagonia</a>

    <div class="collapsable">
      <div class="collapsable__content">
        <nav class="navigation">
          <ul class="navigation__ul">
            <li class="navigation__li">
              <a class="navigation__link" href="{{route('home', app()->getLocale())}}">{{ ucfirst(__('front.home')) }}</a>
            </li>
            <?php $pages = Helpers::getHeaderPages(); ?>
            @foreach ($pages as $page)
              <?php $route = route('pages', array('slug' => $page->slug, 'locale' => app()->getLocale())); ?>
              <li class="navigation__li">
                <a href="{{ $route }}" class="navigation__link">{{ $page->title }}</a></li>
              </li>
            @endforeach            
          </ul>
        </nav>

        <form action="{{route('search', app()->getLocale())}}" class="search_form" method="POST">
          @csrf
          <input name="search" class="search_form__input" type="search" placeholder="{{ ucfirst(__('front.search')) }}" />
          <button class="search_form__submit">{!! Helpers::load_svg('ico-search') !!}</button>
        </form>

        <?php $currencies = Currency::getAll(); ?>
        <div class="selector">
          
          <div class="selector--current">{!! Helpers::load_svg('currency-' . strtolower(session('currency')['iso'])) !!}{{ ucfirst(__('front.currency')) }}{!! Helpers::load_svg('ico-down') !!}</div>
          <ul class="selector__ul">
            @foreach ($currencies as $currency)
              <li class="selector__li">
                <a title="{{ ucfirst(__('front.change_to')) }} {{ __('front.currency') }} {{ $currency->currency }}" href="{{route('setCurrency', ['iso' => $currency->iso] )}}">{{ $currency->sign }} {{ $currency->iso }}</a>
              </li>
            @endforeach
          </ul>
        </div>

        <?php 
          $languages = Language::getAll();
          $parameters = Route::current()->parameters();
        ?>
        <div class="selector">
          <div class="selector--current">{!! Helpers::load_svg('lang-' . session('locale')['iso']) !!}{{ ucfirst(__('front.language')) }}{!! Helpers::load_svg('ico-down') !!}</div>
          <ul class="selector__ul">
            @foreach ($languages as $language)
              <?php $parameters['locale'] = $language->iso; ?>
              <li class="selector__li">
                @if (Route::currentRouteName() == 'search')
                  <a title="{{ ucfirst(__('front.change_to')) }} {{ __('front.language') }} {{ $language->language }}" href="{{route('home', $language->iso)}}">{{ $language->language }}</a>
                @else
                  <?php
                    if (Route::currentRouteName() == 'pages') {
                      $parameters['slug'] = Helpers::getPageBySlug($parameters['slug'], $language->id);
                    }
                  ?>
                  <a title="{{ ucfirst(__('front.change_to')) }} {{ __('front.language') }} {{ $language->language }}" href="{{route(Route::currentRouteName(), $parameters )}}">{{ $language->language }}</a>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    <div id="ico-menu" class="ico-menu-wrapper">{!! Helpers::load_svg('ico-menu') !!}</div>
  </div>
  
</header>