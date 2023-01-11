$('.news-slider').slick({
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 3,
  arrows: true,
  prevArrow:"<button type='button' class='slick-prev'><i class='fa-regular fa-chevron-left'></i></button>",
  nextArrow:"<button type='button' class='slick-next'><i class='fa-regular fa-chevron-right'></i></button>",
  responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
      }
    }
  ]
});