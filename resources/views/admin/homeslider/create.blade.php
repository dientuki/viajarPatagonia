@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.slide')) }}</div>

    @include('admin.homeslider._create.languages')
    @include('admin.homeslider._create.common')
    @include('admin.homeslider._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.slide')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection