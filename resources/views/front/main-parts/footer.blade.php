<?php 
  use App\Http\Helpers\Helpers;
?>
<footer class="footer">
  <div class="wrapper">
    <div class="footer__top">
      <ul class="footer__column footer__links">
        <li class="footer__li"><a href="#" class="footer__link">La empresa</a></li>
        <li class="footer__li"><a href="#" class="footer__link">Condiciones generales</a></li>
        <li class="footer__li"><a href="#" class="footer__link">Politicas de privacidad</a></li>
        <li class="footer__li"><a href="#" class="footer__link">Contacto</a></li>
      </ul>
      <div class="footer__column">
        <span class="bold block">Gales al Sur E.V. y T.</span>
        Leg. #9293 | Av. Patagonia 186<br />Trevelin, Buenos Aires
      </div>
      <div class="footer__column">
        <span class="bold block">Salimbeni Viajes E.V. y T.</span>
        Leg. #15349 | Maipu 143<br />Las Heras, Buenos Aires
      </div>
      <div class="footer__afip text-hidden">
        <a href="#"  class="footer__link fullblock" target="_blank" rel="noopener">{{ __('front.afip') }}</a>
      </div>
    </div>
    <div class="footer__bottom">
      <ul class="footer__socials">
        <li class="footer__sociali"><a class="footer__social_link fullblock flex-center" target="_blank" rel="noopener" href="https://www.facebook.com/viajarporpatagonia">{!! Helpers::load_svg('ico-facebook') !!}</a></li>
        <li class="footer__sociali"><a class="footer__social_link fullblock flex-center" target="_blank" rel="noopener" href="https://www.facebook.com/viajarporpatagonia">{!! Helpers::load_svg('ico-instagram') !!}</a></li>
        <li class="footer__sociali"><a class="footer__social_link fullblock flex-center" target="_blank" rel="noopener" href="https://www.facebook.com/viajarporpatagonia">{!! Helpers::load_svg('ico-skype') !!}</a></li>
      </ul>
      <div class="footer__contactus">Gales al Sur E.V.yT. - Legajo #9298 - Sarmiento 784, Esquel, Chubut</div>
    </div>
  </div>
</footer>