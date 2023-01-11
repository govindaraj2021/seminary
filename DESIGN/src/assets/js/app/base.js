var rtl_status = document.querySelector('html').getAttribute('dir');
var freeMode = false;
if (rtl_status == 'rtl') {
  freeMode = true;
}

const link = document.querySelector('[data-image-window]');
const buttons = document.querySelectorAll('.image-zoom');
buttons.forEach((button) => {
  button.addEventListener('click', () => {
    // Do something
    link.click();
  })
});