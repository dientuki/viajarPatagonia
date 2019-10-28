import $ from 'jquery';
import { toogleNav } from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
__webpack_public_path__ = `${window.location.protocol}//${window.location.host}/dist/`;

toogleNav();

// Load draft js
if (document.querySelectorAll('.draftjs').length > 0) {
  import(/* webpackChunkName: "draft" */ './modules/draft/draft.jsx');
}

// Load the image uploader
if (document.querySelector('#dropzone') !== null) {
  import(/* webpackChunkName: "dropzone" */ './modules/dropzone/dropzone').then((DropzoneMiddleware) => {
    window.dropzone = new DropzoneMiddleware.default('#dropzone');
  });
}

// Load the preventDelete modal
if (document.querySelectorAll('.modalOpener').length > 0) {
  import(/* webpackChunkName: "preventDelete" */ './modules/preventDelete/preventDelete').then((module) => {
    module.preventDelete();
  });
}

// Load the map loader
if (document.querySelector('.loadMap') !== null) {
  import(/* webpackChunkName: "loadmap" */ './modules/loadmap/loadmap').then((module) => {
    module.loadmap(document.querySelector('.loadMap'));
  });
}

// Load multiselect
if (document.querySelector('.multiselect') !== null) {
  import(/* webpackChunkName: "multiselect" */ './modules/multiselect/multiselect').then((module) => {
    module.multiselect(document.querySelectorAll('.multiselect'));
  });
}




window.$ = $;