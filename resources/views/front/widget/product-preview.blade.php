@foreach ($products as $product)
  <article class="list">
    <?php 
      $images = $product->getMedia('products');
      $key = rand(0, count($images) - 1);
    ?>
    <figure class="aspect-preview list__figure">
      <img src="about:blank" data-original="{{ $images[$key]->getFullUrl('preview') }}" class="lzl" />
    </figure>
    <h1 class="list__title">{{ $product->name }}</h1>
    <div class="list__summary">{!! nl2br($product->summary) !!}</div>
    <div class="button button__price">{{ $product->getPrice() }}</div>
  </article>
@endforeach