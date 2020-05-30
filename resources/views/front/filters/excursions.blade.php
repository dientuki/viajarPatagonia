<?php use App\Http\Helpers\Helpers; ?>

<div class="grid has-FS filter">
  <div class="col-1_lg-2_sm-12"><div class="filter-title">{{ ucfirst(__('filters.title')) }}:</div></div>
  <div class="col-4_sm-12">
    <select data-param="destination" class="form-control">
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('filters.destination')) }}</option>
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('filters.all')) }}</option>
        @foreach ($destinations as $key => $destination)
          <option {!!Helpers::selected_filter('destination', $key)!!}>{{ $destination }}</option>
        @endforeach
      </select>  
  </div>
  
  <div class="col-4_sm-12">
    <select data-param="duration" class="form-control">
      <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('filters.duration')) }}</option>
      <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('filters.all')) }}</option>
        @foreach ($durations as $key => $duration)
          <option {!!Helpers::selected_filter('duration', $key)!!}>{{ $duration }}</option>
        @endforeach
      </select> 
  </div>
</div>  