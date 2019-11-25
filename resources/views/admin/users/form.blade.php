@extends('layouts.admin')

@section ('content')

<div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.user', 1) }}</div>

{!! Form::model($user, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

  <div class="form-group">
    <?php $class = $errors->has('name') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('name', ucfirst(__('fields.name'))) !!}
    {!! Form::text('name', null, array('placeholder' => ucfirst(__('fields.name')), 'class'=>$class, 'required' => true))  !!}
    @error('name')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>
  
  <div class="form-group">
    <?php $class = $errors->has('email') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('email', ucfirst(__('fields.email'))) !!}
    {!! Form::email('email', null, array('placeholder' => ucfirst(__('fields.email')), 'class'=>$class, 'required' => true)) !!}
    @error('email')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>  

  @if ($action == 'update' && auth()->user()->id == $user->id)
    <div class="form-group">
      <?php $class = $errors->has('password') != null ? 'form-control is-invalid' : 'form-control'; ?>
      {!! Form::label('password', ucfirst(__('fields.password'))) !!}
      {!! Form::password('password', array('placeholder' => ucfirst(__('fields.password')), 'class'=>$class))  !!}
      @error('password')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>

    <div class="form-group">
      <?php $class = $errors->has('password_confirm') != null ? 'form-control is-invalid' : 'form-control'; ?>
      {!! Form::label('password_confirm', ucfirst(__('fields.password_confirm'))) !!}
      {!! Form::password('password_confirm', array('placeholder' => ucfirst(__('fields.password_confirm')), 'class'=>$class))  !!}
      @error('password_confirm')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>    
  @endif


  {!! Form::submit(__('buttons.' . $action) . ' ' .trans_choice('fields.user', 1), array('class'=>'btn btn-primary') ) !!}


{!! Form::close() !!}

@endsection