<fieldset class="sticky-wrapper">
    <h2 class="sticky-head">Precios</h2>

    <div class="row">
        @foreach ($currencies as $currency)

        <div class="col-sm">
            <div class="form-group">
                <?php $class = $errors->has('price_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
                {!! Form::label('price_' . $currency->id, ucfirst($currency->currency)) !!}
                {!! Form::number('price_' . $currency->id, null, array('min' => 0, 'placeholder' => ucfirst(__('fields.price')),
                'class'=>$class, 'max' => 16777214)) !!}
                @error('price_' . $currency->id)
                <div class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </div>
                @enderror
            </div>

            <div class="form-group">
                <?php $class = $errors->has('discount_' . $currency->id) != null ? 'form-control is-invalid' : 'form-control'; ?>
                {!! Form::label('discount_' . $currency->id, ucfirst(__('fields.discount'))) !!}
                {!! Form::number('discount_' . $currency->id, null, array('min' => 0, 'placeholder' => ucfirst(__('fields.discount')),
                'class'=>$class, 'max' => 16777214)) !!}
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