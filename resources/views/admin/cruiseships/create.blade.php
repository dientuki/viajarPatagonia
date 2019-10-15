@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}
    <div>{{ ucfirst(__('fields.cruiseship')) }}</div>

    @foreach ($languages as $language)
      <fieldset>
        <h2>{{ $language->language }}</h2>

          <div class="form-group">
            <?php $class = $errors->has('title_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('title_' . $language->id, ucfirst(__('fields.title_' . $language->id))) !!}
            {!! Form::text('title_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class)) !!}
            @error('title_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('dropline_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('dropline_' . $language->id, ucfirst(__('fields.dropline_' . $language->id))) !!}
            {!! Form::textarea('dropline_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class)) !!}
            @error('dropline_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('body_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('body_' . $language->id, ucfirst(__('fields.body_' . $language->id))) !!}
            <div class="draftjs" data-field="body_{{$language->id}}"></div>
            {!! Form::text('body_' . $language->id, null, array('class'=>'hidden')) !!}
            @error('body_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div> 

          {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}              
      

      </fieldset>
    @endforeach

    <div class="form-group">
      <?php $class = $errors->has('fk_cruiseship_type') != null ? 'form-control is-invalid' : 'form-control'; ?>
      {!! Form::label('fk_cruiseship_type', ucfirst(__('fields.cruiseshipType'))) !!}
      {!! Form::select('fk_cruiseship_type', $cruiseshipType, $cruiseship->fk_cruiseship_type, array('placeholder' => ucfirst(__('fields.cruiseshipType_select_placeholder')), 'class' => $class) ) !!}
      @error('fk_cruiseship_type')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>  

    <div class="form-check">
      {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
      {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
    </div>

    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          <?php $class = $errors->has('map') != null ? 'form-control is-invalid' : 'form-control'; ?>
          {!! Form::label('map', ucfirst(__('fields.map'))) !!}
          {!! Form::text('map', null, array('placeholder' => __('fields.map'), 'class'=>$class)) !!}
          @error('map')
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>
      </div>
      <div class="col-sm">
        <iframe src="about:blank" id="map"></iframe>
      </div>
    </div>

    <fieldset>
      <h2>Precios</h2>

      
      <div class="row">
        @foreach ($currencies as $currency)
        
        <div class="col-sm">
          <div class="form-group">
            <?php $class = $errors->has('price_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('price_' . $currency->id, ucfirst(__('fields.price_' . $currency->id))) !!}
            {!! Form::text('price_' . $currency->id, null, array('placeholder' => 'placheolder', 'class'=>$class)) !!}
            @error('price_' . $currency->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('discount_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('discount_' . $currency->id, ucfirst(__('fields.discount_' . $currency->id))) !!}
            {!! Form::text('discount_' . $currency->id, null, array('placeholder' => 'placheolder', 'class'=>$class)) !!}
            @error('discount_' . $currency->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-check">
            {!! Form::checkbox('is_active_' . $currency->id, 1, false, array('class' => 'form-check-input') ) !!}
            {!! Form::label('is_active_' . $currency->id, ucfirst(__('fields.active'))) !!}
          </div>

          {!! Form::hidden('fk_currency_' . $currency->id, $currency->id) !!}            
        </div>
        @endforeach

      </div>
    </fieldset>

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.cruiseship')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection