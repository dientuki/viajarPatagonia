<?php
  use Illuminate\Support\Str;
?>

<article class="list list--horizontal grid col-12">
  <?php 
    $images = $product->getMedia('products');
    $img = '';
    $col = isset($noprice) ? '4' : '3';
    $routeParams = array('locale' => app()->getLocale(), 'name' => Str::slug($product->name, '-'), 'id' => $product->id);
    if (count($images) != 0) {
      $key = rand(0, count($images) - 1);
      $img = $images[$key]->getFullUrl('preview');
    }
    
  ?>
  <div class="col-{{$col}}_lg-4_sm-12">
    <figure class="aspect-preview list__figure">
      <img src="about:blank" data-src="{{ $img }}" class="lzl" />
    </figure>
  </div>
  <div class="col_sm-12">
    <h1 class="list__title bold">
      <a href="{{route($product->route, $routeParams)}}#product" class="list_link">{{ $product->name }}</a>
    </h1>
    
    <div class="list__summary">{!! nl2br($product->summary) !!}</div>
  </div>
</article>