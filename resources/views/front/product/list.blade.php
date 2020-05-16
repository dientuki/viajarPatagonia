<?php
use App\Http\Helpers\Helpers;
use App\Destination;
use App\Duration;
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
     
      <div class="col grid form-inline row has-FS ">
        <div class="col-6">
          <?php $destinations = Destination::getLists(); ?>
          <select data-param="destination" class="filter form-control col">
            <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('fields.destination_select_placeholder')) }}</option>
            <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
              @foreach ($destinations as $key => $destination)
                <option {!!Helpers::selected_filter('destination', $key)!!}>{{ $destination }}</option>
              @endforeach
            </select>  
        </div>
        
        <div class="col-6">
          <?php $durations = Duration::getLists(); ?>
          <select data-param="duration" class="filter form-control col">
            <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('fields.duration_select_placeholder')) }}</option>
            <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
              @foreach ($durations as $key => $duration)
                <option {!!Helpers::selected_filter('duration', $key)!!}>{{ $duration }}</option>
              @endforeach
            </select> 
        </div>
      </div>  

      <main class="grid section__main">
        @include('front/product-preview/horizontal', ['products' => $products, 'route' => $route])
      </main>

      <footer>
        {{ $products->links() }}
      </footer>
    </section>  

  </main>

@endsection