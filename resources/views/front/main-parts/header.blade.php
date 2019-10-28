<?php 

use App\Currency;
use App\Translations\Language;

?>

<header id="header">
  <a href="#">Viajar por patagonia</a>

  <nav>
    <ul>
      <li>
        <a href="#">Inicio</div>
      </li>
      <li>
        <a href="#">Hoteles</a>
      </li>
      <li>
        <a href="#">Autos</a>
      </li>
    </ul>
  </nav>

  <form action="#">
    <input />
  </form>

  <div>
    <div>Moneda</div>
    <?php $currencies = Currency::getAll(); ?>
    <ul>
      @foreach ($currencies as $currency)
        <li>{{ $currency->sign }} {{ $currency->iso }}</li>
      @endforeach
    </ul>
  </div>

  <div>
    <div>Idioma</div>
    <?php $languages = Language::getAll(); ?>
    <ul>
      @foreach ($languages as $language)
        <li>{{ $language->language }}</li>
      @endforeach
    </ul>
  </div>

</header>