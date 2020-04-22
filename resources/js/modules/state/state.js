export function state(buttons) {
  console.log(buttons);
  console.log(buttons[0].localName);
  console.log(buttons[1].localName);
  const data = [];
  buttons.forEach((button) => {
    console.log("ENTRO", button);
    button.addEventListener('click', (e) => {
    console.log("ES LA e",button.dataset.id);
    console.log("ES LA e",button.dataset.ref);
    console.log("ES LA e",button.dataset.state);
      
      data.push({
        id: button.id,
        ref: button.dataset.ref,
        state: button.dataset.state
      });
      
      fetch(e.target.dataset.href, {
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        method: 'POST'
      });
      
    });

    /*
    fetch(e.target.dataset.href, {
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      method: 'POST'
    });
    */
  });
}