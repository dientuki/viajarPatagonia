@extends('layouts.admin')

@section ('content')

{!! Form::model($destination, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('destination') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('destination', 'Destino') !!}
    {!! Form::text('destination', null, array('placeholder' => 'Destino', 'class'=>$class, 'required' => true))  !!}
    @error('destination')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  <div class="form-group">
    <?php $class = $errors->has('fk_region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('fk_region', 'Region') !!}
    {!! Form::select('fk_region', $regions, $destination->fk_region, array('placeholder' => 'Seleccione una region...', 'required' => true, 'class' => $class) ) !!}
    @error('fk_region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' destino', array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection