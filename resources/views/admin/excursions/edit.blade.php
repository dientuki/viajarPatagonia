@extends('layouts.admin')

@section ('content')
  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.excursion', 1) }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    @include('admin.excursions._edit.languages')
    @include('admin.excursions._edit.common')
    @include('admin.excursions._edit.prices')
    @include('admin.excursions._edit.images')

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.excursion', 1)), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection