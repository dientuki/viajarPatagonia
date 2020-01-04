<?php 
  use Spatie\Image\Image;
?>

@extends('layouts.front')

@section('title', $product->name)

@push('meta')
    <?php $desc = trim(str_replace("\r\n","",$product->summary)); ?>
    <meta name="description" content="{{ substr($desc, 0, 155)}}">
@endpush

@push('facebook')
    <meta property="og:type" content="place" />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:title" content="{{$product->name}}" />
    <?php $desc = trim(str_replace("\r\n","",$product->summary)); ?>
    <meta property="og:description" content="{{ substr($desc, 0, 155)}}">
    
    <?php $media = $product->getFirstMedia('products'); ?>

    @if ($media != null)
      <meta property="og:image" content="{{ $media->getFullUrl('facebook') }}" />
      <meta property="og:image:type" content="{{$media->mime_type}}" />
      
      @if (file_exists($media->getPath('facebook')))
        <?php $image = Image::load($media->getPath('facebook')); ?>
        <meta property="og:image:width" content="{{ $image->getWidth() }}">
        <meta property="og:image:height" content="{{ $image->getHeight() }}">
      @endif      
    @endif

    <meta property="fb:app_id" content="1494084460xxxxxx">
@endpush

@section ('content')
  <a id="product" name="product"></a>
  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        @include('front.product.slider')
        <div class="layout-aside  grid-noGutter">
          @include('front.product.price')
          <div class="product__summary col-12">
            {!! nl2br($product->summary) !!}
          </div>
          <div class="bold button button__cta col-bottom openOverlay">{{ ucfirst(__('front.cta')) }}</div>
      </div>
    </header>

    <div class="layout-main">
      <main class="product__content">
        <div class="aside__title">{{ ucfirst(__('front.detail_' . $productType)) }}</div>
        {!! $product->body_html !!}
      </main>

      @if (isset($excursionsRelated) && $excursionsRelated->isEmpty() == false)
        <div class="extra__title">{{ ucfirst(__('front.included-excursion')) }}</div>
        <div class="grid">
          @include('front/product-preview/horizontal', ['products' => $excursionsRelated, 'route' => 'excursion', 'noprice' => true])
        </div>
      @endif
            
      @if (isset($excursionsUnrelated) && $excursionsUnrelated->isEmpty() == false)
        <div class="extra__title">{{ ucfirst(__('front.buy-more-excursion')) }}</div>
        <div class="grid">
          @include('front/product-preview/horizontal', ['products' => $excursionsUnrelated, 'route' => 'excursion', 'noprice' => true])
        </div>
      @endif

      @if ($product->map != '')
        <div class="aspect-slider product__map">
          <iframe src="about:blank" data-src="{{ $product->map }}" class="lzl"></iframe>
        </div>
      @endif
      
      <div class="bold button button__cta col-bottom openOverlay">{{ ucfirst(__('front.cta')) }}</div>

    </div>
    
    <aside class="layout-aside aside">
      <h6 class="aside__title">{{ __('front.another_' . $productType ) }}</h6>
      @include('front/product-preview/vertical', ['products' => $relateds, 'route' => $productType])
    </aside>

  </article>

  @include('front/widgets/product-inquiries')

@endsection