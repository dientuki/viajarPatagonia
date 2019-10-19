import Dropzone from 'dropzone';

export default class DropzoneMiddleware {
  constructor(query) {
    Dropzone.autoDiscover = false;
    this.element = document.querySelector(query);
    this.form = this.element.closest('form');
    this.config = {
      addRemoveLinks: true,
      url: this.element.dataset.url
    };
    this.setHeader();
    this.setEvents();

    return new Dropzone(query, this.config);
  }

  setHeader() {
    this.config.headers = { 'X-CSRF-TOKEN': this.element.dataset.token };
  }

  setEvents() {
    this.uploadedDocumentMap = {};

    this.config.success = (file, response) => {
      const input = document.createElement('INPUT');

      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'images[]');
      input.setAttribute('value', response.name);

      this.form.insertBefore(input, this.form.firstChild);

      this.uploadedDocumentMap[file.name] = response.name;
    };

    this.config.removedfile = (file) => {
      let name;

      if (typeof file.file_name === 'undefined') {
        name = this.uploadedDocumentMap[file.name];
      } else {
        name = file.file_name;
      }

      file.previewElement.remove();

      this.form.querySelector(`input[name="images[]"][value="${name}"]`).remove();
    };
  }

}