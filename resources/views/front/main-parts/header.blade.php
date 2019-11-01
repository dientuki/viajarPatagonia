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

    <div>
      <div>{{ ucfirst(__('front.currency')) }}{!! load_svg('ico-down') !!}</div>
      <?php $currencies = Currency::getAll(); ?>
      <ul>
        @foreach ($currencies as $currency)
          <li>{{ $currency->sign }} {{ $currency->iso }}</li>
        @endforeach
      </ul>
    </div>

    <div>
      <div>{{ ucfirst(__('front.language')) }}{!! load_svg('ico-down') !!}</div>
      <?php $languages = Language::getAll(); ?>
      <ul>
        @foreach ($languages as $language)
          <li>{{ $language->language }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  
</header>