@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . __('fields.slider') }}</div>
  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}

    @include('admin.homeslider._create.languages')
    @include('admin.homeslider._create.common')
    @include('admin.homeslider._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.slider')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection