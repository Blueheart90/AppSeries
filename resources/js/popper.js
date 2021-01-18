import { createPopper } from '@popperjs/core';

const button = document.querySelector('#popperel');
const tooltip = document.querySelector('#tooltip');

// Pass the button, the tooltip, and some options, and Popper will do the
// magic positioning for you:
createPopper(button, tooltip, {
    placement: 'right',


});

function show() {
    tooltip.setAttribute('data-show', '');
  }

function hide() {
tooltip.removeAttribute('data-show');
}

  const showEvents = ['mouseenter', 'focus'];
  const hideEvents = ['mouseleave', 'blur'];

  showEvents.forEach(event => {
    button.addEventListener(event, show);
  });

  hideEvents.forEach(event => {
    button.addEventListener(event, hide);
  });


