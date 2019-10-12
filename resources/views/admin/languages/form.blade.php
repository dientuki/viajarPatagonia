@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

{!! Form::model($language, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('language') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('language', ucfirst(__('fields.language'))) !!}
    {!! Form::text('language', null, array('placeholder' => ucfirst(__('fields.language')), 'class'=>$class, 'required' => true))  !!}
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

  {!! Form::submit(__('buttons.' . $action) . ' ' .__('fields.language'), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection