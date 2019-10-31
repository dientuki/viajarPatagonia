<?php 

use App\Currency;
use App\Translations\Language;

?>

<header id="header">
  <div class="wrapper">
    <a href="#" title="{{ __('front.go_to_home') }}">Viajar por patagonia</a>

    <nav>
      <ul>
        <li>
          <a href="#">{{ ucfirst(__('front.home')) }}</a>
        </li>
        <li>
          <a href="#">{{ ucfirst(__('front.hotels')) }}</a>
        </li>
        <li>
          <a href="#">{{ ucfirst(__('front.cars')) }}</a>
        </li>
      </ul>
    </nav>

    <form action="#">
      <input placeholder="{{ ucfirst(__('front.search')) }}" />
    </form>

    <div>
      <div>{{ ucfirst(__('front.currency')) }}</div>
      <?php $currencies = Currency::getAll(); ?>
      <ul>
        @foreach ($currencies as $currency)
          <li>{{ $currency->sign }} {{ $currency->iso }}</li>
        @endforeach
      </ul>
    </div>

    <div>
      <div>{{ ucfirst(__('front.language')) }}</div>
      <?php $languages = Language::getAll(); ?>
      <ul>
        @foreach ($languages as $language)
          <li>{{ $language->language }}</li>
        @endforeach
      </ul>
    </div>
  </div>
  
</header>