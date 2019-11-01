<?php 

use App\Currency;
use App\Translations\Language;

?>

<header id="header">
  <div class="wrapper">
    <a class="header__logo text-hidden" href="#" title="{{ __('front.go_to_home') }}">Viajar por patagonia</a>

    <nav id="navigation">
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

    <form action="#">
      <input placeholder="{{ ucfirst(__('front.search')) }}" />
    </form>

    <?php $currencies = Currency::getAll(); ?>
    <div class="selector">
      <div class="selector--current">{{ ucfirst(__('front.currency')) }}{!! load_svg('ico-down') !!}</div>
      <ul class="selector__ul">
        @foreach ($currencies as $currency)
          <li class="selector__li" title="{{ ucfirst(__('front.change_to')) }} {{ __('front.currency') }} {{ $currency->currency }}">{{ $currency->sign }} {{ $currency->iso }}</li>
        @endforeach
      </ul>
    </div>

    <?php $languages = Language::getAll(); ?>
    <div class="selector">
      <div class="selector--current">{{ ucfirst(__('front.language')) }}{!! load_svg('ico-down') !!}</div>
      <ul class="selector__ul">
        @foreach ($languages as $language)
          <li class="selector__li" title="{{ ucfirst(__('front.change_to')) }} {{ __('front.language') }} {{ $language->language }}">{{ $language->language }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  
</header>