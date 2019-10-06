import { toogleNav } from './modules/toogleNav/toogleNav';
import { preventDelete } from './modules/preventDelete/preventDelete';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/modal';
import $ from 'jquery';

toogleNav();
preventDelete();

window.$ = $;