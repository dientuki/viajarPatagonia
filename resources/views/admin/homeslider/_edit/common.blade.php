<fieldset class="sticky-wrapper">
  <h2 class="sticky-head">Datos</h2>

  <div class="row">
      <div class="form-group">
        <?php $class = $errors->has('hotel') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('hotel', ucfirst(__('fields.hotel'))) !!}
        {!! Form::text('hotel', null, array('placeholder' => ucfirst(__('fields.hotel')), 'class'=>$class)) !!}
        @error('hotel')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group">
        <?php $class = $errors->has('stars') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('stars', ucfirst(__('fields.stars'))) !!}
        {!! Form::text('stars', null, array('placeholder' => ucfirst(__('fields.stars')), 'class'=>$class)) !!}
        @error('stars')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group">
        <?php $class = $errors->has('url') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('url', ucfirst(__('fields.url'))) !!}
        {!! Form::text('url', null, array('placeholder' => ucfirst(__('fields.url')), 'class'=>$class)) !!}
        @error('url')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>    

      <div class="form-check">
        {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
        {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
      </div>

    </div>
  </div>
</fieldset>