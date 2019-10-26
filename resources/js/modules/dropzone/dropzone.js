import Dropzone from 'dropzone';
import { storageAvailable } from '../helpers/validators';
import { create } from 'domain';

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
    DropzoneMiddleware.removeDB();

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

  static removeDB() {
    document.querySelectorAll('.db-image').forEach((element) => {
      element.querySelector('.delete').addEventListener('click', () => {
        const input = document.createElement('INPUT');

        input.setAttribute('name', 'delete[]');
        input.setAttribute('type', 'hidden');
        input.setAttribute('value', element.querySelector('input').value);

        window.requestAnimationFrame(() => {
          element.parentNode.append(input);
          element.remove();
        });
      });
    });
  }

}