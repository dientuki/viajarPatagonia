export function contactForm(element) {
  document.querySelector(element).addEventListener('submit', (e) => {
    const data = new URLSearchParams();

    e.preventDefault();

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
              e.target.reset();
              break;
            case 'error':
              // eslint-disable-next-line array-callback-return
              Object.keys(dataReturned.message).map((key) => {
                const elem = e.target.querySelector(`[name="${key}"]`);

                elem.parentNode.classList.add('is-invalid');
                elem.nextElementSibling.innerHTML = dataReturned.message[key];
              });
              break;
          }
        });

      }
    })
      .catch((error) => {
        // eslint-disable-next-line no-console
        console.log(error);
      });
  });
}