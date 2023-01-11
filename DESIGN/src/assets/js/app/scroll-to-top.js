const backToTop = document.querySelector('.back-to-top');

backToTop.addEventListener('click', e => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: 'smooth' });
})