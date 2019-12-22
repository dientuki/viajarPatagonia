  <figure class="aspect-homeslider">
    <img data-src="{{ $image->getFullUrl('slider_desktop') }}" class="{{ $lazyload }}"/>
  </figure>

  <div class="header-slider__content">
    <div class="header-slider__title header-slider__top">{{ $slide->title }}</div>
    <div class="header-slider__date">{{ $slide->date }}</div>
    <div class="header-slider__description header-slider__top">{{ $slide->description }}</div>
    <div class="header-slider__hotel header-slider__top">{{ $slide->hotel }} {{ $slide->stars}}*</div>
    <div class="header-slider__cta header-slider__top button">{{ ucfirst(__('front.cta')) }}</div>
  </div>