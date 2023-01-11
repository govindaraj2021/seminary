var heroSwiper = new Swiper('.hero-slider', {
  loop: true,
  speed: 1000,
  slidesPerView: 1,
  paginationClickable: true,
  pagination: {
    clickable: true,
    el: ".swiper-pagination",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});