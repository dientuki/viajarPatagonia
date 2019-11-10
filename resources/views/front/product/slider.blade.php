<div class="layout-main Wallop Wallop--slide">
  <div class="Wallop-list">
    @foreach ($product->getMedia('products') as $image)
      <figure class="Wallop-item <?php if ($loop->first) : ?>Wallop-item--current<?php endif; ?>">
        <?php $lzl = $loop->first ? 'lzl' : 'wallop-lzl'; ?>
        <img src="about:blank" data-original="{{ route('images', array('id' => $image->id, 'image' => $image->file_name)) }}" class="{{$lzl}}" sizes="(min-width: 1150px) 760px, 100vw" />
      </figure>
    @endforeach
  </div>
</div>