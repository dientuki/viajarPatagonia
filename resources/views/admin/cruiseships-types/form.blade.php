@extends('layouts.admin')

@section ('content')

{!! Form::model($cruiseshipType, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}
<div>{{ ucfirst(__('fields.cruiseshipType')) }}</div>
<div class="form-row align-items-center">

    @foreach ($languages as $language)
      <?php $class = $errors->has('language_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>

      <div class="col-auto">
          <div class="input-group">
              <div class="input-group-prepend">
                  <div class="input-group-text">{{$language->iso}}</div>
              </div>
              {!! Form::text('language_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class, 'required' => true)) !!}
          </div>
          @error('language_' . $language->id)
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
          {!! Form::hidden('fklanguage_' . $language->id, $language->id) !!}
      </div>
    @endforeach

</div>

{!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.cruiseshipType')), array('class'=>'btn
btn-primary') ) !!}


{!! Form::close() !!}

@endsection