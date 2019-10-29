export function multiselect(elements) {

  elements.forEach((element) => {
    const children = element.dataset.children === null ? null : document.querySelector(element.dataset.children),
      input = element.querySelector('input'),
      li = document.createElement('LI'),
      select = element.querySelector('select'),
      ul = element.querySelector('ul');

    li.classList.add('tag-list-item');

    select.addEventListener('click', (e) => {
      if (e.target.nodeName !== 'OPTION') {
        return;
      }

      if (e.target.value === '' || e.target.classList.contains('disabled')) {
        return;
      }

      const nli = li.cloneNode(),
        values = input.value === '' ? [] : input.value.split('|');

      e.target.classList.toggle('disabled');
      nli.innerHTML = e.target.innerHTML;
      nli.dataset.id = e.target.value;

      if (values.indexOf(e.target.value) === -1) {
        values.push(e.target.value);
      }

      window.requestAnimationFrame(() => {
        if (children !== null) {
          children.querySelectorAll(`option[data-${children.dataset.data}="${e.target.value}"]`).forEach((elechild) => {
            elechild.classList.remove('hidden');
          });
        }
        input.value = values.join('|');
        ul.appendChild(nli);
      });

    });

    ul.addEventListener('click', (e) => {
      if (e.target.nodeName !== 'LI') {
        return;
      }

      const values = input.value.split('|'),
        // eslint-disable-next-line sort-vars
        index = values.indexOf(e.target.dataset.id);

      if (index === -1) {
        return;
      }

      values.splice(index, 1);

      window.requestAnimationFrame(() => {
        if (children !== null) {
          children.querySelectorAll(`option[data-${children.dataset.data}="${e.target.dataset.id}"]`).forEach((elechild) => {
            elechild.classList.add('hidden');
            elechild.classList.remove('disabled');
          });
          children.querySelectorAll(`li[data-id="${e.target.dataset.id}"]`).forEach((ulchild) => {
            ulchild.remove();
          });
        }
        select.querySelector(`option[value="${e.target.dataset.id}"]`).classList.remove('disabled');
        input.value = values.join('|');
        e.target.remove();
      });
    });

    if (input.value !== '') {
      input.value.split('|').forEach((value) => {
        select.querySelector(`option[value="${value}"]`).click();
      });
    }

  });

}