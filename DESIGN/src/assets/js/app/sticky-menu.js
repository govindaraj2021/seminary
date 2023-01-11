var menuSticky = $("body");
    headerFixed = "header-fixed";
    topHeader = $('header').height();

$(window).scroll(function() {
  if( $(this).scrollTop() > topHeader ) {
    menuSticky.addClass(headerFixed);
  } else {
    menuSticky.removeClass(headerFixed);
  }
});


if($(window).width() < 1200){
  $('.hamburger').click(function(){
    $('body').toggleClass('menu-open')
  })
  $('.overlay').click(function(){
    $('body').removeClass('menu-open')
    $('.hamburger').removeClass('is-active')
  })
}
if($(window).width() < 1200){
  $('.dropdown button').click(function(){
    $(this).parent().toggleClass('dropdown-active').siblings().removeClass('dropdown-active')
  })
}