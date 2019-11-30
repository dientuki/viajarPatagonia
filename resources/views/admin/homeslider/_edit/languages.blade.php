@foreach ($languages as $language)
  <?php $slider = $homesliderTranslation->firstWhere('fk_language', $language->id); ?>
  @if ($slider != null )
    <fieldset class="sticky-wrapper">
        <h2 class="sticky-head">{{ $language->language }}</h2>

        <div class="form-group">
            <?php $class = $errors->has('title_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('title_' . $language->id, ucfirst(__('fields.title'))) !!}
            {!! Form::text('title_' . $language->id, $slider->title, array('placeholder' => ucfirst(__('fields.title')),
            'class'=>$class, 'required' => true, 'maxlength' => 190)) !!}
            @error('title_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <?php $class = $errors->has('date_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('date_' . $language->id, ucfirst(__('fields.date'))) !!}
            {!! Form::textarea('date_' . $language->id, $slider->date, array('placeholder' => ucfirst(__('fields.date')),
            'class'=>$class, 'required' => true, 'maxlength' => 190)) !!}
            @error('date_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <?php $class = $errors->has('description_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('description_' . $language->id, ucfirst(__('fields.description'))) !!}
            {!! Form::textarea('description_' . $language->id, $slider->description, array('placeholder' => ucfirst(__('fields.description')),
            'class'=>$class, 'required' => true, 'maxlength' => 190)) !!}            
            @error('description_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}
    </fieldset>
  @endif
@endforeach