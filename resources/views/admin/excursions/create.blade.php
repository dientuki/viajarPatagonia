@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.excursion')) }}</div>

    @include('admin.excursions._create.languages')
    @include('admin.excursions._create.common')
    @include('admin.excursions._create.prices')
    @include('admin.excursions._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.excursion')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection