<?php

use App\Http\Helpers\Helpers;

$ga = Helpers::getThirdParty('analytics')
?>

@if ($ga != false)
  {!! $ga !!}
@endif