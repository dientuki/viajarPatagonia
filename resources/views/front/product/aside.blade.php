<h6>Otros paquetes</h6>

@foreach ($relateds as $related)
  <article>
    <figure class="aspect-preview">
      <img src="about:blank" data-original="" class="lzl" />
    </figure>
    <h1>{{ $related->name }}</h1>
    <div>{{ $related->summary }}</div>
    <div>precio</div>
  </article>
@endforeach