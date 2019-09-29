export function toogleNav() {
    const sidebar = document.querySelector('#sidebar'),
      content = document.querySelector('#content');

    document.querySelector('#sidebarCollapse').addEventListener('click', () => {
        window.requestAnimationFrame(() => {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
        });
    });
}