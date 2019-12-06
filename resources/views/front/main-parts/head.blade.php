<?php
  use App\Http\Helpers\Helpers;
?>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>@yield('title') - Viajar por Patagonia</title>
@stack('meta')
<meta name="og:site_name" content="Viajar por Patagonia">
<meta name="og:region" content="Patagonia">
<meta name="og:country_name" content="Argentina">
@stack('facebook')

<link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ URL::asset('site.webmanifest') }}">
<link rel="mask-icon" href="{{ URL::asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="Viajar por patagonia">
<meta name="application-name" content="Viajar por patagonia">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">

<!-- Scripts -->
<script src="{{ Helpers::load_resource('frontJs.js') }}" defer crossorigin="anonymous"></script>

<!-- Fonts -->
<link rel="preload" href="{{ Helpers::load_resource('Maven-pro-Regular.woff2') }}" as="font" type="font/woff2" crossorigin />
<link rel="preload" href="{{ Helpers::load_resource('Maven-pro-Regular.woff') }}" as="font" type="font/woff" crossorigin />

<!-- Styles -->
<link href="{{ Helpers::load_resource('frontStyle.css') }}" rel="preload" as="style" onload="this.rel = 'stylesheet'" />