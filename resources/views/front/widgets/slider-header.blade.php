<?php

use App\Homeslider;
use App\Http\Helpers\Helpers;

$sliders = Homeslider::getHome();

?>

@if (count($sliders) > 0)
  <div class="header-slider">
    @if (count($sliders) > 1)
      <ul id="header-slider">
        @foreach ($sliders as $slide)
          <li class="header-slider__item <?php if ($loop->first) : ?>header-slider__first<?php endif; ?>">  
            <?php $image = $slide->getFirstMedia('sliderHome'); ?>
            <figure class="aspect-homeslider">
              <img data-src="{{ $image->getFullUrl('slider_desktop') }}" class="tns-lazy-img"/>
            </figure>
            <div class="header-slider__content">
              <div class="header-slider__title">{{ $slide->title }}</div>
              <div class="header-slider__date">{{ $slide->date }}</div>
              <div class="header-slider__description">{{ $slide->description }}</div>
              <div class="header-slider__hotel">{{ $slide->hotel }} {{ $slide->stars}}*</div>
              <div class="header-slider__cta">consultar</div>
            </div>
          </li>
        @endforeach
      </ul>
      <div class="slider-controls-prev">{!! Helpers::load_svg('ico-prev') !!}</div>
      <div class="slider-controls-next">{!! Helpers::load_svg('ico-next') !!}</div>
    @else
      @foreach ($sliders as $slide)
        <div class="header-slider__item header-slider__first">  
          <?php $image = $slide->getFirstMedia('sliderHome'); ?>
          <figure class="aspect-homeslider">
            <img data-original="{{ $image->getFullUrl('slider_desktop') }}" class="lzl"/>
          </figure>
          <div class="header-slider__content">
            <div class="header-slider__title">{{ $slide->title }}</div>
            <div class="header-slider__date">{{ $slide->date }}</div>
            <div class="header-slider__description">{{ $slide->description }}</div>
            <div class="header-slider__hotel">{{ $slide->hotel }} {{ $slide->stars}}*</div>
            <div class="header-slider__cta">consultar</div>
          </div>
          </div>
      @endforeach 
    @endif
  </div>
@endif