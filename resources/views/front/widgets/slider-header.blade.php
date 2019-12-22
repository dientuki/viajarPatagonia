<?php

use App\Homeslider;
use App\Http\Helpers\Helpers;

$sliders = Homeslider::getHome();
$first = true;
?>

@if (count($sliders) > 0)
  <div class="header-slider">
    @if (count($sliders) > 1)
      <ul id="header-slider">
        @foreach ($sliders as $slide)
          <?php $image = $slide->getFirstMedia('sliderHome'); ?>
          @if ($image != null)        
            <li class="header-slider__item <?php if ($first == true): $first = false;?>header-slider__first<?php endif; ?>">  
              @include('front/widgets/slider-image', ['image' => $image, 'slide' => $slide, 'lazyload' => 'tns-lazy-img'])
            </li>
          @endif            
        @endforeach
      </ul>
      <div class="slider-controls-prev">{!! Helpers::load_svg('ico-prev') !!}</div>
      <div class="slider-controls-next">{!! Helpers::load_svg('ico-next') !!}</div>
    @else
      @foreach ($sliders as $slide)
        <?php $image = $slide->getFirstMedia('sliderHome'); ?>
        @if ($image != null)      
          <div class="header-slider__item header-slider__first">  
            @include('front/widgets/slider-image', ['image' => $image, 'slide' => $slide, 'lazyload' => 'lzl'])
          </div>
        @endif
      @endforeach 
    @endif
  </div>
@endif