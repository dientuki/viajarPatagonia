import {toogleNav} from './modules/toogleNav/toogleNav';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/modal';
import $ from 'jquery';
//import 'popper.js';


toogleNav();

/*
$('.modalDelete').on('shown.bs.modal', function () {
    //$('#myInput').trigger('focus')
  })
  */

 //$('#button-1').modal()

 window.$ = $;

 function test(event) {
    if (event.target.dataset.send === undefined) {
        console.log('preveni', event.target.dataset)
        document.querySelector('#deleteModal .btn-danger').dataset.id = event.target.dataset.id
        $('#deleteModal').modal('show');
        event.preventDefault();    
    } else {
        console.log('asdfasdf');
    }
 }

 Array.from(document.querySelectorAll('.modalOpener')).forEach((form) => {
    form.addEventListener('submit', test);
 });

 /*
 Array.from(document.querySelectorAll('.modalOpener')).forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (event.target.dataset.send === undefined) {
            document.querySelector('#deleteModal .btn-danger').dataset.id = event.target.dataset.id
            $('#deleteModal').modal('show');
            event.preventDefault();
        }
    });
  });
*/

document.querySelector('#deleteModal .btn-danger').addEventListener('click', (event) => {
  document.querySelector(`form.id-${event.target.dataset.id}`).dataset.send = true;
  document.querySelector(`form.id-${event.target.dataset.id}`).removeEventListener('submit', test);
  $('#deleteModal').modal('hide');
});

$("#deleteModal").on("hidden.bs.modal", function () {
    const form = document.querySelector('form[data-send="true"]');

    console.log(form)

    if (form !== null) {
        window.requestAnimationFrame(() => {
            console.log(form)
            form.dispatchEvent(new Event('submit'));
        });
    }
});