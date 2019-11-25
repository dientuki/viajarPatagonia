<fieldset class="sticky-wrapper loadMap">
  <h2 class="sticky-head">Datos</h2>

  <div class="row">
    <div class="col-sm">

      <div class="form-group">
        <?php $class = $errors->has('fk_excursion_type') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('fk_excursion_type', ucfirst(trans_choice('fields.excursionType',1))) !!}
        {!! Form::select('fk_excursion_type', $excursionType, $excursion->fk_excursion_type,
        array('placeholder' =>
        ucfirst(__('fields.excursionType_select_placeholder')), 'class' => $class) ) !!}
        
        @error('fk_excursion_type')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group">
        <?php $class = $errors->has('fk_destination') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('fk_destination', ucfirst(trans_choice('fields.destination',1))) !!}
        {!! Form::select('fk_destination', $destination, $excursion->fk_destination,
        array('placeholder' =>
        ucfirst(__('fields.destination_select_placeholder')), 'class' => $class) ) !!}
        @error('fk_destination')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group">
        <?php $class = $errors->has('fk_availability') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('fk_availability', ucfirst(trans_choice('fields.availability',1))) !!}
        {!! Form::select('fk_availability', $availability, $excursion->fk_availability,
        array('placeholder' =>
        ucfirst(__('fields.availability_select_placeholder')), 'class' => $class) ) !!}
        @error('fk_availability')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>   

      <div class="form-group">
        <?php $class = $errors->has('fk_duration') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('fk_duration', ucfirst(__('fields.duration'))) !!}
        {!! Form::select('fk_duration', $duration, $excursion->fk_duration,
        array('placeholder' =>
        ucfirst(__('fields.duration_select_placeholder')), 'class' => $class) ) !!}
        @error('fk_duration')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>          

      <div class="form-check">
        {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
        {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
      </div>

      <div class="form-group">
        <?php $class = $errors->has('map') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('map', ucfirst(__('fields.map'))) !!}
        {!! Form::text('map', null, array('placeholder' => ucfirst(__('fields.map')), 'class'=>$class)) !!}
        @error('map')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>
    </div>
    <div class="col-sm">
      <div class="aspect-16-9">
        <iframe class="map" src="about:blank"></iframe>
      </div>
    </div>
  </div>
</fieldset>