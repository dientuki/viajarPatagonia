@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.region', 1) }}</div>

{!! Form::model($region, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('region', ucfirst(trans_choice('fields.region',1))) !!}
    {!! Form::text('region', null, array('placeholder' => ucfirst(trans_choice('fields.region',1)), 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
    @error('region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  {!! Form::submit(__('buttons.' . $action) . ' '  . ucfirst(trans_choice('fields.region',1)), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection