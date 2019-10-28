@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.package')) }}</div>

    @include('admin.packages._create.languages')
    @include('admin.packages._create.common')
    @include('admin.packages._create.prices')
    @include('admin.packages._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.package')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection