export function urlSelect(select) {

  let selected = parseInt(select.querySelector('[selected="selected"]').value, 10);

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