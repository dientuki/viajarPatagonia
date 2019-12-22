<?php use App\Http\Helpers\Helpers; ?>

<figure class="aspect-homeslider">
  <img data-src="{{ $image->getFullUrl('slider_desktop') }}" class="{{ $lazyload }}"/>
</figure>

<div class="header-slider__content">
  <div class="header-slider__title header-slider__top">{{ $slide->title }}</div>
  <div class="header-slider__date">{!! nl2br($slide->date) !!}</div>
  <div class="header-slider__description header-slider__top">{!! nl2br($slide->description) !!}</div>
  <div class="header-slider__hotel header-slider__top">{{ $slide->hotel }} {{ $slide->stars }} <span class="star"></span></div>
  <?php $url = Helpers::slider_get_url($slide->url); ?>
  @if ($url != false)
    <a class="header-slider__cta header-slider__top button" href="{{ $url }}">{{ ucfirst(__('front.cta')) }}</a>
  @endif
</div>