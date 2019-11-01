<?php 

use App\Currency;
use App\Translations\Language;

?>

<header class="header">
  <div class="wrapper">
    <a class="header__logo text-hidden" href="#" title="{{ __('front.go_to_home') }}">Viajar por patagonia</a>

    <nav class="navigation">
      <ul class="navigation__ul">
        <li class="navigation__li">
          <a class="navigation__link" href="#">{{ ucfirst(__('front.home')) }}</a>
        </li>
        <li class="navigation__li">
          <a class="navigation__link" href="#">{{ ucfirst(__('front.hotels')) }}</a>
        </li>
        <li class="navigation__li">
          <a class="navigation__link" href="#">{{ ucfirst(__('front.cars')) }}</a>
        </li>
      </ul>
    </nav>

    <form action="#" class="search_form">
      <input class="search_form__input" type="search" placeholder="{{ ucfirst(__('front.search')) }}" />
      <button class="search_form__submit">{!! load_svg('ico-search') !!}</button>
    </form>

    <?php $currencies = Currency::getAll(); ?>
    <div class="selector">
      <div class="selector--current">{!! load_svg('lang-pt') !!}{{ ucfirst(__('front.currency')) }}{!! load_svg('ico-down') !!}</div>
      <ul class="selector__ul">
        @foreach ($currencies as $currency)
          <li class="selector__li" title="{{ ucfirst(__('front.change_to')) }} {{ __('front.currency') }} {{ $currency->currency }}">{{ $currency->sign }} {{ $currency->iso }}</li>
        @endforeach
      </ul>
    </div>

    <?php $languages = Language::getAll(); ?>
    <div class="selector">
      <div class="selector--current">{!! load_svg('lang-es') !!}{{ ucfirst(__('front.language')) }}{!! load_svg('ico-down') !!}</div>
      <ul class="selector__ul">
        @foreach ($languages as $language)
          <li class="selector__li" title="{{ ucfirst(__('front.change_to')) }} {{ __('front.language') }} {{ $language->language }}">{{ $language->language }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  
</header>