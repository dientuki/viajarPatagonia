export function modalForms(elements) {

  const form = document.querySelector('.form'),
    overlay = document.querySelector('.overlay'),
    // eslint-disable-next-line sort-vars
    loading = overlay.querySelector('.overlay__loading');

  overlay.addEventListener('click', (e) => {
    if (e.target.classList.contains('overlay__close')) {
      overlay.classList.toggle('show');
      return;
    }

    if (e.target.closest('.overlay__wrapper') === null) {
      overlay.classList.toggle('show');
    }
  });

  elements.forEach((element) => {
    element.addEventListener('click', () => {
      overlay.classList.toggle('show');
    });
  });

  form.addEventListener('submit', (e) => {
    const data = new URLSearchParams();

    e.preventDefault();
    loading.classList.toggle('show');

    window.requestAnimationFrame(() => {
      form.querySelectorAll('.is-invalid').forEach((withErrors) => {
        withErrors.classList.remove('is-invalid');
        withErrors.querySelector('.invalid-feedback').innerHTML = '';
      });
    });

    for (const pair of new FormData(e.target)) {
      data.append(pair[0], pair[1]);
    }

    fetch(e.target.action, {
      body: data,
      headers: {
        'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-CSRF-TOKEN': e.target.querySelector('input[name=_token]').value
      },
      method: 'post'
    }).then((response) => {
      const type = response.headers.get('Content-Type').split(';');

      if (type[0] === 'application/json') {
        response.json().then((dataReturned) => {
          window.data = dataReturned;

          // eslint-disable-next-line default-case
          switch (dataReturned.status) {
            case 'success':
              loading.classList.toggle('show');
              overlay.classList.toggle('show');
              form.reset();
              break;
            case 'error':
              // eslint-disable-next-line array-callback-return
              Object.keys(dataReturned.message).map((key) => {
                const elem = form.querySelector(`[name="${key}"]`);

                elem.parentNode.classList.add('is-invalid');
                elem.nextElementSibling.innerHTML = dataReturned.message[key];
              });

              loading.classList.toggle('show');
              break;
          }
        });

      }
    })
      .catch((error) => {
        // eslint-disable-next-line no-console
        console.log(error);
        loading.classList.toggle('show');
        overlay.classList.toggle('show');
      });
  });
}