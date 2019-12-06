<form class="grid-1 form" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="">
  <input type="hidden" name="id" value="">

  <div class="col">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="form-control" name="name" autofocus placeholder="{{ ucfirst(__('front.name')) }}">

    <div class="invalid-feedback">
      <strong></strong>
    </div>
  </div>

  <div class="col {{ $errors->has('email') ? 'is-invalid' : '' }}">
    <div>
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="form-control" name="email" required placeholder="{{ ucfirst(__('front.email')) }}">

      <div class="invalid-feedback">
        <strong></strong>
      </div>
    </div>    
  </div>
  
  <div class="col {{ $errors->has('phone') ? 'is-invalid' : '' }}">     

    <div>
      <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
      <input id="phone" type="text" class="form-control" name="phone" required placeholder="{{ ucfirst(__('front.phone')) }}">

      <div class="invalid-feedback">
        <strong></strong>
      </div>
    </div>  
  </div>
  
  <div class="col {{ $errors->has('departure') ? 'is-invalid' : '' }}">    

    <div>
      <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
      <input id="departure" type="text" class="form-control" name="departure" required placeholder="31/12/2012">

      <div class="invalid-feedback">
        <strong></strong>
      </div>
    </div>      
  </div>
  
  <div class="col grid">  

    <div class="col-6 {{ $errors->has('adults') ? 'is-invalid' : '' }}">    

        <label class="label" for="adults">{{ ucfirst(__('front.adults')) }}</label>
        <input id="adults" type="number" min="0" max="10" class="form-control" name="adults" required placeholder="{{ ucfirst(__('front.adults')) }}">

        <div class="invalid-feedback">
          <strong></strong>
        </div>

    </div>  

    <div class="col-6 {{ $errors->has('childs') ? 'is-invalid' : '' }}">    
        <label class="label" for="childs">{{ ucfirst(__('front.childs')) }}</label>
        <input id="childs" type="number" min="0" max="10" class="form-control" name="childs" required placeholder="{{ ucfirst(__('front.childs')) }}">

        <div class="invalid-feedback">
          <strong></strong>
        </div>

    </div>     

  </div>

  <div class="col {{ $errors->has('comment') ? 'is-invalid' : '' }}">    
    <label class="label" for="comment">{{ ucfirst(__('front.comments')) }}</label>
    <textarea name="comment" class="form-control textarea"></textarea>

    <div class="invalid-feedback">
      <strong></strong>
    </div>
  </div>

  <div class="col">
    <input type="submit" class="button button__cta" value="{{ ucfirst(__('front.cta')) }}" />
  </div>

</form>