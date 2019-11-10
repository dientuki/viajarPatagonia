<?php
  use App\Http\Helpers\Helpers;
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
<meta http-equiv="Accept-CH" content="DPR, Viewport-Width, Width">
<meta http-equiv="Accept-CH-Lifetime" content="86400">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>@yield('title') - Viajar por Patagonia</title>

@stack('meta')
<meta name="og:site_name" content="Viajar por Patagonia">
<meta name="og:region" content="Patagonia">
<meta name="og:country_name" content="Argentina">
@stack('facebook')

<!-- Scripts -->
<script src="{{ Helpers::load_resource('frontJs.js') }}" defer crossorigin="anonymous"></script>

<!-- Fonts -->
<link rel="preload" href="{{ Helpers::load_resource('Maven-pro-Regular.woff2') }}" as="font" type="font/woff2" crossorigin />
<link rel="preload" href="{{ Helpers::load_resource('Maven-pro-Regular.woff') }}" as="font" type="font/woff" crossorigin />

<!-- Styles -->
<link href="{{ Helpers::load_resource('frontStyle.css') }}" rel="preload" as="style" onload="this.rel = 'stylesheet'" />