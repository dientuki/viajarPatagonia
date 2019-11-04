@foreach ($products as $product)
  <article class="list {{ $grid ?? '' }}">
    <?php 
      $images = $product->getMedia('products');
      $img = '';
      if (count($images) != 0) {
        $key = rand(0, count($images) - 1);
        $img = $images[$key]->getFullUrl('preview');
      }
    ?>
    <figure class="aspect-preview list__figure">
      <img src="about:blank" data-original="{{ $img }}" class="lzl" />
    </figure>
    <h1 class="list__title bold">{{ $product->name }}</h1>
    <div class="list__summary">{!! nl2br($product->summary) !!}</div>
    <div class="button button__price">{{ $product->getPrice() }}</div>
  </article>
@endforeach