<form class="grid-1 form" role="form" method="POST" action="{{ route('api.forms.inquiries') }}">
  {{ csrf_field() }}
  <input type="hidden" name="product" value="{{ $productType }}">
  <input type="hidden" name="product_id" value="{{ $product->id}}">
  <input type="hidden" name="fk_language" value="{{ session('locale')['id'] }}">

  <div class="col">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="{{ ucfirst(__('front.name')) }}">
    <div class="invalid-feedback"></div>
  </div>

  <div class="col">
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="form-control" name="email" required placeholder="{{ ucfirst(__('front.email')) }}">
      <div class="invalid-feedback"></div>
  </div>
  
  <div class="col">
      <label class="label" for="phone">{{ ucfirst(__('front.phone')) }}</label>
      <input id="phone" type="text" class="form-control" name="phone" required placeholder="{{ ucfirst(__('front.phone')) }}">
      <div class="invalid-feedback"></div>
  </div>
  
  <div class="col">

  </div>

  <div class="col grid">  

    <div class="col-6">    

      <label class="label" for="departure">{{ ucfirst(__('front.departure')) }}</label>
      <input id="departure" type="text" class="form-control" name="departure" required placeholder="31/12/2012" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}" />
      <div class="invalid-feedback"></div> 

    </div>  

    <div class="col-6">  

      <label class="label" for="nights">{{ ucfirst(__('front.nights')) }}</label>
      <input id="nights" type="number" min="1" max="99" class="form-control" name="nights" required placeholder="{{ ucfirst(__('front.nights')) }}" value="1" />
      <div class="invalid-feedback"></div>

    </div>     

  </div>  
  
  <div class="col grid">  

    <div class="col-6">    

        <label class="label" for="adult">{{ ucfirst(__('front.adult')) }}</label>
        <select required class="form-control" id="adult" name="adult" required>
          @for ($i = 0; $i <= 10; $i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
          <option value="11+">11+</option>
        </select>        
        <div class="invalid-feedback"></div>

    </div>  

    <div class="col-6">  

        <label class="label" for="childs">{{ ucfirst(__('front.child')) }}</label>
        <select required class="form-control" id="childs" name="childs" required>
          @for ($i = 0; $i <= 10; $i++)
            <option value="{{$i}}">{{$i}}</option>
          @endfor
          <option value="11+">11+</option>
        </select>
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