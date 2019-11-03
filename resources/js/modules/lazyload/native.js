export default class native {

  static init(settings) {
    document.addEventListener('DOMContentLoaded', () => {
      const lazyImageObserver = new IntersectionObserver((entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const lazyImage = entry.target;

              lazyImage.src = lazyImage.dataset[settings.data_src];
              lazyImage.classList.remove(settings.elements_selector.replace(/^(.|#)/, ''));
              lazyImageObserver.unobserve(lazyImage);
            }
          });
        }),
        lazyImages = [].slice.call(document.querySelectorAll(settings.elements_selector));

      lazyImages.forEach((lazyImage) => {
        lazyImageObserver.observe(lazyImage);
      });

    });
  }

}