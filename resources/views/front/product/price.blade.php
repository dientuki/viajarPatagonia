@if ($price->is_active)
  <div class="grid-noGutter col-12">
    <div class="col-4-middle price__title">{{ ucfirst(__('front.before')) }}</div>
    <div class="col-middle">
      <div class="bold price__value price__value--discount">{{ $price->iso }} {{ $price->price }}</div>
    </div>
  </div>
  <div class="grid-noGutter col-12">
    <div class="col-4-middle price__title">{{ ucfirst(__('front.now')) }}</div>
    <div class="col-middle bold price__value price__value--regular">{{ $price->iso }} {{ $price->discount }}</div>
  </div>  
@else
  <div class="bold price__value price__value--full col-12">{{ $price->iso }} {{ $price->price }}</div>
@endif