export function toogleNav() {
  const button = document.querySelector('#sidebarCollapse'),
    content = document.querySelector('#content'),
    sidebar = document.querySelector('#sidebar');

  if (button !== null)   {
    button.addEventListener('click', () => {
      window.requestAnimationFrame(() => {
        sidebar.classList.toggle('active');
        content.classList.toggle('active');
      });
    });
  }
}