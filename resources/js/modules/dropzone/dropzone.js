import Dropzone from 'dropzone';
import { storageAvailable } from '../helpers/validators';

export default class DropzoneMiddleware {

  constructor(query) {
    Dropzone.autoDiscover = false;
    const previewNode = document.querySelector('.template'),
      previewTemplate = previewNode.parentNode.innerHTML;

    previewNode.parentNode.removeChild(previewNode);

    this.element = document.querySelector(query);
    this.form = this.element.closest('form');

    this.config = {
      clickable: '.fileinput-button',
      parallelUploads: 1,
      previewTemplate: previewTemplate,
      previewsContainer: '#previews',
      url: this.element.dataset.url
    };
    this.setHeader();
    this.setEvents();

    return new Dropzone(document.body, this.config);
  }

  setHeader() {
    this.config.headers = { 'X-CSRF-TOKEN': this.form.querySelector('input[name=_token]').value };
  }

  setEvents() {

    this.config.success = (file, response) => {
      file.previewTemplate.querySelector('input[name="images[]"]').setAttribute('value', response.name);
      window.requestAnimationFrame(() => {
        if (storageAvailable('localStorage') === true) {
          console.log(file.name, file.dataURL);
          localStorage.setItem(file.name, file.dataURL);
        }
  
      });
    };
  }

}