@foreach ($products as $product)
  <article class="list list--horizontal grid col-12">
    <?php 
      $images = $product->getMedia('products');
      $img = '';
      if (count($images) != 0) {
        $key = rand(0, count($images) - 1);
        $img = $images[$key]->getFullUrl('preview');
      }
      
    ?>
    <div class="col-3">
      <figure class="aspect-preview list__figure">
        <img src="about:blank" data-original="{{ $img }}" class="lzl" />
      </figure>
    </div>
    <div class="col">
      <h1 class="list__title">{{ $product->name }}</h1>
      @if (isset($product->dataExtra))
        <div class="list__summary">{!! nl2br($product->summary) !!}</div>
      @endif
      <div class="list__data-extra bold">Disponible: Todo el año - Duración: Día Completo</div>
      <div class="list__summary">{!! nl2br($product->summary) !!}</div>
    </div>
    <div class="col-3">
      <div class="button button__price">{{ $product->getPrice() }} {{__('front.final')}}</div>
    </div>
  </article>
@endforeach