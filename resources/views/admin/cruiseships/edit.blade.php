@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.cruiseship', 1) }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.cruiseship')) }}</div>

    @include('admin.cruiseships._edit.languages')
    @include('admin.cruiseships._edit.common')
    @include('admin.cruiseships._edit.prices')
    @include('admin.cruiseships._edit.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.cruiseship', 1)), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection