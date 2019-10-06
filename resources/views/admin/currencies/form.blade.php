@extends('layouts.admin')

@section ('content')

{!! Form::model($currency, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('sign') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('sign', 'Signo') !!}
    {!! Form::text('sign', null, array('placeholder' => 'Signo', 'class'=>$class, 'required' => true, 'maxlength' => 5))  !!}
    @error('sign')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  <div class="form-group">
    <?php $class = $errors->has('code') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('code', 'Código ISO 4217') !!}
    {!! Form::text('code', null, array('placeholder' => 'Código ISO 4217', 'class'=>$class, 'required' => true, 'maxlength' => 3))  !!}
    @error('code')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  <div class="form-group">
    <?php $class = $errors->has('currency') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('currency', 'Moneda') !!}
    {!! Form::text('currency', null, array('placeholder' => 'Moneda', 'class'=>$class, 'required' => true))  !!}
    @error('currency')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>    

  <div class="form-group">
    <?php $class = $errors->has('amount') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('amount', 'Cambio con respecto al dolar') !!}
    {!! Form::text('amount', null, array('placeholder' => 'Cambio', 'class'=>$class, 'required' => true, 'pattern' => "\d{0,8}\.\d{0,2}"))  !!}
    @error('amount')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>      

  {!! Form::submit(__('buttons.' . $action) . ' moneda', array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection