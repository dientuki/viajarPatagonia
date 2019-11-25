<fieldset class="sticky-wrapper loadMap">
  <h2 class="sticky-head">Datos</h2>

  <div class="row">
    <div class="col-5">

      <div class="form-group multiselect" data-children=".multichildren">

        <?php $class = $errors->has('destination') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('destination', ucfirst(trans_choice('fields.destination',2))) !!}
        {!! Form::hidden('destination', '') !!}
        <ul class="{{$class}} tag-list"></ul>
        
        @error('destination')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror        
        
        <select class="form-control" multiple="" size="4">
          <option selected="selected" value="">{{ucfirst(__('fields.destination_select_placeholder'))}}</option>
            @foreach ($destinations as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>

      </div>

      <div class="form-group multiselect multichildren" data-data="destination">

        <?php $class = $errors->has('excursion') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('excursion', ucfirst(trans_choice('fields.excursion',2))) !!}
        {!! Form::hidden('excursion', '') !!}
        <ul class="{{$class}} tag-list"></ul>
        
        @error('excursion')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror

        <select class="form-control" multiple="" size="4">
          <option selected="selected" value="">{{ucfirst(__('fields.excursionType_select_placeholder'))}}</option>
            @foreach ($excursions as $excursion)
              <option value="{{$excursion->id}}" data-destination="{{$excursion->fk_destination}}" class="hidden">{{$excursion->name}}</option>
            @endforeach
        </select>

      </div>

      <div class="form-check">
        {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input', 'id' => 'is_active') ) !!}
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
    <div class="col-7">
      <div class="aspect-16-9">
        <iframe class="map" src="about:blank"></iframe>
      </div>
    </div>
  </div>
</fieldset>