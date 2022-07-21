function ocultarPoppupAlert(){
  window.setTimeout(function(){
    $('.poppupAlert').fadeOut('slow');
  },3000);
}
$(document).ready(function() {

	/*$(document).bind("contextmenu",function(e){
    return false;
  });
  document.onkeydown = function (e) {
    if(e.keyCode == 123) {
      return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 73){
      return false;
    }
    if(e.ctrlKey && e.shiftKey && e.keyCode == 74) {
      return false;
    }
    if(e.ctrlKey && e.keyCode == 85) {
      return false;
    }
  }*/

  $(document)
  .ajaxStart(function(){
    $('.preloader').css('height', '100vh');
    $('.preloader').children().show();
  })
  .ajaxStop(function(){
    $('.preloader').css('height', '0');
    $('.preloader').children().hide();
  });

  window.dct_width_page = $(window).width();
  window.dct_height_page = $(window).height();
  window.dct_scroll_page = 0;

  $(window).scroll(function (event) {
    dct_scroll_page = $(window).scrollTop();
    //console.log("Página Scroll: "+dct_scroll_page);
  });

  $(window).resize(function() {
    dct_width_page = $(window).width();
    dct_height_page = $(window).height();
    //console.log("Página Ancho: "+dct_width_page);
    //console.log("Página Alto: "+dct_height_page);
  });

});