<?php use App\Http\Helpers\Helpers; ?>

@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.availability', 1) }}</div>

{!! Form::model($availability, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <fieldset class="form-group">
  <div class="row">

    @foreach ($languages as $language)
      <?php $class = $errors->has('language_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>

      <div class="col">
          <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text">{!! Helpers::load_svg('lang-' . $language->iso) !!}</div>
              </div>
              {!! Form::text('language_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class, 'required' => true, 'maxlength' => 190))  !!}
              @error('language_' . $language->id)
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          </div>

          {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}
      </div>
    @endforeach

  </div>
</fieldset>

{!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.availability', 1)), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection