<form class="grid" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="">
  <input type="hidden" name="id" value="">

  <div class="col-12 form-control">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="text-box" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ ucfirst(__('front.name')) }}">

    @if ($errors->has('name'))
      <div class="invalid-feedback">
        <strong>{{ $message }}</strong>
      </div>
    @endif
  </div>

  <div class="col-12 form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
    <div>
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="text-box" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ ucfirst(__('front.email')) }}">

      @if ($errors->has('email'))
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @endif
    </div>    
  </div>
  
  <div class="col-12 form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">     

    <div>
      <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
      <input id="phone" type="text" class="text-box" name="phone" value="{{ old('phone') }}" required autofocus placeholder="{{ ucfirst(__('front.phone')) }}">

      @if ($errors->has('phone'))
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @endif
    </div>  
  </div>
  
  <div class="col-12 form-control {{ $errors->has('departure') ? 'is-invalid' : '' }}">    

    <div>
      <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
      <input id="departure" type="text" class="text-box" name="departure" value="{{ old('departure') }}" required autofocus placeholder="{{ ucfirst(__('front.departure')) }}">

      @if ($errors->has('departure'))
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @endif
    </div>      
  </div>
  
  <div class="col-12 grid">  

    <div class="col-6 form-control {{ $errors->has('adults') ? 'is-invalid' : '' }}">    

      <div>
        <label class="label" for="adults">{{ ucfirst(__('front.adults')) }}</label>
        <input id="adults" type="text" class="text-box" name="adults" value="{{ old('adults') }}" required autofocus placeholder="{{ ucfirst(__('front.adults')) }}">

        @if ($errors->has('adults'))
          <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </div>
        @endif
      </div>      
    </div>  

    <div class="col-6 form-control {{ $errors->has('childs') ? 'is-invalid' : '' }}">    

      <div>
        <label class="label" for="childs">{{ ucfirst(__('front.childs')) }}</label>
        <input id="childs" type="text" class="text-box" name="childs" value="{{ old('childs') }}" required autofocus placeholder="{{ ucfirst(__('front.childs')) }}">

        @if ($errors->has('childs'))
          <div class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </div>
        @endif
      </div>      
    </div>     

  </div>

  <div class="col-12 form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}">    

    <div>
      <label class="label" for="comment">{{ ucfirst(__('front.departure')) }}</label>
      <textarea name="comment"></textarea>

      @if ($errors->has('comment'))
        <div class="invalid-feedback">
          <strong>{{ $message }}</strong>
        </div>
      @endif
    </div>      
  </div>  

</form>