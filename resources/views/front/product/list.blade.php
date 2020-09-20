<?php
use App\Http\Helpers\Helpers;
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
        <h6 class="section__title">{{ ucfirst(__('front.' . $productType)) }}</h6>
      </header>
     
      @includeIf('front/filters/' . $productType)

      <main class="grid section__main">
      
        @if (count($products)  > 0)
          @include('front/product-preview/horizontal', ['products' => $products, 'route' => $route])
        @else
          <h2 clas="col-12">Sin resultados</h2>
          <div class="col-12"><a class="clean-filter" href="{{ route($productType, array('locale' => app()->getLocale(), 'name' => Str::slug(__('front.view-all')))) }}">{{ __('filters.reset') }}</a></div>
        @endif


      </main>

      <footer>
        {{ $products->links() }}
      </footer>
    </section>  

  </main>

@endsection