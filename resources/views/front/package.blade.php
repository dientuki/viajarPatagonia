@extends('layouts.product')

@section ('content')

  <article class="wrapper">
    <header>
      <h1>{{ $package->name }}</h1>
      <div>
        <div>slider</div>
        <div class="aside">
          Precios
          <div>
            {{ $package->summary }}
        </div>
      </div>
    </header>

    <main>
      {{ $package->body }}

      <iframe src="about:blank" data-src="{{ $package->map }}"></iframe>
    </main>
    <aside></aside>

  </article>

@endsection