var validation = {
isEmailAddress:function(str) {
   var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   return pattern.test(str);
},
isNotEmpty:function (str) {
   var pattern =/\S+/;
   return pattern.test(str);
},
isNumber:function(str) {
   var pattern = /^\d+$/;
   return pattern.test(str);
},
isSame:function(str1,str2){
  return str1 === str2;
}}; 
function quitaEspacios (myText){
  var myString = myText;
  myString = $.trim( myString );
  return myString;
}
function toUpperCase(texto) {
  texto.value = texto.value.toUpperCase();
}
function validarCedula(cedula_a_Validar) {
  var cad = cedula_a_Validar.trim();
  var total = 0;
  var longitud = cad.length;
  var longcheck = longitud - 1;
  if (cad !== "" && longitud === 10){
    for(i = 0; i < longcheck; i++){
      if (i%2 === 0) {
        var aux = cad.charAt(i) * 2;
        if (aux > 9) aux -= 9;
        total += aux;
      } else {
        total += parseInt(cad.charAt(i));
      }
    }
    total = total % 10 ? 10 - total % 10 : 0;
    if (cad.charAt(longitud-1) == total) {
      return true;
    }else{
      return false;
    }
  }
}
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
function modalGenerico(dataModal_1,dataModal_2,dataModal_3,dataModal_4) {
  $("#putIconModalgeneric").empty().prepend(dataModal_1);
  $("#putTitleModalgeneric").empty().prepend(dataModal_2);
  $("#putMessaggeModalgeneric").empty().prepend(dataModal_3);
  $("#putButtonModalgeneric").empty().prepend(dataModal_4);
  $('#modalGenericoInfo').modal('show');
}
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

  $('#loading').hide();  
  $(document)
  .ajaxStart(function(){$('#loading').show();})
  .ajaxStop(function(){$('#loading').hide();});

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