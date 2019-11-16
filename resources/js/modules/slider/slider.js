import { tns } from 'tiny-slider/src/tiny-slider';

export default class slider {

  constructor(settings) {
    this.settings = settings;

    if (this.settings.wrapper === undefined) {
      this.wrapper = document.querySelector(this.settings.container).parentNode;
    } else {
      this.wrapper = this.settings.wrapper;
      delete this.settings.wrapper;
    }

    this.slider = tns(this.settings);

    this.autoplay();
  }

  autoplay() {
    if (this.settings.autoplay === true) {
      this.slider.play();
    }

    if (this.settings.autoHeight === true) {
      window.addEventListener('resize', () => {
        this.slider.updateSliderHeight();
      });
      window.dispatchEvent(new Event('resize'));
    }
  }

}