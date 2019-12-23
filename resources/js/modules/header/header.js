import { killBubling, mergeObjects } from '../helpers/generic';

function clickOut(bodyClass) {
  window.requestAnimationFrame(() => {
    const html = document.body.parentElement;

    if (html.classList.contains('icopen')) {
      html.classList.replace('icopen', 'icoclose');
      document.querySelectorAll('.hover').forEach((element) => {
        element.classList.remove('hover');
      });
    } else if (html.classList.contains('icoclose')) {
      html.classList.replace('icoclose', 'icopen');
    } else {
      html.classList.add('icopen');
    }

    html.classList.toggle(bodyClass);
  });
}

function submenu(settings) {

  const defaults = mergeObjects({
      css: 'expanded',
      trigger: '.collapsable-menu-title',
      wrapper: '#collapsable-menu'
    }, settings),
    triggers = document.querySelectorAll(defaults.trigger),
    wrapper = document.querySelector(defaults.wrapper);

  Array.from(triggers).forEach((trigger) => {
    trigger.addEventListener('click', (event) => {
      let li;

      if (event.target.classList.contains('selector--current')) {
        li = event.target.parentNode;
      } else {
        const title = killBubling(event.target, 'DIV');

        li = title.parentNode;
      }

      window.requestAnimationFrame(() => {
        if (li.classList.contains(defaults.css)) {
          li.classList.remove(defaults.css);
        } else {
          const expanded = wrapper.querySelector(`.${defaults.css}`);

          if (expanded !== null) {
            expanded.classList.remove(defaults.css);
          }
          li.classList.toggle(defaults.css);
        }
      });
    });
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

  submenu({
    css: 'hover',
    trigger: '.selector--current',
    wrapper: '.collapsable__content'
  });

  document.querySelector('.collapsable').addEventListener('click', (event) => {
    if (event.target.classList.contains('collapsable')) {
      clickOut(defaults.bodyClass);
    }
  });
}