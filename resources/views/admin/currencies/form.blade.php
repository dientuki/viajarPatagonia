@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.currency', 1) }}</div>

{!! Form::model($currency, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('sign') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('sign', ucfirst(__('fields.sign'))) !!}
    {!! Form::text('sign', null, array('placeholder' => ucfirst(__('fields.sign')), 'class'=>$class, 'required' => true, 'maxlength' => 5))  !!}
    @error('sign')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>
  
  <div class="form-group">
    <?php $class = $errors->has('iso') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('iso', ucfirst(__('fields.iso')) . ' ISO 4217') !!}
    {!! Form::text('iso', null, array('placeholder' => ucfirst(__('fields.iso')) . ' ISO 4217', 'class'=>$class, 'required' => true, 'maxlength' => 3)) !!}
    @error('iso')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  <div class="form-group">
    <?php $class = $errors->has('currency') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('currency', ucfirst(trans_choice('fields.currency',1))) !!}
    {!! Form::text('currency', null, array('placeholder' => ucfirst(trans_choice('fields.currency',1)), 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
    @error('currency')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>    

  <div class="form-group">
    <?php $class = $errors->has('amount') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('amount', ucfirst(__('fields.amount_long'))) !!}
    {!! Form::text('amount', null, array('placeholder' => ucfirst(__('fields.amount')), 'class'=>$class, 'required' => true, 'pattern' => "\d{0,8}\.\d{0,2}"))  !!}
    @error('amount')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>      

  {!! Form::submit(__('buttons.' . $action) . ' ' .trans_choice('fields.currency',1), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection