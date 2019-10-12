@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

{!! Form::model($destination, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('destination') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('destination', ucfirst(__('fields.destination'))) !!}
    {!! Form::text('destination', null, array('placeholder' => ucfirst(__('fields.destination')), 'class'=>$class, 'required' => true))  !!}
    @error('destination')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  <div class="form-group">
    <?php $class = $errors->has('fk_region') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('fk_region', ucfirst(__('fields.region'))) !!}
    {!! Form::select('fk_region', $regions, $destination->fk_region, array('placeholder' => ucfirst(__('fields.region_select_placeholder')), 'required' => true, 'class' => $class) ) !!}
    @error('fk_region')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  {!! Form::submit(__('buttons.' . $action) . ' ' . __('fields.destination'), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection