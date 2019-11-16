<div class="layout-main">
  <ul id="product-slider">
    @foreach ($product->getMedia('products') as $image)
      <li class="product-slider-item <?php if ($loop->first) : ?>product-slider-first<?php endif; ?>">  
        <figure class="aspect-slider">
          <img data-src="{{ $image->getFullUrl('slider') }}" class="tns-lazy-img"/>
        </figure>
      </li>
    @endforeach
  </ul>
</div>