<form class="grid" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="">
  <input type="hidden" name="id" value="">

  <div class="col-12 {{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>

    <div>
      <input id="name" type="text" class="text-box" name="name" value="{{ old('name') }}" required autofocus placeholder="{{ ucfirst(__('front.name')) }}">

      @if ($errors->has('name'))
        <span class="help-block">
          Por favor escriba el nombre de su empresa.
        </span>
      @endif
    </div>
  </div>

  <div class="col-12 {{ $errors->has('email') ? ' has-error' : '' }}">
    <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>

    <div>
      <input id="email" type="email" class="text-box" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ ucfirst(__('front.email')) }}">

      @if ($errors->has('email'))
        <span class="help-block">
          Por favor escriba el nombre de su empresa.
        </span>
      @endif
    </div>    
  </div>
  
  <div class="col-12 {{ $errors->has('phone') ? ' has-error' : '' }}">     
    <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
    
    <div>    
      <input id="phone" type="text" class="text-box" name="phone" value="{{ old('phone') }}" required autofocus placeholder="{{ ucfirst(__('front.phone')) }}">

      @if ($errors->has('phone'))
        <span class="help-block">
          Por favor escriba el nombre de su empresa.
        </span>
      @endif
    </div>  
  </div>
  
  <div class="col-12 {{ $errors->has('departure') ? ' has-error' : '' }}">    
    <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
    
    <div>    
      <input id="departure" type="text" class="text-box" name="departure" value="{{ old('departure') }}" required autofocus placeholder="{{ ucfirst(__('front.departure')) }}">

      @if ($errors->has('departure'))
        <span class="help-block">
          Por favor escriba el nombre de su empresa.
        </span>
      @endif
    </div>      
  </div>
  
  <div class="col-12 grid">  

    <div class="col-6 {{ $errors->has('adults') ? ' has-error' : '' }}">    
      <label class="label" for="adults">{{ ucfirst(__('front.adults')) }}</label>
    
      <div>      
        <input id="adults" type="text" class="text-box" name="adults" value="{{ old('adults') }}" required autofocus placeholder="{{ ucfirst(__('front.adults')) }}">

        @if ($errors->has('adults'))
          <span class="help-block">
            Por favor escriba el nombre de su empresa.
          </span>
        @endif
      </div>      
    </div>  

    <div class="col-6 {{ $errors->has('childs') ? ' has-error' : '' }}">    
      <label class="label" for="childs">{{ ucfirst(__('front.childs')) }}</label>
    
      <div>        
        <input id="childs" type="text" class="text-box" name="childs" value="{{ old('childs') }}" required autofocus placeholder="{{ ucfirst(__('front.childs')) }}">

        @if ($errors->has('childs'))
          <span class="help-block">
            Por favor escriba el nombre de su empresa.
          </span>
        @endif
      </div>      
    </div>     

  </div>

  <div class="col-12 {{ $errors->has('comment') ? ' has-error' : '' }}">    
    <label class="label" for="comment">{{ ucfirst(__('front.departure')) }}</label>
    
    <div>    
      <textarea name="comment"></textarea>

      @if ($errors->has('comment'))
        <span class="help-block">
          Por favor escriba el nombre de su empresa.
        </span>
      @endif
    </div>      
  </div>  

</form>