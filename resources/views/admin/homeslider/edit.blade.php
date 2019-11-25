@extends('layouts.admin')

@section ('content')
  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . __('fields.slider') }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}

    @include('admin.homeslider._edit.languages')
    @include('admin.homeslider._edit.common')
    @include('admin.homeslider._edit.images')    

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.slider')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection