export function killBubling(e, tag) {
  let element = e;

  while (element.parentNode) {
    element = element.parentNode;
    if (element.tagName === tag) {
      return element;
    }
  }
  return null;
}