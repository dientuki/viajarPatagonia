import { mergeObjects } from '../helpers/generic';

function clickOut(bodyClass) {
  window.requestAnimationFrame(() => {
    const html = document.body.parentElement;

    if (html.classList.contains('icopen')) {
      html.classList.replace('icopen', 'icoclose');
    } else if (html.classList.contains('icoclose')) {
      html.classList.replace('icoclose', 'icopen');
    } else {
      html.classList.add('icopen');
    }

    html.classList.toggle(bodyClass);
  });
}

export function menu(settings) {

  const defaults = mergeObjects({
      bodyClass: 'collapsable-expanded',
      trigger: '#ico-menu'
    }, settings),
    trigger = document.querySelector(defaults.trigger);

  trigger.addEventListener('click', () => {
    clickOut(defaults.bodyClass);
  });

  /*
  submenu({
    css: 'expanded',
    trigger: '.collapsable-menu-title',
    wrapper: '#collapsable-menu'
  });
  */

  document.querySelector('.collapsable').addEventListener('click', (event) => {
    if (event.target.classList.contains('collapsable')) {
      clickOut(defaults.bodyClass);
    }
  });
}