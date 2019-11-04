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
        <a class="section__view-all" href="#">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <main class="grid section__main">
        @include('front/product-preview/vertical', ['products' => $packages, 'grid' => 'col-4'])
      </main>
    </section>

    <section class="section">
      <header class="section__header flex">
        <h6 class="section__title">{{ ucfirst(__('front.cruiseships')) }}</h6>
        <a class="section__view-all" href="#">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <main class="grid section__main">
        @include('front/product-preview/vertical', ['products' => $cruiseships, 'grid' => 'col'])
      </main>
    </section>

    <section class="section">
      <header class="section__header flex">
        <h6 class="section__title">{{ ucfirst(__('front.excursions')) }}</h6>
        <a class="section__view-all" href="#">{{ ucfirst(__('front.view-all')) }}</a>
      </header>

      <main class="grid section__main">
        @include('front/product-preview/horizontal', ['products' => $excursions])
      </main>
    </section>  

  </main>

@endsection