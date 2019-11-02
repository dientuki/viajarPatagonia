@extends('layouts.product')

@section ('content')

  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        @include('front.product.slider')
        <div class="layout-aside  grid-noGutter">
          @include('front.product.price')
          <div class="header__summary">
            {!! nl2br($product->summary) !!}
          </div>
          <div class="bold button button__cta col-bottom">{{ ucfirst(__('front.cta')) }}</div>
      </div>
    </header>

    <div class="layout-main">
      <main>
        {{ $product->body }}
      </main>

      <div class="aspect-slider">
        <iframe src="about:blank" data-original="{{ $product->map }}" class="lzl"></iframe>
      </div>

    </div>
    
    <aside class="layout-aside">
      @include('front.product.aside')
    </aside>

  </article>

@endsection