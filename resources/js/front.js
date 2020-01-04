/* eslint-disable no-new */
import lzl from './modules/lazyload/native';
__webpack_public_path__ = `${window.location.protocol}//${window.location.host}/dist/`;

const settings_lzl = {
  data_src: 'src',
  elements_selector: '.lzl'
};

import(/* webpackChunkName: "header" */ './modules/header/header').then((module) => {
  module.menu();
});

if (document.querySelector('#product-slider') !== null) {
  import(/* webpackChunkName: "slider" */ './modules/slider/slider').then((SliderMiddleware) => {
    new SliderMiddleware.default({
      arrowKeys: false,
      autoHeight: true,
      autoplay: true,
      autoplayButtonOutput: false,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      container: '#product-slider',
      controls: false,
      items: 1,
      lazyload: true,
      loop: true,
      mode: 'carousel',
      nav: false,
      rewind: true,
      speed: 400
    });
  });
}

if (document.querySelector('#header-slider') !== null) {
  import(/* webpackChunkName: "slider" */ './modules/slider/slider').then((SliderMiddleware) => {
    new SliderMiddleware.default({
      arrowKeys: true,
      autoHeight: true,
      autoplay: true,
      autoplayButtonOutput: false,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      container: '#header-slider',
      controls: false,
      items: 1,
      lazyload: true,
      loop: true,
      mode: 'carousel',
      nav: false,
      rewind: true,
      speed: 400
    });
  });
}

if ('IntersectionObserver' in window) {
  lzl.init(settings_lzl);
} else {
  import(/* webpackChunkName: "lzlVanilla" */ './modules/lazyload/vanilla').then((module) => {
    module.vanilla(settings_lzl);
  });
}

if (document.querySelectorAll('.openOverlay').length > 0) {
  import(/* webpackChunkName: "modalForms" */ './modules/modalForms/modalForms').then((module) => {
    module.modalForms(document.querySelectorAll('.openOverlay'));
  });
}