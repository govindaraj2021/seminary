$(document).ready(function(){
  $('.theology-alumni .tab-controller li button').click(function(){
      $('.theology-alumni .tab-controller li button').removeClass('active');
      $(this).addClass('active');
      var tagid = $(this).data('tag');
      $('.theology-alumni  .list').removeClass('active').addClass('hide');
      $('#'+tagid).addClass('active').removeClass('hide');
  });
  $('.philosophy-alumni .tab-controller li button').click(function(){
    $('.philosophy-alumni .tab-controller li button').removeClass('active');
    $(this).addClass('active');
    var tagid = $(this).data('tag');
    $('.philosophy-alumni .list').removeClass('active').addClass('hide');
    $('#'+tagid).addClass('active').removeClass('hide');
});
});