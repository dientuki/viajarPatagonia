@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.excursion')) }}</div>

    @include('admin.excursions._edit.languages')
    @include('admin.excursions._edit.common')
    @include('admin.excursions._edit.prices')
    @include('admin.excursions._edit.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.excursion')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection