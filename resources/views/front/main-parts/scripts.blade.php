<?php

use App\Http\Helpers;

$ga = Helpers::getThirdParty('analytics')
?>

@if ($ga != false)
  {!! $ga !!}
@endif