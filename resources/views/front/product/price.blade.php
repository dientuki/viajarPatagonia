@if ($price->is_active)
  <div class="grid">
    <div class="col-4 price__title">{{ ucfirst(__('front.before')) }}</div>
    <div class="col">
      <div class="bold price__value price__value--discount">{{ $price->iso }} {{ $price->price }}</div>
    </div>
  </div>
  <div class="grid">
    <div class="col-4 price__title">{{ ucfirst(__('front.now')) }}</div>
    <div class="col bold price__value price__value--regular">{{ $price->iso }} {{ $price->discount }}</div>
  </div>  
@else
  <div class="bold price__value price__value--full">{{ $price->iso }} {{ $price->price }}</div>
@endif