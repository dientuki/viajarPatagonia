@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.thirdParty', 1) }}</div>

{!! Form::model($thirdParty, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('name') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('name', ucfirst(__('fields.name'))) !!}
    {!! Form::text('name', null, array('placeholder' => ucfirst(__('fields.name')), 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
    @error('name')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>
  
  <div class="form-group">
    <?php $class = $errors->has('code') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('code', ucfirst(__('fields.code'))) !!}
    {!! Form::textarea('code', null, array('placeholder' => ucfirst(__('fields.code')), 'class'=>$class, 'required' => true)) !!}
    @error('code')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  <div class="form-check">
    {!! Form::checkbox('is_active', 1, null, array('class' => 'form-check-input') ) !!}
    {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' ' .trans_choice('fields.thirdParty',1), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection