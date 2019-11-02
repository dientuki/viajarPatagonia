import lzl from './modules/lazyload/native';
__webpack_public_path__ = `${window.location.protocol}//${window.location.host}/dist/`;

const settings_lzl = {
  data_src: 'original',
  elements_selector: '.lzl'
};

if (document.querySelectorAll('.Wallop').length > 0) {
  import(/* webpackChunkName: "slider" */ './modules/slider/slider').then((SliderMiddleware) => {
    SliderMiddleware.initSlider(document.querySelectorAll('.Wallop'));
  });
}

if ('IntersectionObserver' in window) {
  lzl.init(settings_lzl);
} else {
  import(/* webpackChunkName: "lzlVanilla" */ './modules/lazyload/vanilla').then((module) => {
    module.vanilla(settings_lzl);
  });
}