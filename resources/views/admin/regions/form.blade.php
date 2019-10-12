@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

{!! Form::model($region, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('region', ucfirst(__('fields.region'))) !!}
    {!! Form::text('region', null, array('placeholder' => ucfirst(__('fields.region')), 'class'=>$class, 'required' => true))  !!}
    @error('region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  {!! Form::submit(__('buttons.' . $action) . ' '  . ucfirst(__('fields.region')), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection