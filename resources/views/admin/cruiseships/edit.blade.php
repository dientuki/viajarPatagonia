@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}
    <div>{{ ucfirst(__('fields.cruiseship')) }}</div>

    @foreach ($languages as $language)
      <fieldset class="sticky-wrapper">
        <?php $cruiseshipLanguage = $cruiseshipTranslation->firstWhere('fk_language', $language->id); ?>

        @if ($cruiseshipLanguage != null )
          <h2 class="sticky-head">{{ $language->language }}</h2>

          <div class="form-group">
            <?php $class = $errors->has('name_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('name_' . $language->id, ucfirst(__('fields.name'))) !!}
            {!! Form::text('name_' . $language->id, $cruiseshipLanguage->name, array('placeholder' => ucfirst(__('fields.name')), 'class'=>$class)) !!}
            @error('name_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('summary_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('summary_' . $language->id, ucfirst(__('fields.summary'))) !!}
            {!! Form::textarea('summary_' . $language->id, $cruiseshipLanguage->summary, array('placeholder' => ucfirst(__('fields.summary')), 'class'=>$class)) !!}
            @error('summary_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('body_' . $language->id) != null ? 'draftjs is-invalid' : 'draftjs'; ?>
            {!! Form::label('body_' . $language->id, ucfirst(__('fields.body'))) !!}
            {!! Form::hidden('body_' . $language->id, $cruiseshipLanguage->body, array('class'=>'hidden')) !!}
            <div class="{{ $class }}" data-field="body_{{$language->id}}"></div>
            @error('body_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div> 

          {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}              
        @endif

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
      {!! Form::checkbox('is_active', 1, $cruiseship->is_active, array('class' => 'form-check-input') ) !!}
      {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
    </div>

    <div class="row">
      <div class="col-sm">
        <div class="form-group">
          <?php $class = $errors->has('map') != null ? 'form-control is-invalid' : 'form-control'; ?>
          {!! Form::label('map', ucfirst(__('fields.map'))) !!}
          {!! Form::text('map', $cruiseship->map, array('placeholder' => ucfirst(__('fields.map')), 'class'=>$class)) !!}
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

          <?php $cruiseshipCurrency = $cruiseshipPrice->firstWhere('fk_currency', $currency->id); ?>

          <div class="col-sm">
            <div class="form-group">
              <?php 
                $class = $errors->has('price_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control';
                $value = isset($cruiseshipCurrency->price) ? $cruiseshipCurrency->price : null;
              ?>
              {!! Form::label('price_' . $currency->id, ucfirst($currency->currency)) !!}
              {!! Form::text('price_' . $currency->id, $value , array('placeholder' => ucfirst(__('fields.price')), 'class'=>$class)) !!}
              @error('price_' . $currency->id)
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>

            <div class="form-group">
              <?php 
                $class = $errors->has('discount_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control';
                $value = isset($cruiseshipCurrency->discount) ? $cruiseshipCurrency->discount : null;
              ?>
              {!! Form::label('discount_' . $currency->id, ucfirst(__('fields.discount'))) !!}
              {!! Form::text('discount_' . $currency->id, $value, array('placeholder' => ucfirst(__('fields.discount')), 'class'=>$class)) !!}
              @error('discount_' . $currency->id)
                <div class="invalid-feedback">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
            </div>

            <div class="form-check">
              <?php $value = isset($cruiseshipCurrency->is_active) ? $cruiseshipCurrency->is_active : false; ?>
              {!! Form::checkbox('is_active_' . $currency->id, 1, $value, array('class' => 'form-check-input') ) !!}
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