<?php use App\Http\Helpers\Helpers; ?>
<div class="col-1 form-inline">
    <select data-param="order" class="sort form-control">
      <option {!!Helpers::selected_filter('order', 'asc')!!}>Asc</option>
      <option {!!Helpers::selected_filter('order', 'desc', true)!!}>Desc</option>
    </select>         
  </div>  