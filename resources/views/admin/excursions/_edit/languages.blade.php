@foreach ($languages as $language)
  <?php $excursionLanguage = $excursionTranslation->firstWhere('fk_language', $language->id); ?>
  @if ($excursionLanguage != null )
    <fieldset class="sticky-wrapper">
        <h2 class="sticky-head">{{ $language->language }}</h2>

        <div class="form-group">
            <?php $class = $errors->has('name_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('name_' . $language->id, ucfirst(__('fields.name'))) !!}
            {!! Form::text('name_' . $language->id, $excursionLanguage->name, array('placeholder' => ucfirst(__('fields.name')),
            'class'=>$class)) !!}
            @error('name_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <?php $class = $errors->has('summary_' . $language->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
            {!! Form::label('summary_' . $language->id, ucfirst(__('fields.summary'))) !!}
            {!! Form::textarea('summary_' . $language->id, $excursionLanguage->summary, array('placeholder' => ucfirst(__('fields.summary')),
            'class'=>$class)) !!}
            @error('summary_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        <div class="form-group">
            <?php $class = $errors->has('body_' . $language->id) != null ? 'draftjs is-invalid' : 'draftjs'; ?>
            {!! Form::label('body_' . $language->id, ucfirst(__('fields.body'))) !!}
            {!! Form::hidden('body_' . $language->id, $excursionLanguage->body, array('class'=>'hidden')) !!}
            <div class="{{ $class }}" data-field="body_{{$language->id}}"></div>
            @error('body_' . $language->id)
            <div class="invalid-feedback">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
        </div>

        {!! Form::hidden('fk_language_' . $language->id, $language->id) !!}
    </fieldset>
  @endif
@endforeach