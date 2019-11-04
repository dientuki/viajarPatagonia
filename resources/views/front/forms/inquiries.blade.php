<form class="grid-1 form" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="">
  <input type="hidden" name="id" value="">

  <div class="col">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ ucfirst(__('front.name')) }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        <strong>{{ $errors->first('name') }}</strong>
      </div>
    @endif
  </div>

  <div class="col {{ $errors->has('email') ? 'is-invalid' : '' }}">
    <div>
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ ucfirst(__('front.email')) }}">

      @if ($errors->has('email'))
        <div class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
        </div>
      @endif
    </div>    
  </div>
  
  <div class="col {{ $errors->has('phone') ? 'is-invalid' : '' }}">     

    <div>
      <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
      <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus placeholder="{{ ucfirst(__('front.phone')) }}">

      @if ($errors->has('phone'))
        <div class="invalid-feedback">
          <strong>{{ $errors->first('phone') }}</strong>
        </div>
      @endif
    </div>  
  </div>
  
  <div class="col {{ $errors->has('departure') ? 'is-invalid' : '' }}">    

    <div>
      <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
      <input id="departure" type="text" class="form-control" name="departure" value="{{ old('departure') }}" required autofocus placeholder="31/12/2012">

      @if ($errors->has('departure'))
        <div class="invalid-feedback">
          <strong>{{ $errors->first('departure') }}</strong>
        </div>
      @endif
    </div>      
  </div>
  
  <div class="col grid">  

    <div class="col-6 {{ $errors->has('adults') ? 'is-invalid' : '' }}">    

        <label class="label" for="adults">{{ ucfirst(__('front.adults')) }}</label>
        <input id="adults" type="number" min="0" max="10" class="form-control" name="adults" value="{{ old('adults') }}" required autofocus placeholder="{{ ucfirst(__('front.adults')) }}">

        @if ($errors->has('adults'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('adults') }}</strong>
          </div>
        @endif

    </div>  

    <div class="col-6 {{ $errors->has('childs') ? 'is-invalid' : '' }}">    
        <label class="label" for="childs">{{ ucfirst(__('front.childs')) }}</label>
        <input id="childs" type="number" min="0" max="10" class="form-control" name="childs" value="{{ old('childs') }}" required autofocus placeholder="{{ ucfirst(__('front.childs')) }}">

        @if ($errors->has('childs'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('childs') }}</strong>
          </div>
        @endif

    </div>     

  </div>

  <div class="col {{ $errors->has('comment') ? 'is-invalid' : '' }}">    
    <label class="label" for="comment">{{ ucfirst(__('front.comments')) }}</label>
    <textarea name="comment" class="form-control textarea"></textarea>

    @if ($errors->has('comment'))
      <div class="invalid-feedback">
        <strong>{{ $errors->first('comment') }}</strong>
      </div>
    @endif    
  </div>

  <div class="col">
    <input type="submit" class="button button__cta" value="{{ ucfirst(__('front.cta')) }}" />
  </div>

</form>