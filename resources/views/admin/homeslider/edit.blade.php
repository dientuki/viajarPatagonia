@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.excursion')) }}</div>

    @include('admin.homeslider._edit.languages')
    @include('admin.homeslider._edit.common')
    @include('admin.homeslider._edit.images')    

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.excursion')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection