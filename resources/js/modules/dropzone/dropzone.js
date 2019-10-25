import Dropzone from 'dropzone';
import { storageAvailable } from '../helpers/validators';

export default class DropzoneMiddleware {

  constructor(query) {
    const previewTemplate = document.querySelector('.template-dropzone').content.cloneNode(true);

    Dropzone.autoDiscover = false;
    DropzoneMiddleware.loadOlds();

    this.element = document.querySelector(query);

    this.config = {
      clickable: '.fileinput-button',
      parallelUploads: 1,
      previewTemplate: previewTemplate.querySelector('.template').outerHTML,
      previewsContainer: '#previews',
      url: this.element.dataset.url
    };
    this.setHeader();
    this.setEvents();

    return new Dropzone(document.body, this.config);
  }

  setHeader() {
    const form = this.element.closest('form');

    this.config.headers = { 'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value };
  }

  setEvents() {

    this.config.success = (file, response) => {
      file.previewTemplate.querySelector('input[name="images[]"]').setAttribute('value', response.name);
      window.requestAnimationFrame(() => {
        if (storageAvailable('localStorage') === true) {
          localStorage.setItem(response.name, file.dataURL);
        }
      });
    };
  }

  static loadOlds() {
    if (storageAvailable('localStorage') === false) {
      return;
    }

    window.requestAnimationFrame(() => {
      document.querySelectorAll('.old-image').forEach((element) => {
        const image = localStorage.getItem(element.querySelector('input').value);

        element.querySelector('.thumbnail').setAttribute('src', image);
        element.querySelector('.delete').addEventListener('click', () => {
          element.remove();
        });
      });
    });
  }

}