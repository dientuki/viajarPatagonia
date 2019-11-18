function isBefore(el1, el2) {
  let cur;

  if (el2.parentNode === el1.parentNode) {
    for (cur = el1.previousSibling; cur; cur = cur.previousSibling) {
      if (cur === el2) {
        return true;
      }
    }
  }

  return false;
}

export function sortable(wrapper) {

  const elements = wrapper.querySelectorAll('.order');

  let selected;

  elements.forEach((element) => {
    element.addEventListener('dragstart', (e) => {
      const parent = e.target.classList.contains('order') ? e.target : e.target.closest('.order');

      e.dataTransfer.effectAllowed = 'move';
      e.dataTransfer.setData('text/plain', null);
      selected = parent;
    });

    element.addEventListener('dragover', (e) => {
      const parent = e.target.classList.contains('order') ? e.target : e.target.closest('.order');

      if (isBefore(selected, parent)) {
        parent.parentNode.insertBefore(selected, parent);
      } else {
        parent.parentNode.insertBefore(selected, parent.nextSibling);
      }
    });

    element.addEventListener('dragend', () => {
      selected = null;

      wrapper.querySelectorAll('.order').forEach((newOrder, index) => {
        newOrder.dataset.order = index + 1;
      });

    });

  });
}

export function update(button) {
  button.addEventListener('click', (e) => {
    const data = [];

    document.querySelectorAll('.order').forEach((element) => {
      data.push({
        id: element.dataset.id,
        order: element.dataset.order
      });
    });

    fetch(e.target.dataset.href, {
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      method: 'POST'
    });
  });
}