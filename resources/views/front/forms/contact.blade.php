{!! Form::model(null, array('route' => 'forms.contact.store', 'method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal')) !!}

  <div class="col">
    <?php $class = $errors->has('name') != null ? 'form-control is-invalid' : 'form-control'; ?>
    {!! Form::label('name', ucfirst(trans_choice('fields.name',1))) !!}
    {!! Form::text('name', null, array('placeholder' => ucfirst(trans_choice('fields.name',1)), 'class'=>$class, 'maxlength' => 190))  !!}
    @error('name')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @enderror
  </div>

  

  {!! Form::submit(__('buttons.create') . ' ' . ucfirst(trans_choice('fields.availability', 1)), array('class'=>'btn btn-primary') ) !!}

{!! Form::close() !!}