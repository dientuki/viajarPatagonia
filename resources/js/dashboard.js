import $ from 'jquery';
import { toogleNav } from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
__webpack_public_path__ = `${window.location.protocol}//${window.location.host}/dist/`;

toogleNav();

if (document.querySelectorAll('.draftjs').length > 0) {
  import(/* webpackChunkName: "draft" */ './modules/draft/draft.jsx');
}

if (document.querySelectorAll('.modalOpener').length > 0) {
  import(/* webpackChunkName: "preventDelete" */ './modules/preventDelete/preventDelete').then((module) => {
    module.preventDelete();
  });
}

window.$ = $;