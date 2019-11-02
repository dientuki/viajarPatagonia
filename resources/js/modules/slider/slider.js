import Wallop from 'wallop';

export function initSlider(elements) {

  function lzl(element) {
    const next = element.querySelector('.Wallop-item--current').nextElementSibling;

    if (next !== null) {
      const img = next.querySelector('.wallop-lzl');

      if (img !== null) {
        window.requestAnimationFrame(() => {
          img.src = img.dataset.original;
          img.classList.remove('wallop-lzl');
        });
      }
    }
  }

  elements.forEach((element) => {
    const slider = new Wallop(element);

    lzl(element);

    setInterval(() => {
      slider.next();
      lzl(element);
    }, 3000);
  });
}