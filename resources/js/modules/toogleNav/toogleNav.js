export function toogleNav() {
  const content = document.querySelector('#content'),
    sidebar = document.querySelector('#sidebar');

  document.querySelector('#sidebarCollapse').addEventListener('click', () => {
    window.requestAnimationFrame(() => {
      sidebar.classList.toggle('active');
      content.classList.toggle('active');
    });
  });
}