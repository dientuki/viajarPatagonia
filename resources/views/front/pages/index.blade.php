@extends('layouts.front')

@section('title', $page->title)

<?php $desc = trim(str_replace("\r\n","",$page->desc)); ?>

@push('meta')
    <meta name="description" content="{{ substr($desc, 0, 155)}}">
@endpush

@push('facebook')
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{url()->full()}}" />
    <meta property="og:title" content="{{$page->title}}" />
    <meta property="og:description" content="{{ substr($desc, 0, 155)}}">
@endpush

@section ('content')
  <a id="product" name="product"></a>
  <article class="layout-wrapper product page">
    <header class="product__header">
      <h1 class="product__title">{{ $page->title }}</h1>
    </header>

    <div class="layout-main">
      <main class="product__content">
        {!! $page->body_html !!}
        
        @if ($page->add_contact_form)
          @include('front.forms.contact')
        @endif

        @if ($page->embed)
          {!! $page->embed !!}
        @endif
      </main>
    </div>
    
    <aside class="layout-aside aside">
      
    </aside>

  </article>

@endsection