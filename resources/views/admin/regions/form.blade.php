@extends('layouts.admin')

@section ('content')

@foreach (Alert::getMessages() as $type => $messages)
  <div class="alert-wrapper">
    @foreach ($messages as $message)
      <div class="alert-animation animated zoomIn">
        <div class="alert-fix">
          <div class="alert alert-{{ $type }}"><strong>{{ ucfirst(trans('alerts.' . $type)) }}!</strong> {{ $message }} <span class="alert-close"></span></div>
        </div>
      </div>
    @endforeach
  </div>
@endforeach

{!! Form::model($region, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

<div class="form-group {{ $errors->first('region') != null ? 'has-error' : '' }}">
        {!! Form::label('region', 'Region', array('class' => 'col-sm-2 control-label'))  !!}
        <div class="col-sm-10">
          {!! Form::text('region', null, array('placeholder' => 'Region', 'class'=>'form-control'))  !!}
        </div>

      </div>

      {!! Form::submit(trans('validation.attributes.' . $action), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection