<?php use App\Http\Helpers\Helpers; ?>

@foreach (Alert::getMessages() as $type => $messages)
  <div class="alert-wrapper animated zoomIn">
    @foreach ($messages as $message)
      <div class="alert alert-{{ $type }}"><strong>{{ ucfirst(trans('alerts.' . $type)) }}!</strong> {{ $message }} <span class="alert-close">{!! Helpers::load_svg('ico-close') !!}</span></div>
    @endforeach
  </div>
@endforeach