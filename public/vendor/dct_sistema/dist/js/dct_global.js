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
function soloNumerosYdecimales(evt) {
    var theEvent = evt || window.event;
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    console.log(key);
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
function ocultarPoppupAlert(){
    window.setTimeout(function(){
        $('.poppupAlert').fadeOut('slow');
    },3000);
}
function toastrMostarError(numError){
  toastr.error("Código Error: "+ numError +" <br> Favor comunicarse con el administrador del sitio WEB.",'Informativo',{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
}
function toastrSuccess(texto){
  toastr.success(texto,'Informativo',{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
}
function toastrWarning(texto){
  toastr.warning(texto,'Informativo',{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
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
    $.ajax({
      url: $("#getRenderAplicacionOpcion").val(),
      type: 'GET',
      dataType: 'html',
      data:{ _token:$("#getTokenRender").val() },
      success: function(result){
          var result = eval('('+result+')');
          switch (result.message) {
              case "saveOK":
                /*** Aplicativos ***/
                result.dataRenderAplicativo.forEach(dataAplicativo => {
                  if (dataAplicativo.apl_estado == 1) {
                    $('#id_dct_apl_'+dataAplicativo.apl_id_aplicacion).removeClass('dct_main');
                    result.dataRenderOpcion.forEach(dataOpcion => {
                      if (dataAplicativo.apl_id_aplicacion == dataOpcion.opc_id_aplicacion) {
                        $('#id_dct_opc_'+dataOpcion.opc_id_opcion).removeClass('dct_main');
                      }
                    });
                  }
                  else {
                    result.dataRenderOpcion.forEach(dataOpcion => {
                      $('#id_dct_apl_'+dataAplicativo.apl_id_aplicacion).addClass('dct_main');
                      if (dataAplicativo.apl_id_aplicacion == dataOpcion.opc_id_aplicacion) {
                        $('#id_dct_opc_'+dataOpcion.opc_id_opcion).addClass('dct_main');
                      }
                    });
                  }
                });
                /*** Opciones ***/
                result.dataRenderOpcion.forEach(dataOpcion => {
                  if (dataOpcion.opc_estado == 1) {
                    $('#id_dct_opc_'+dataOpcion.opc_id_opcion).removeClass('dct_main');
                  }
                  else {
                    $('#id_dct_opc_'+dataOpcion.opc_id_opcion).addClass('dct_main');
                  }
                });
                /*** Rol Aplicación ***/
                result.dataRenderRolAplicativo.forEach(dataAplicativo => {
                  if (dataAplicativo.rla_estado == 1) {
                    $('#id_dct_apl_'+dataAplicativo.rla_id_aplicacion).removeClass('dct_main');
                    result.dataRenderOpcion.forEach(dataOpcion => {
                      if (dataAplicativo.rla_id_aplicacion == dataOpcion.opc_id_aplicacion) {
                        $('#id_dct_opc_'+dataOpcion.opc_id_opcion).removeClass('dct_main');
                      }
                    });
                  }
                  else {
                    result.dataRenderOpcion.forEach(dataOpcion => {
                      $('#id_dct_apl_'+dataAplicativo.rla_id_aplicacion).addClass('dct_main');
                      if (dataAplicativo.rla_id_aplicacion == dataOpcion.opc_id_aplicacion) {
                        $('#id_dct_opc_'+dataOpcion.opc_id_opcion).addClass('dct_main');
                      }
                    });
                  }
                });
                /*** Rol Opciones ***/
                result.dataRenderRolOpcion.forEach(dataOpcion => {
                  if (dataOpcion.rlo_estado == 1) {
                    $('#id_dct_opc_'+dataOpcion.rlo_id_opcion).removeClass('dct_main');
                  }
                  else {
                    $('#id_dct_opc_'+dataOpcion.rlo_id_opcion).addClass('dct_main');
                  }
                });
              break;
              default:
                toastrMostarError("RR_1");
              break;
          }
      }
    });
    /*$('#spiner_loading').hide();  */
    $(document)
    .ajaxStart(function(){$('#spiner_loading').show();})
    .ajaxStop(function(){$('#spiner_loading').hide();});
    
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