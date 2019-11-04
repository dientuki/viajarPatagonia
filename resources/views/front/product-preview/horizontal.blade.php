@foreach ($products as $product)
  <article class="list grid col-12">
    <?php 
      $images = $product->getMedia('products');
      $img = '';
      if (count($images) != 0) {
        $key = rand(0, count($images) - 1);
        $img = $images[$key]->getFullUrl('preview');
      }
      
    ?>
    <figure class="aspect-preview list__figure col-3">
      <img src="about:blank" data-original="{{ $img }}" class="lzl" />
    </figure>
    <div class="col">
      <h1 class="list__title">{{ $product->name }}</h1>
      <div class="list__summary">{!! nl2br($product->summary) !!}</div>
    </div>
    <div class="col-3">
      <div class="button button__price">{{ $product->getPrice() }}</div>
    </div>
  </article>
@endforeach