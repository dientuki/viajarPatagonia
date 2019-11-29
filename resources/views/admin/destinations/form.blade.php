@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.destination', 1) }}</div>

{!! Form::model($destination, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('destination') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('destination', ucfirst(trans_choice('fields.destination',1))) !!}
    {!! Form::text('destination', null, array('placeholder' => ucfirst(trans_choice('fields.destination',1)), 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
    @error('destination')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  <div class="form-group">
    <?php $class = $errors->has('fk_region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('fk_region', ucfirst(trans_choice('fields.region',1))) !!}
    {!! Form::select('fk_region', $regions, $destination->fk_region, array('placeholder' => ucfirst(__('fields.region_select_placeholder')), 'required' => true, 'class' => $class) ) !!}
    @error('fk_region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' ' . trans_choice('fields.destination',1), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection