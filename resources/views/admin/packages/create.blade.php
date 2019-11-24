@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.package', 1) }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    @include('admin.packages._create.languages')
    @include('admin.packages._create.common')
    @include('admin.packages._create.prices')
    @include('admin.packages._create.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.package', 1)), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection