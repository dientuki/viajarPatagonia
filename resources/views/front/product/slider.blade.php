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