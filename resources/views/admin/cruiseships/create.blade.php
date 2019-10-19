@extends('layouts.admin')

@section ('content')

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal', 'enctype' => "multipart/form-data"))) !!}
    <div>{{ ucfirst(__('fields.cruiseship')) }}</div>

    <fieldset class="sticky-wrapper">
      <h2 class="sticky-head">Images</h2>

      lavar es: {{ dd(request()) }}!!

      <div id="actions" class="row">

        <div class="col-lg-7">
          <!-- The fileinput-button span is used to style the file input field as button -->
          <div class="btn btn-success fileinput-button" id="dropzone" data-url="{{ route('admin.images.store') }}">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
          </div>
          <div type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel upload</span>
          </div>
        </div>

        <div class="col-lg-5">
          <!-- The global file processing state -->
          <div class="fileupload-process">
            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
          </div>
        </div>

      </div>

      <div class="table table-striped files" id="previews">


      </div>

    </fieldset>

    <div class="hidden">

      <div class="file-row template">
        <!-- This is used as the file preview template -->
        <input type="hidden" name="images[]" value="" />
        <div>
            <span class="preview"><img class="thumbnail" data-dz-thumbnail /></span>
        </div>
        <div>
            <p class="name" data-dz-name></p>
            <strong class="error text-danger" data-dz-errormessage></strong>
        </div>
        <div>
            <p class="size" data-dz-size></p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
        </div>
        <div>
          <div data-dz-remove class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel</span>
          </div>
          <div data-dz-remove class="btn btn-danger delete">
            <i class="glyphicon glyphicon-trash"></i>
            <span>Delete</span>
          </div>
        </div>
      </div>

    </div>

    

    @foreach ($languages as $language)
      <fieldset class="sticky-wrapper">
        <h2 class="sticky-head">{{ $language->language }}</h2>

          <div class="form-group">
            <?php $class = $errors->has('name_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('name_' . $language->id, ucfirst(__('fields.name'))) !!}
            {!! Form::text('name_' . $language->id, null, array('placeholder' => ucfirst(__('fields.name')), 'class'=>$class)) !!}
            @error('name_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('summary_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('summary_' . $language->id, ucfirst(__('fields.summary'))) !!}
            {!! Form::textarea('summary_' . $language->id, null, array('placeholder' => ucfirst(__('fields.summary')), 'class'=>$class)) !!}
            @error('summary_' . $language->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('body_' . $language->id) != null ? 'draftjs is-invalid' : 'draftjs'; ?>
            {!! Form::label('body_' . $language->id, ucfirst(__('fields.body'))) !!}
            {!! Form::hidden('body_' . $language->id, null, array('class'=>'hidden')) !!}
            <div class="{{ $class }}" data-field="body_{{$language->id}}"></div>
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
          {!! Form::text('map', null, array('placeholder' => ucfirst(__('fields.map')), 'class'=>$class)) !!}
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
            {!! Form::label('price_' . $currency->id, ucfirst($currency->currency)) !!}
            {!! Form::text('price_' . $currency->id, null, array('placeholder' => ucfirst(__('fields.price')), 'class'=>$class)) !!}
            @error('price_' . $currency->id)
              <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <?php $class = $errors->has('discount_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('discount_' . $currency->id, ucfirst(__('fields.discount'))) !!}
            {!! Form::text('discount_' . $currency->id, null, array('placeholder' => ucfirst(__('fields.discount')), 'class'=>$class)) !!}
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