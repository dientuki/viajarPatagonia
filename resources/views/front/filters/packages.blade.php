<?php use App\Http\Helpers\Helpers; ?>

<div class="grid has-FS filter">
  <div class="col-1_lg-2_sm-12"><div class="filter-title">{{ ucfirst(__('filters.title')) }}:</div></div>
  <div class="col_sm-12">
    <select data-param="destination" class="form-control">
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('filters.destination')) }}</option>
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('filters.all')) }}</option>
        @foreach ($destinations as $key => $destination)
          <option {!!Helpers::selected_filter('destination', $key)!!}>{{ $destination }}</option>
        @endforeach
      </select>  
  </div>
  
  <div class="col_sm-12">
    <select data-param="excursion" class="form-control">
      <option {!!Helpers::selected_filter('excursion', 'reset')!!}>{{ ucfirst(__('filters.excursion')) }}</option>
      <option {!!Helpers::selected_filter('excursion', 'reset')!!}>{{ ucfirst(__('filters.all')) }}</option>
        @foreach ($excursions as $key => $excursion)
          <option {!!Helpers::selected_filter('excursion', $key)!!}>{{ $excursion }}</option>
        @endforeach
      </select> 
  </div>

  <div class="col-1_lg-2_sm-12"><div class="filter-reset">{{ ucfirst(__('filters.reset')) }}</div></div>
</div>  