@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.language', 1) }}</div>

{!! Form::model($language, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('language') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('language', ucfirst(trans_choice('fields.language',1))) !!}
    {!! Form::text('language', null, array('placeholder' => ucfirst(trans_choice('fields.language',1)), 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
    @error('language')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>
  
  <div class="form-group">
    <?php $class = $errors->has('iso') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('iso', ucfirst(__('fields.iso')) . ' ISO 639-1') !!}
    {!! Form::text('iso', null, array('placeholder' => ucfirst(__('fields.iso')) . ' ISO 639-1', 'class'=>$class, 'required' => true, 'maxlength' => 3)) !!}
    @error('iso')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' ' .trans_choice('fields.language',1), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection