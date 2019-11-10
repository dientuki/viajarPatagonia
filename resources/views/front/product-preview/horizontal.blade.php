<?php
  use Illuminate\Support\Str;
?>
@foreach ($products as $product)
  <article class="list list--horizontal grid col-12">
    <?php 
      $images = $product->getMedia('products');
      $img = '';
      $col = isset($noprice) ? '4' : '3';
      $sizes = array(
        3 => '(min-width: 1150px) 240px, 100vw',
        4 => '(min-width: 1150px) 273px, 100vw'
      );
      $routeParams = array('locale' => app()->getLocale(), 'name' => Str::slug($product->name, '-'), 'id' => $product->id);
      if (count($images) != 0) {
        $key = rand(0, count($images) - 1);
        $img = route('images', array('id' => $images[$key]->id, 'image' => $images[$key]->file_name));
      }
      
    ?>
    <div class="col-{{$col}}">
      <figure class="aspect-preview list__figure">
        <img src="{{ $img }}" data-original="{{ $img }}" sizes="{{ $sizes[$col] }}"/>
      </figure>
    </div>
    <div class="col">
      <h1 class="list__title bold">
        <a href="{{route($route, $routeParams)}}" class="list_link">{{ $product->name }}</a>
      </h1>
      @if (isset($product->dataExtra))
        <div class="list__summary">{!! nl2br($product->summary) !!}</div>
      @endif
      <div class="list__data-extra bold">Disponible: Todo el año - Duración: Día Completo</div>
      <div class="list__summary">{!! nl2br($product->summary) !!}</div>
    </div>
    @if (isset($noprice) == false)
      <div class="col-3">
        <div class="button button__price">{{ $product->getPrice() }} {{__('front.final')}}</div>
      </div>
    @endif
  </article>
@endforeach