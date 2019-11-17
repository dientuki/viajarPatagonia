export function toogleNav() {
  const button = document.querySelector('#sidebarCollapse'),
    content = document.querySelector('#content'),
    sidebar = document.querySelector('#sidebar');

  if (button !== null) {
    button.addEventListener('click', () => {
      window.requestAnimationFrame(() => {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
      });
    });
  }
}

export function expandableItem(elements) {
  if (elements.lenght === 0) {
    return;
  }

  Array.from(elements).forEach((element) => {
    element.addEventListener('click', (event) => {
      if (event.target.closest('.active') === null) {
        event.target.closest('.main-nav__item').classList.toggle('expanded');
      }
    });
  });
}