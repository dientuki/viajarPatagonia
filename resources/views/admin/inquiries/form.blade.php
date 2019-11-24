<?php 
  use App\Http\Helpers\Helpers;
?>

@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">
    {{ ucfirst(__('fields.inquiry')) }}
  </div>

{!! Form::model($inquiry, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">

    <div class="form-row">
      <div class="form-group col">
        <?php $class = $errors->has('name') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('name', ucfirst(__('fields.name'))) !!}
        {!! Form::text('name', null, array('placeholder' => ucfirst(__('fields.name')), 'class'=>$class)) !!}
        @error('name')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group col-2">
        <?php $class = $errors->has('timestamp') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('timestamp', ucfirst(__('fields.timestamp'))) !!}
        {!! Form::text('timestamp', null, array('placeholder' => ucfirst(__('fields.timestamp')), 'class'=>$class, 'min' => 1, 'max' => 5)) !!}
        @error('timestamp')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>
    </div>  

    <div class="form-row">
      <div class="form-group col">
        <?php $class = $errors->has('email') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('email', ucfirst(__('fields.email'))) !!}
        {!! Form::text('email', null, array('placeholder' => ucfirst(__('fields.email')), 'class'=>$class)) !!}
        @error('email')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group col">
        <?php $class = $errors->has('phone') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('phone', ucfirst(__('fields.phone'))) !!}
        {!! Form::text('phone', null, array('placeholder' => ucfirst(__('fields.phone')), 'class'=>$class, 'min' => 1, 'max' => 5)) !!}
        @error('phone')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group col">
        <?php $class = $errors->has('departure') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('departure', ucfirst(__('fields.departure'))) !!}
        {!! Form::text('departure', null, array('placeholder' => ucfirst(__('fields.departure')), 'class'=>$class, 'min' => 1, 'max' => 5)) !!}
        @error('departure')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>      
    </div>     

    <div class="form-row">
      <div class="form-group col-1">
        <?php $class = $errors->has('adult') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('adult', ucfirst(__('fields.adult'))) !!}
        {!! Form::text('adult', null, array('placeholder' => ucfirst(__('fields.adult')), 'class'=>$class)) !!}
        @error('adult')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group col-1">
        <?php $class = $errors->has('child') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('child', ucfirst(__('fields.child'))) !!}
        {!! Form::text('child', null, array('placeholder' => ucfirst(__('fields.child')), 'class'=>$class, 'min' => 1, 'max' => 5)) !!}
        @error('child')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>  
      
      <div class="form-group col">
        {!! Form::label(null, ucfirst(__('fields.product'))) !!}
        <div class="form-control">
          {!! Helpers::load_svg('lang-' . $inquiry->getIso($inquiry->fk_language) ) !!}
          {!! Helpers::load_svg('ico-' . $inquiry->product ) !!}
          <?php $title = Helpers::product_title($inquiry); ?>
          <a title="{{ $title }}" rel="noopener" target="_blank" href="{{route($inquiry->product, Helpers::product_params($inquiry))}}">{{ $title }}</a>
        </div>
      </div>
    </div>     

  </div>

  <div class="form-group">
    <?php $class = $errors->has('comment') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('comment', ucfirst(__('fields.comment'))) !!}
    {!! Form::textarea('comment', null, array('placeholder' => ucfirst(__('fields.comment')), 'class'=>$class, 'required' => true, 'maxlength' => 3)) !!}
    @error('comment')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' '  . ucfirst(__('fields.inquiry')), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection