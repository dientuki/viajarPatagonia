@extends('layouts.admin')

@section ('content')

{!! Form::model($region, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('region', 'Region') !!}
    {!! Form::text('region', null, array('placeholder' => 'Region', 'class'=>$class, 'required' => true))  !!}
    @error('region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  {!! Form::submit(__('buttons.' . $action) . ' region', array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection