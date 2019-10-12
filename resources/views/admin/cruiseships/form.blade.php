@push('scripts')
  <script src="{{ load_resource('adminDashboard.js') }}" defer crossorigin="anonymous"></script>
@endpush

@extends('layouts.admin')

@section ('content')

  {!! Form::model($cruiseship, array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}
    <div>{{ ucfirst(__('fields.cruiseship')) }}</div>

    @foreach ($languages as $language)
      <fieldset>
        <h2>{{ $language->language }}</h2>

        <div class="form-group">
          <?php $class = $errors->has('title_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
          {!! Form::label('title_' . $language->id, ucfirst(__('fields.title_' . $language->id))) !!}
          {!! Form::text('title_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class, 'required' => true)) !!}
          @error('title_' . $language->id)
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

        <div class="form-group">
          <?php $class = $errors->has('dropline_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
          {!! Form::label('dropline_' . $language->id, ucfirst(__('fields.dropline_' . $language->id))) !!}
          {!! Form::text('dropline_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class, 'required' => true)) !!}
          @error('dropline_' . $language->id)
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>

        <div class="form-group">
          <?php $class = $errors->has('body_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
          {!! Form::label('body_' . $language->id, ucfirst(__('fields.body_' . $language->id))) !!}
          {!! Form::text('body_' . $language->id, null, array('placeholder' => $language->language, 'class'=>$class, 'required' => true)) !!}
          @error('body_' . $language->id)
            <div class="invalid-feedback">
              <strong>{{ $message }}</strong>
            </div>
          @enderror
        </div>                

      </fieldset>
    @endforeach


    <div class="form-check">
      {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
      {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
    </div>

    <div class="form-group">
      <?php $class = $errors->has('map') != null ? 'form-control is-invalid' : 'form-control'; ?>
      {!! Form::label('map', ucfirst(__('fields.map'))) !!}
      {!! Form::text('map', null, array('placeholder' => __('fields.map'), 'class'=>$class, 'required' => true)) !!}
      @error('map')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @enderror
    </div>      


    <div id="draftjs"></div>   

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(__('fields.cruiseship')), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection