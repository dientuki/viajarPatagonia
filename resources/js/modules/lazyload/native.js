export default class native {

  static init(settings) {
    document.addEventListener('DOMContentLoaded', () => {
      const lazyImages = [].slice.call(document.querySelectorAll(settings.elements_selector));

      console.log(lazyImages);

      let lazyImageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            const lazyImage = entry.target;

            console.log(settings)

            lazyImage.src = lazyImage.dataset[settings.data_src];
            lazyImage.classList.remove(settings.elements_selector.replace(/^(.|#)/, ''));
            lazyImageObserver.unobserve(lazyImage);
          }
        });
      });

      lazyImages.forEach((lazyImage) => {
        lazyImageObserver.observe(lazyImage);
      });

    });
  }

}