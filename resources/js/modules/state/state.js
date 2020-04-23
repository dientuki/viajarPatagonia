export function state(buttons) {
  console.log(buttons);
  console.log(buttons[0].localName);
  console.log(buttons[1].localName);
  buttons.forEach((button) => {
    button.addEventListener('click', (e) => {
      const data = [];
      let id = button.id.split("_");
      let state = ((button.dataset.state == 1) ? 0 : 1); 
      data.push({
        id: id[1],
        ref: button.dataset.ref,
        state: state
      });
      
      fetch(button.dataset.ref, {
        body: JSON.stringify(data),
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        method: 'POST'
      });
      
      //Change the state and content HTML 
      document.getElementById(button.id).setAttribute("data-state",state); 
      if(state==1){
        document.getElementById(button.id).innerHTML='<svg viewBox="0 0 512 512" class="ico-active"><path d="M0 255.999c141.303-141.383 370.458-141.453 511.85-.15l.15.15c-141.303 141.383-370.458 141.453-511.85.15-.053-.044-.097-.097-.15-.15z" fill="#87ced9"></path><circle cx="256" cy="255.999" r="105.931" fill="#4398d1"></circle><circle cx="256" cy="255.999" r="44.138" fill="#215280"></circle><g fill="#e0e0e0"><path d="M256 447.999a332.654 332.654 0 01-235.785-97.103l12.535-12.535c123.366 123.127 323.134 123.127 446.499 0l12.535 12.535A332.646 332.646 0 01256 447.999zM479.25 173.991c-123.366-123.127-323.134-123.127-446.499 0l-12.535-12.535c130.33-129.942 341.239-129.942 471.57 0l-12.536 12.535z"></path></g></svg>';
      } else {
        document.getElementById(button.id).innerHTML='<svg viewBox="0 0 512 512" class="ico-inactive"><g fill="#E0E0E0"><path d="M256 448c-88.4.2-173.2-34.7-235.8-97.1l12.5-12.5c123.4 123.1 323.1 123.1 446.5 0l12.5 12.5C429.2 413.3 344.4 448.2 256 448zM479.2 174C355.9 50.9 156.1 50.9 32.8 174l-12.5-12.5c130.3-129.9 341.2-129.9 471.6 0L479.2 174z"></path></g></svg>';
      }
    });

  });
}