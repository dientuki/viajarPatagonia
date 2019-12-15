export function urlSelect(select) {
  const selectedElement = select.querySelector('[selected]');

  if (selectedElement === null) {
    return;
  }

  let selected = parseInt(selectedElement.value, 10);

  select.querySelectorAll('option').forEach((option) => {
    option.addEventListener('click', (e) => {

      if (e.target.value === selected) {
        e.target.selected = false;
        selected = 0;
      } else {
        selected = e.target.value;
      }
    });

  });
}