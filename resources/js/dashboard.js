import { toogleNav } from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
import $ from 'jquery';

toogleNav();

import(/* webpackChunkName: "draft" */ './modules/draft/draft').then((Draft) => {
  console.log('asdg');
});

window.$ = $;