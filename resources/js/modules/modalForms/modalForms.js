export function modalForms(elements) {

  const overlay = document.querySelector('.overlay'),
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

  document.querySelector('.form').addEventListener('submit', (e) => {
    const data = new URLSearchParams();

    e.preventDefault();
    loading.classList.toggle('show');

    for (const pair of new FormData(e.target)) {
      data.append(pair[0], pair[1]);
    }

    fetch(e.target.action, {
      body: data,
      headers: { 'X-CSRF-TOKEN': e.target.querySelector('input[name=_token]').value },
      method: 'post'
    }).then((response) => {
      const type = response.headers.get('Content-Type').split(';');

      if (type[0] === 'text/html') {
        response.text().then((resHTML) => {
          e.target.innerHTML = resHTML;
        });
      }

      if (type[0] === 'application/json') {
        loading.classList.toggle('show');
        overlay.classList.toggle('show');
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