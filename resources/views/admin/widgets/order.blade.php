<?php
  use App\Http\Helpers\Helpers;
 
  $default = isset($default) ? $default : 'desc';
?>

<div class="col-1 form-inline">
    <select data-param="order" class="sort form-control">
      <option {!!Helpers::selected_filter('order', 'asc', $default)!!}>Asc</option>
      <option {!!Helpers::selected_filter('order', 'desc', $default)!!}>Desc</option>
    </select>         
  </div>  