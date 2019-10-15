import $ from 'jquery';
import { preventDelete } from './modules/preventDelete/preventDelete';
import { toogleNav } from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/modal';

toogleNav();
preventDelete();

window.$ = $;