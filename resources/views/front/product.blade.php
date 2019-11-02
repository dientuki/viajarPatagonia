@extends('layouts.product')

@section ('content')

  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        <div class="layout-main">slider</div>
        <div class="layout-aside">
          Precios
          <div>
            {!! nl2br($product->summary) !!}
        </div>
      </div>
    </header>

    <main class="layout-main">
      {{ $product->body }}

      <iframe src="about:blank" data-src="{{ $product->map }}"></iframe>
    </main>
    
    <aside class="layout-aside">

    </aside>

  </article>

@endsection