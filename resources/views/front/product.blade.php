@extends('layouts.product')

@section ('content')

  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        <div class="layout-main Wallop Wallop--slide">
          <div class="Wallop-list">
            @foreach ($product->getMedia('products') as $image)
              <figure class="Wallop-item <?php if ($loop->first) : ?>Wallop-item--current<?php endif; ?>">
                <?php $lzl = $loop->first ? 'lzl' : 'wallop-lzl'; ?>
                <img src="about:blank" data-original="{{ $image->getFullUrl('slider') }}" class="{{$lzl}}" />
              </figure>
            @endforeach
          </div>
        </div>
        <div class="layout-aside">
          Precios
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