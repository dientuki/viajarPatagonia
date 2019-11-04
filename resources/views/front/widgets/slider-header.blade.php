<div class="Wallop Wallop--slide">
  <div class="Wallop-list">
    @foreach (array(1,2,3) as $image)
      <figure class="Wallop-item <?php if ($loop->first) : ?>Wallop-item--current<?php endif; ?>">
        <?php $lzl = $loop->first ? 'lzl' : 'wallop-lzl'; ?>
        <img src="about:blank" data-original="{{ asset('images/slide-' . $image . '.jpg') }}" class="{{$lzl}}" />
      </figure>
    @endforeach
  </div>
</div>