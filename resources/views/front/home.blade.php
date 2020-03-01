<?php
  use Illuminate\Support\Str;
?>
@extends('layouts.front')

@section('title', 'Viajar por Patagonia')

@push('meta')
    <meta name="description" content="Viajar por Patagonia es un portal de viajes virtual en el que se ofrecen paquetes turisticos y excursiones con detino a la Patagonia Argentina">
@endpush

@push('facebook')
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:title" content="Pagina principal" />
    <meta property="og:description" content="Viajar por Patagonia es un portal de viajes virtual en el que se ofrecen paquetes turisticos y excursiones con detino a la Patagonia Argentina">    
@endpush

@section ('content')

  <main class="wrapper home-main">

    <section class="section">
      <header class="section__header flex">
        <h6 class="section__title">{{ ucfirst(__('front.packages')) }}</h6>
        <a class="section__view-all" href="{{ route('packages', array('locale' => app()->getLocale(), 'name' => Str::slug(__('front.view-all')))) }}">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <div class="grid section__main section-correct-height">
        @include('front/product-preview/vertical', ['products' => $packages, 'grid' => 'col-4_lg-6_sm-12', 'route' => 'package'])
      </div>
    </section>

    <section class="section">
      <header class="section__header flex">
        <h6 class="section__title">{{ ucfirst(__('front.cruiseships')) }}</h6>
        <a class="section__view-all" href="{{ route('cruiseships', array('locale' => app()->getLocale(), 'name' => Str::slug(__('front.view-all')))) }}">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <div class="grid section__main">
        @include('front/product-preview/vertical', ['products' => $cruiseships, 'grid' => 'col', 'route' => 'cruise'])
      </div>
    </section>

    <section class="section">
      <header class="section__header flex">
        <h6 class="section__title">{{ ucfirst(__('front.excursions')) }}</h6>
        <a class="section__view-all" href="{{ route('excursions', array('locale' => app()->getLocale(), 'name' => Str::slug(__('front.view-all')))) }}">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <div class="grid section__main">
        @include('front/product-preview/horizontal', ['products' => $excursions, 'route' => 'excursion'])
      </div>
    </section>  

  </main>

@endsection