import { isValidUrl } from '../helpers/validators';

export function loadmap(wrapper) {
  const input = wrapper.querySelector('input#map');

  if (input.value !== '' && isValidUrl(input.value)) {
    wrapper.querySelector('iframe.map').setAttribute('src', input.value);
  }

  input.addEventListener('blur', () => {
    if (isValidUrl(input.value)) {
      wrapper.querySelector('iframe.map').setAttribute('src', input.value);
    }
  });
}