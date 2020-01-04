<?php $images = $product->getMedia('products');?>

@if (count($images) > 0)
  <div class="layout-main">
    @if (count($images) > 1)
      <ul id="product-slider">
        @foreach ($images as $image)
          <li class="product-slider-item <?php if ($loop->first) : ?>product-slider-first<?php endif; ?>">  
            <figure class="aspect-slider">
              <img data-src="{{ $image->getFullUrl('slider') }}" class="tns-lazy-img"/>
            </figure>
          </li>
        @endforeach
      </ul>
    @else
      <?php $image = $product->getFirstMedia('products'); ?>
      <figure class="aspect-slider">
        <img data-src="{{ $image->getFullUrl('slider') }}" class="lzl"/>
      </figure>      
    @endif
  </div>
@endif
