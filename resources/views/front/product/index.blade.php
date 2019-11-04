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
    <?php $image = Image::load($media->getPath('facebook')); ?>

    <meta property="og:image" content="{{ $media->getFullUrl('facebook') }}" />
    <meta property="og:image:width" content="{{ $image->getWidth() }}">
    <meta property="og:image:height" content="{{ $image->getHeight() }}">
    <meta property="og:image:type" content="{{$media->mime_type}}" />
    <meta property="fb:app_id" content="1494084460xxxxxx">
@endpush

@section ('content')

  <article class="layout-wrapper product">
    <header class="product__header">
      <h1 class="product__title">{{ $product->name }}</h1>
      <div class="layout-wrapper">
        @include('front.product.slider')
        <div class="layout-aside  grid-noGutter">
          @include('front.product.price')
          <div class="product__summary">
            {!! nl2br($product->summary) !!}
          </div>
          <div class="bold button button__cta col-bottom">{{ ucfirst(__('front.cta')) }}</div>
      </div>
    </header>

    <div class="layout-main">
      <main class="product__content">

        {!! $product->body_html !!}
      </main>

      <div class="aspect-slider product__map">
        <iframe src="about:blank" data-original="{{ $product->map }}" class="lzl"></iframe>
      </div>

      <div class="bold button button__cta col-bottom">{{ ucfirst(__('front.cta')) }}</div>

    </div>
    
    <aside class="layout-aside">
      <h6 class="aside__title">{{ __('front.another_packages') }}</h6>
      @include('front/product-preview/vertical', ['products' => $relateds])
    </aside>

  </article>

@endsection