@extends('layouts.product')

@section ('content')

  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        @include('front.product.slider')
        <div class="layout-aside">
          @include('front.product.price')
          <div>
            {!! nl2br($product->summary) !!}
        </div>
      </div>
    </header>

    <main class="layout-main">
      {{ $product->body }}

      <iframe src="about:blank" data-original="{{ $product->map }}" class="lzl"></iframe>
    </main>
    
    <aside class="layout-aside">

    </aside>

  </article>

@endsection