import { isValidUrl } from '../helpers/validators';

export default class LoadMap {

  constructor(wrapper) {
    this.wrapper = wrapper;
    this.input = this.wrapper.querySelector('input#map');
    this.iframe = this.wrapper.querySelector('iframe.map');
    this.showMap();
    this.input.addEventListener('blur', this.onBlur.bind(this), false);
  }

  showMap() {
    this.showed = false;
    if (this.input.value !== '' && isValidUrl(this.input.value)) {
      this.iframe.setAttribute('src', this.input.value);
      this.showed = true;
    }
  }

  onBlur() {
    this.showMap();
    if (this.showed === false) {
      const iframe = new DOMParser().parseFromString(this.input.value, 'text/html')
        .querySelector('iframe');

      if (iframe !== null && iframe.src !== '') {
        this.input.value = iframe.src;
        this.showMap();
      }
    }
  }

}