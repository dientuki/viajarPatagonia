<div class="col grid form-inline row has-FS ">
  <div class="col-6">
    <select data-param="destination" class="filter form-control col">
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('fields.destination_select_placeholder')) }}</option>
      <option {!!Helpers::selected_filter('destination', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
        @foreach ($destinations as $key => $destination)
          <option {!!Helpers::selected_filter('destination', $key)!!}>{{ $destination }}</option>
        @endforeach
      </select>  
  </div>
  
  <div class="col-6">
    <select data-param="duration" class="filter form-control col">
      <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('fields.duration_select_placeholder')) }}</option>
      <option {!!Helpers::selected_filter('duration', 'reset')!!}>{{ ucfirst(__('fields.all')) }}</option>
        @foreach ($durations as $key => $duration)
          <option {!!Helpers::selected_filter('duration', $key)!!}>{{ $duration }}</option>
        @endforeach
      </select> 
  </div>
</div>  