import {toogleNav} from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/modal';
import 'jquery';
//import 'popper.js';

toogleNav();

/*
$('.modalDelete').on('shown.bs.modal', function () {
    //$('#myInput').trigger('focus')
  })
  */

 $('.modalDelete').modal()