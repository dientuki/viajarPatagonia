<form id="contact-form" class="grid-1 form" role="form" method="POST" action="{{ route('api.forms.contact') }}">
  {{ csrf_field() }}
  <input type="hidden" name="fk_language" value="{{ session('locale')['id'] }}">

  <div class="col">
    <label class="label" for="name">{{ ucfirst(__('front.name')) }}</label>
    <input id="name" type="text" class="form-control" name="name"  autofocus placeholder="{{ ucfirst(__('front.name')) }}">
    <div class="invalid-feedback"></div>
  </div>

  <div class="col">
      <label class="label" for="email">{{ ucfirst(__('front.email')) }}</label>
      <input id="email" type="email" class="form-control" name="email" required placeholder="{{ ucfirst(__('front.email')) }}">
      <div class="invalid-feedback"></div>
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