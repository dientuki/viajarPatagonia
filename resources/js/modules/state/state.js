export function state(buttons) {
  buttons.forEach((button) => {
    button.addEventListener('click', () => {
      const data = [],
        state_value = button.dataset.state === '1' ? 0 : 1;

      data.push({
        id: button.dataset.id,
        ref: button.dataset.ref,
        state: state_value
      });

      fetch(button.dataset.ref, {
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        method: 'POST'
      });

      // Change the state_ and content HTML
      button.setAttribute('data-state', state_value);
    });

  });
}