export function filter(elements) {
  if (elements.length === 0) {
    return;
  }

  elements.forEach((element) => {
    element.addEventListener('change', (e) => {

      /* eslint-disable sort-vars */
      const url = new URL(window.location),
        param = e.target.dataset.param,
        params = url.searchParams,
        value = e.target.value;

      if (value === 'reset') {
        params.delete(param);
      } else {
        params.set(param, value);
      }

      window.location.href = url.href;
    });
  });

}

export function sort(element) {
  if (element === null) {
    return;
  }

  element.addEventListener('change', (e) => {

    const url = new URL(window.location);

    url.searchParams.set(e.target.dataset.param, e.target.value);

    window.location.href = url.href;
  });

}

export function reset(element) {
  if (element === null) {
    return;
  }

  element.addEventListener('click', () => {
    const params = window.location.href.split('?');

    if (params.length > 1) {
      window.location.href = params[0];
    }
  });
}