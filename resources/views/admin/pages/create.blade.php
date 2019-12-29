@extends('layouts.admin')

@section ('content')

  <div class="header-sticky">{{ __('buttons.' . $action) . ' ' . trans_choice('fields.page', 1) }}</div>

  {!! Form::open(array_merge($form_data, array('role' => 'form', 'class' => 'form-horizontal'))) !!}

    @foreach ($languages as $language)
    <fieldset class="sticky-wrapper">
        <h2 class="sticky-head">{{ $language->language }}</h2>

        <div class="form-group">
            <?php $class = $errors->has('title_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('title_' . $language->id, ucfirst(__('fields.title'))) !!}
            {!! Form::text('title_' . $language->id, null, array('placeholder' => ucfirst(__('fields.title')),
            'class'=>$class, 'required'=>true, 'maxlength' => 190)) !!}
            @error('title_' . $language->id)
            <div class="invalid-feedback">|
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group has-slug" data-slug="input[name={{ 'title_' . $language->id }}]">
            <?php $class = $errors->has('slug_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('slug_' . $language->id, ucfirst(__('fields.slug'))) !!}
            {!! Form::text('slug_' . $language->id, null, array('placeholder' => ucfirst(__('fields.slug')),
            'class'=>$class, 'required'=>true, 'pattern' => '[a-z0-9_-]*')) !!}
            @error('slug_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <?php $class = $errors->has('body_' . $language->id) != null ? 'draftjs is-invalid' : 'draftjs'; ?>
            {!! Form::label('body_' . $language->id, ucfirst(__('fields.body'))) !!}
            <div class="relative">
              {!! Form::text('body_' . $language->id, null, array('class'=>'below-draft', 'required'=>true)) !!}
              <div class="{{ $class }}" data-field="body_{{$language->id}}"></div>
            </div>
            @error('body_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}
    </fieldset>
    @endforeach

    <div class="form-check">
      {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
      {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
    </div>

    {!! Form::submit(__('buttons.' . $action) . ' ' . ucfirst(trans_choice('fields.page', 1)), array('class'=>'btn btn-primary') ) !!}

  {!! Form::close() !!}

@endsection