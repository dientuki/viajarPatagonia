@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.cruiseship', 1) }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}

    @include('admin.cruiseships._create.languages')
    @include('admin.cruiseships._create.common')
    @include('admin.cruiseships._create.prices')
    @include('admin.cruiseships._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.cruiseship', 1)), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection