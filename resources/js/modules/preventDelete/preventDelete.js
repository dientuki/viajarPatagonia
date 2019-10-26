import 'bootstrap/js/dist/modal';

export function preventDelete() {
  const modalButton = document.querySelector('#deleteModal .btn-danger');

  if (modalButton === null) {
    return;
  }

  Array.from(document.querySelectorAll('.modalOpener')).forEach((form) => {
    form.addEventListener('submit', (event) => {
      modalButton.dataset.form = event.target.id;
      $('#deleteModal').modal('show');
      event.preventDefault();
    });
  });

  modalButton.addEventListener('click', (event) => {
    $('#deleteModal').modal('hide');
    document.querySelector(`#${event.target.dataset.form}`).submit();
  });
}