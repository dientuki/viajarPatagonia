<fieldset class="sticky-wrapper">
  <h2 class="sticky-head">Datos</h2>

    <div class="form-row">
      <div class="form-group col">
        <?php $class = $errors->has('hotel') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('hotel', ucfirst(__('fields.hotel'))) !!}
        {!! Form::text('hotel', null, array('placeholder' => ucfirst(__('fields.hotel')), 'class'=>$class, 'required' => true, 'maxlength' => 190)) !!}
        @error('hotel')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>

      <div class="form-group col-1">
        <?php $class = $errors->has('stars') != null ? 'form-control is-invalid' : 'form-control'; ?>
        {!! Form::label('stars', ucfirst(__('fields.stars'))) !!}
        {!! Form::number('stars', null, array('placeholder' => ucfirst(__('fields.stars')), 'class'=>$class, 'required' => true, 'min' => 1, 'max' => 5)) !!}
        @error('stars')
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
        @enderror
      </div>
    </div>

    <div class="form-group">
      <?php $class = $errors->has('urlstring') != null ? 'form-control is-invalid' : 'form-control'; ?>
      {!! Form::label('urlstring', ucfirst(__('fields.url'))) !!}
      {!! Form::text('urlstring', null, array('placeholder' => ucfirst(__('fields.url')), 'class'=>$class, 'maxlength' => 190)) !!}
      @error('urlstring')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
      @enderror
      <small  class="form-text text-muted">
        Elegi un producto o pone una url cualquiera.
      </small>

      <select class="form-control" size="8" name="products" id="products">
        <option value="0">{{ucfirst(__('fields.productPlaceholder'))}}</option>
          @foreach ($products as $label => $value)
            <optgroup label="{{ucfirst(trans_choice('fields.' . $label, 2))}}">
            @foreach ($value as $id => $name)
              <option value="{{$label}}:{{$id}}">{{$name}}</option>
            @endforeach
            </optgroup>
            
          @endforeach

      </select>    
      @error('products')
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
      @enderror  


    </div>    

    <div class="form-check">
      {!! Form::checkbox('is_active', 1, false, array('class' => 'form-check-input') ) !!}
      {!! Form::label('is_active', ucfirst(__('fields.active'))) !!}
    </div>

  </div>

</fieldset>