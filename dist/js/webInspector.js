function soloNumeros(e) {
  var key = window.event ? e.which : e.charCode;
  if (key == 8) {
    return true;
  }
  if (key !== undefined && key === 0) {
    return true;
  }
  var patron = /[0-9]/;
  var tecla_final = String.fromCharCode(key);
  return patron.test(tecla_final);
}
function validateOnlyNumber(evt) {
  var theEvent = evt || window.event;
  if (theEvent.type === 'paste') {
    key = event.clipboardData.getData('text/plain');
  } else {
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
function modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4) {
  $("#putIconModalgeneric").empty().prepend(dataModal_1);
  $("#putTitleModalgeneric").empty().prepend(dataModal_2);
  $("#putMessaggeModalgeneric").empty().prepend(dataModal_3);
  $("#putButtonModalgeneric").empty().prepend(dataModal_4);
  $('#modalGenericoInfo').modal('show');
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