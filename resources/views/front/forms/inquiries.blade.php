<form class="grid-1 form" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="{{ $productType }}">
  <input type="hidden" name="product_id" value="{{ $product->id}}">
  <input type="hidden" name="fk_language" value="1">

  <div class="col">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="{{ ucfirst(__('front.name')) }}">

    <div class="invalid-feedback"></div>
  </div>

  <div class="col">
    <div>
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="form-control" name="email" required placeholder="{{ ucfirst(__('front.email')) }}">

      <div class="invalid-feedback"></div>
    </div>    
  </div>
  
  <div class="col">

    <div>
      <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
      <input id="phone" type="text" class="form-control" name="phone" required placeholder="{{ ucfirst(__('front.phone')) }}">

      <div class="invalid-feedback"></div>
    </div>  
  </div>
  
  <div class="col">

    <div>
      <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
      <input id="departure" type="text" class="form-control" name="departure" required placeholder="31/12/2012">

      <div class="invalid-feedback"></div>
    </div>      
  </div>
  
  <div class="col grid">  

    <div class="col-6">    

        <label class="label" for="adult">{{ ucfirst(__('front.adult')) }}</label>
        <input id="adult" type="number" min="0" max="10" class="form-control" name="adult" required placeholder="{{ ucfirst(__('front.adult')) }}">

        <div class="invalid-feedback"></div>

    </div>  

    <div class="col-6">    
        <label class="label" for="childs">{{ ucfirst(__('front.child')) }}</label>
        <input id="child" type="number" min="0" max="10" class="form-control" name="child" required placeholder="{{ ucfirst(__('front.child')) }}">

        <div class="invalid-feedback"></div>

    </div>     

  </div>

  <div class="col">
    <label class="label" for="comment">{{ ucfirst(__('front.comments')) }}</label>
    <textarea name="comment" class="form-control textarea"></textarea>

    <div class="invalid-feedback"></div>
  </div>

  <div class="col">
    <input type="submit" class="button button__cta" value="{{ ucfirst(__('front.cta')) }}" />
  </div>

</form>