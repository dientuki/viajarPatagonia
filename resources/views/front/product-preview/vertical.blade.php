<?php
  use Illuminate\Support\Str;
?>

@foreach ($products as $product)
  <article class="list {{ $grid ?? '' }}">
    <div class="list-content">
      <?php 
        $images = $product->getMedia('products');
        $img = '';
        $routeParams = array('locale' => app()->getLocale(), 'name' => Str::slug($product->name, '-'), 'id' => $product->id);
        if (count($images) != 0) {
          $key = rand(0, count($images) - 1);
          $img = $images[$key]->getFullUrl('preview');
        }
      ?>
      <figure class="aspect-preview list__figure">
        <img src="about:blank" data-src="{{ $img }}" class="lzl" />
      </figure>
        <h1 class="list__title bold">
          <a href="{{route($route, $routeParams)}}#product" class="list_link">{{ $product->name }}</a>
        </h1>
      <div class="list__summary">{!! nl2br($product->summary) !!}</div>
      <div class="button button__price">{{ $product->getPrice() }} {{__('front.final')}}</div>
    </div>
  </article>
@endforeach