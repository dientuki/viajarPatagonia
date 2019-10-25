<fieldset class="sticky-wrapper">
    <h2 class="sticky-head">Datos</h2>

    <div class="form-group">
        <?php $class = $errors->has('fk_cruiseship_type') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('fk_cruiseship_type', ucfirst(__('fields.cruiseshipType'))) !!}
        {!! Form::select('fk_cruiseship_type', $cruiseshipType, $cruiseship->fk_cruiseship_type, array('placeholder' =>
        ucfirst(__('fields.cruiseshipType_select_placeholder')), 'class' => $class) ) !!}
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

    <div class="row loadMap">
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
            <iframe src="about:blank"></iframe>
        </div>
    </div>
</fieldset>