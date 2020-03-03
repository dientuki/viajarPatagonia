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
        <h6 class="section__title">Resultado</h6>
      </header>

      <main class="grid section__main">
        @if (isset($results))
          @foreach ($results as $result)
            @include('front/product-preview/search', ['product' => $result])
          @endforeach
        @else

        @endif
        
      </main>

      <footer>
        
      </footer>
    </section>  

  </main>

@endsection