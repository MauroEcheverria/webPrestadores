function obtenerComprobanteFirmadoSRI(clave_acceso_sri,ruta_certificado,mi_pwd_p12,ruta_xml) {
  var response = [];
  $.ajax({
      url: "../../../plugins/facturacionElectronica/leerXML.php",
      type: 'POST',
      data: {
        'ruta_xml': ruta_xml
      },
      context: document.body
  }).done(function (respuesta) {
    window.contenido_comprobante = respuesta;
    var oReq = new XMLHttpRequest();
    oReq.open("GET", ruta_certificado, true);
    oReq.responseType = "arraybuffer";
    oReq.onload = function (oEvent) {
      var blob = new Blob([oReq.response], {type: "application/x-pkcs12"});
      window.contenido_p12 = [oReq.response];
      if (validar_contrasena_certificado(window.contenido_p12[0],mi_pwd_p12)) {
        $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Contraseña de certificado electrónico válida</div>" );
        if (validar_fechas_certificado(window.contenido_p12[0],mi_pwd_p12)) {
          $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Fecha de certificado electrónico vigente</div>" );
          var comprobanteFirmado_xml = firmarComprobante(window.contenido_p12[0],mi_pwd_p12,window.contenido_comprobante);
          $.ajax({
            url: "../../../plugins/facturacionElectronica/firmarXML.php",
            type: 'POST',
            data: {
              'mensaje': comprobanteFirmado_xml,
              'clave_acceso': clave_acceso_sri
            },
            context: document.body
          }).done(function (respuesta) {
            $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se firma electrónicamente archivo XML.</div>" );
            xmlDoc = $.parseXML(window.contenido_comprobante),$xml = $(xmlDoc),$claveAcceso = $xml.find("claveAcceso");
            $.ajax({
              type: 'POST',
              url: "../../../plugins/facturacionElectronica/validarComprobante.php",
              data: {
                'claveAcceso': clave_acceso_sri
              },
              context: document.body
            }).done(function (respuestaValidarComprobante) {
              respuestaValidarComprobante = JSON.parse(respuestaValidarComprobante);
              if (respuestaValidarComprobante.sri_estado == "RECIBIDA") {
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se valida de manera correcta comprobante electrónico.</div>" );
                service = 'Autorizacion Comprobante';
                xmlDoc = $.parseXML(window.contenido_comprobante),$xml = $(xmlDoc),$claveAcceso = $xml.find("claveAcceso");
                $.ajax({
                  type: 'POST',
                  url: "../../../plugins/facturacionElectronica/autorizacionComprobante.php",
                  data: {
                    'claveAcceso': clave_acceso_sri
                  },
                  context: document.body
                }).done(function (respuestaAutorizacionComprobante) {
                  respuestaAutorizacionComprobante = JSON.parse(respuestaAutorizacionComprobante);

                  if (respuestaAutorizacionComprobante.sri_estado == "AUTORIZADO") {
                    $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_visto_2.png' class='iconDataTrans'>Se aprueba de manera correcta comprobante electrónico</div>" );
                    toastr.success('Su comprobante ha sido generado correctamente.','Éxito...!!!',{timeOut:5000,progressBar:true,positionClass:"toast-top-right",preventDuplicates:true});
                    $('#myModalRegistroTransacciones').modal('hide');
                  }
                  else {
                    $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Mensaje SRI: "+respuestaAutorizacionComprobante.sri_mensaje+". Cod Error SRI ("+respuestaAutorizacionComprobante.sri_identificador+")<i class='fas fa-eye' id='idVerErrorSRI'></i></div>" );
                    $("#dataInfoErroresDetalle").prepend(respuestaAutorizacionComprobante.sri_informacionAdicional);
                    $('#idVerErrorSRI').click( function (e) {
                      e.preventDefault();
                      $('#myModalRegistroTransacciones').modal('hide');
                      $('#myModalInfoErroresDetalle').modal('show');
                    });
                  }
                  
                  renderizarProductoServicio();
                  $('#transPanel_1,#transPanel_2,#transPanel_3').fadeOut();
                  $("#pos_total_comprobante_1").empty().prepend("0.00");
                  $("#cli_identificacion,#ftr_id_forma_pago").val("").prop("disabled",true);
                  $("#prs_id_prod_serv").val("").trigger("change").prop("disabled",true);
                  $('#btnPosNuevaFactura').prop("disabled",false);
                  $('#btn_cli_identificacion').prop("disabled",true);

                });
              } else {
                $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Mensaje SRI: "+respuestaValidarComprobante.sri_mensaje+". Cod Error SRI ("+respuestaValidarComprobante.sri_identificador+")</div>" );
              }
            });
          });
        }
        else {
          $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Fecha de certificado electrónico extemporáneo</div>" );
        }
      }
      else {
        $("#dataPOSTransacciones").prepend("<div class='txtDataTrans'><img src='../../../dist/img/dt_error.png' class='iconDataTrans'>Contraseña de certificado electrónico inválida</div>" );
      }    
    }
    oReq.send();
  });
}
function validar_fechas_certificado(ruta_certificado,mi_pwd_p12) {
  var arrayUint8 = new Uint8Array(ruta_certificado);
  var p12B64 = forge.util.binary.base64.encode(arrayUint8);
  var p12Der = forge.util.decode64(p12B64);
  var p12Asn1 = forge.asn1.fromDer(p12Der);
  var p12 = forge.pkcs12.pkcs12FromAsn1(p12Asn1, mi_pwd_p12);
  var certBags = p12.getBags({bagType: forge.pki.oids.certBag})
  var signaturesQuantity = certBags[forge.oids.certBag];
  var count = 0;
  var positionSignature = 0;
  var entidad = signaturesQuantity[0].attributes.friendlyName[0];
  if (/BANCO CENTRAL/i.test(entidad)) {
    entidad = 'BANCO_CENTRAL';
    var certBags = p12.getBags({bagType: forge.pki.oids.certBag})
    var cert = certBags[forge.oids.certBag][1].cert;
    var issuerName = 'CN=AC BANCO CENTRAL DEL ECUADOR,L=QUITO,OU=ENTIDAD DE CERTIFICACION DE INFORMACION-ECIBCE,O=BANCO CENTRAL DEL ECUADOR,C=EC';
  } else if (/SECURITY DATA/i.test(entidad)) {
    entidad = 'SECURITY_DATA';
    var contador = 0;
    var max = 0;
    var attributes_array=[];        
    certBags[forge.oids.certBag].forEach(function (entry) {
      var bag = entry.cert;
      var attributes = bag.extensions;
      attributes_array[contador] = attributes;
      attributes_array.sort().reverse();
      max = attributes_array[0].length;
      contador++;
    });
    certBags[forge.oids.certBag].forEach(function (entry) {
        var bag = entry.cert;
        var attributes = bag.extensions;
        if (attributes.length >= max) {
          cert = bag;
        }
    });
    var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUB SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A.,C=EC';
  } else {
    var cert = certBags[forge.oids.certBag][0].cert;
    var tipoSecurityData = certBags[forge.oids.certBag][0].cert.extensions[3].value;
    if(/SUBCA-2/i.test(tipoSecurityData)) {
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-2 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 2,C=EC';
    }else if(/SUBCA-3/i.test(tipoSecurityData)){
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-3 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 3,C=EC';
    }else{
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-1 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 1,C=EC';
    }
    entidad = 'SECURITY_DATA'; 
  }
  var fechaFin = cert.validity['notAfter'];
  var fechaHoy = new Date();
  if (fechaHoy <= fechaFin) {
    return true;
  }
  else {
    return false;
  }
}
function validar_contrasena_certificado(ruta_certificado,mi_pwd_p12) {
  var arrayUint8 = new Uint8Array(ruta_certificado);
  var p12B64 = forge.util.binary.base64.encode(arrayUint8);
  var p12Der = forge.util.decode64(p12B64);
  var p12Asn1 = forge.asn1.fromDer(p12Der);
  try {
    forge.pkcs12.pkcs12FromAsn1(p12Asn1, mi_pwd_p12);
    return true;
  } catch (error) {
    return false;
  }
}
var contenido_p12 = null;
function firmarComprobante(mi_contenido_p12, mi_pwd_p12, comprobante) {
  var arrayUint8 = new Uint8Array(mi_contenido_p12);
  var p12B64 = forge.util.binary.base64.encode(arrayUint8);
  var p12Der = forge.util.decode64(p12B64);
  var p12Asn1 = forge.asn1.fromDer(p12Der);
  var p12 = forge.pkcs12.pkcs12FromAsn1(p12Asn1, mi_pwd_p12);
  var certBags = p12.getBags({bagType: forge.pki.oids.certBag})
  var signaturesQuantity = certBags[forge.oids.certBag];
  var count = 0;
  var positionSignature = 0;
  var entidad = signaturesQuantity[0].attributes.friendlyName[0];
  if (/BANCO CENTRAL/i.test(entidad)) {
    entidad = 'BANCO_CENTRAL';
    var certBags = p12.getBags({bagType: forge.pki.oids.certBag})
    var cert = certBags[forge.oids.certBag][1].cert;
    var issuerName = 'CN=AC BANCO CENTRAL DEL ECUADOR,L=QUITO,OU=ENTIDAD DE CERTIFICACION DE INFORMACION-ECIBCE,O=BANCO CENTRAL DEL ECUADOR,C=EC';
  } else if (/SECURITY DATA/i.test(entidad)) {
    entidad = 'SECURITY_DATA';
    var contador = 0;
    var max = 0;
    var attributes_array=[];        
    certBags[forge.oids.certBag].forEach(function (entry) {
      var bag = entry.cert;
      var attributes = bag.extensions;
      attributes_array[contador] = attributes;
      attributes_array.sort().reverse();
      max = attributes_array[0].length;
      contador++;
    });
    certBags[forge.oids.certBag].forEach(function (entry) {
        var bag = entry.cert;
        var attributes = bag.extensions;
        if (attributes.length >= max) {
          cert = bag;
        }
    });
    var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUB SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A.,C=EC';
  }
  else {
    var cert = certBags[forge.oids.certBag][0].cert;
    var tipoSecurityData = certBags[forge.oids.certBag][0].cert.extensions[3].value;
    if(/SUBCA-2/i.test(tipoSecurityData)) {
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-2 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 2,C=EC';
    }else if(/SUBCA-3/i.test(tipoSecurityData)){
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-3 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 3,C=EC';
    }else{
      var issuerName = 'CN=AUTORIDAD DE CERTIFICACION SUBCA-1 SECURITY DATA,OU=ENTIDAD DE CERTIFICACION DE INFORMACION,O=SECURITY DATA S.A. 1,C=EC';
    }
    entidad = 'SECURITY_DATA'; 
  }
  var pkcs8bags = p12.getBags({bagType: forge.pki.oids.pkcs8ShroudedKeyBag});
  if (entidad == 'BANCO_CENTRAL') {
    var pkcs8 = pkcs8bags[forge.oids.pkcs8ShroudedKeyBag][1];
  } else {
    var pkcs8 = pkcs8bags[forge.oids.pkcs8ShroudedKeyBag][0];
  }
  var key = pkcs8.key;
  if (key == null) {
    key = pkcs8.asn1;
  }
  certificateX509_pem = forge.pki.certificateToPem(cert);
  certificateX509 = certificateX509_pem;
  certificateX509 = certificateX509.substr(certificateX509.indexOf('\n'));
  certificateX509 = certificateX509.substr(0, certificateX509.indexOf('\n-----END CERTIFICATE-----'));
  certificateX509 = certificateX509.replace(/\r?\n|\r/g, '').replace(/([^\0]{76})/g, '$1\n');
  certificateX509_asn1 = forge.pki.certificateToAsn1(cert);
  certificateX509_der = forge.asn1.toDer(certificateX509_asn1).getBytes();
  certificateX509_der_hash = sha1_base64(certificateX509_der);
  var X509SerialNumber = parseInt(cert.serialNumber, 16);
  exponent = hexToBase64(key.e.data[0].toString(16));
  modulus = bigint2base64(key.n);
  comprobante = comprobante.replace(/\t|\r/g, "")
  var sha1_comprobante = sha1_base64(comprobante.replace('<?xml version="1.0" encoding="UTF-8"?>', ''));
  var xmlns = 'xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:etsi="http://uri.etsi.org/01903/v1.3.2#"';
  var Certificate_number = p_obtener_aleatorio();
  var Signature_number = p_obtener_aleatorio();
  var SignedProperties_number = p_obtener_aleatorio();
  var SignedInfo_number = p_obtener_aleatorio();
  var SignedPropertiesID_number = p_obtener_aleatorio();
  var Reference_ID_number = p_obtener_aleatorio();
  var SignatureValue_number = p_obtener_aleatorio();
  var Object_number = p_obtener_aleatorio();
  var SignedProperties = '';
  SignedProperties += '<etsi:SignedProperties Id="Signature' + Signature_number + '-SignedProperties' + SignedProperties_number + '">';  //SignedProperties
  SignedProperties += '<etsi:SignedSignatureProperties>';
  SignedProperties += '<etsi:SigningTime>';
  SignedProperties += moment().format('YYYY-MM-DD\THH:mm:ssZ');
  SignedProperties += '</etsi:SigningTime>';
  SignedProperties += '<etsi:SigningCertificate>';
  SignedProperties += '<etsi:Cert>';
  SignedProperties += '<etsi:CertDigest>';
  SignedProperties += '<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">';
  SignedProperties += '</ds:DigestMethod>';
  SignedProperties += '<ds:DigestValue>';
  SignedProperties += certificateX509_der_hash;
  SignedProperties += '</ds:DigestValue>';
  SignedProperties += '</etsi:CertDigest>';
  SignedProperties += '<etsi:IssuerSerial>';
  SignedProperties += '<ds:X509IssuerName>';
  SignedProperties += issuerName;
  SignedProperties += '</ds:X509IssuerName>';
  SignedProperties += '<ds:X509SerialNumber>';
  SignedProperties += X509SerialNumber;
  SignedProperties += '</ds:X509SerialNumber>';
  SignedProperties += '</etsi:IssuerSerial>';
  SignedProperties += '</etsi:Cert>';
  SignedProperties += '</etsi:SigningCertificate>';
  SignedProperties += '</etsi:SignedSignatureProperties>';
  SignedProperties += '<etsi:SignedDataObjectProperties>';
  SignedProperties += '<etsi:DataObjectFormat ObjectReference="#Reference-ID-' + Reference_ID_number + '">';
  SignedProperties += '<etsi:Description>';
  SignedProperties += 'contenido comprobante';
  SignedProperties += '</etsi:Description>';
  SignedProperties += '<etsi:MimeType>';
  SignedProperties += 'text/xml';
  SignedProperties += '</etsi:MimeType>';
  SignedProperties += '</etsi:DataObjectFormat>';
  SignedProperties += '</etsi:SignedDataObjectProperties>';
  SignedProperties += '</etsi:SignedProperties>'; //fin SignedProperties
  SignedProperties_para_hash = SignedProperties.replace('<etsi:SignedProperties', '<etsi:SignedProperties ' + xmlns);
  var sha1_SignedProperties = sha1_base64(SignedProperties_para_hash);
  var KeyInfo = '';
  KeyInfo += '<ds:KeyInfo Id="Certificate' + Certificate_number + '">';
  KeyInfo += '\n<ds:X509Data>';
  KeyInfo += '\n<ds:X509Certificate>\n';
  KeyInfo += certificateX509;
  KeyInfo += '\n</ds:X509Certificate>';
  KeyInfo += '\n</ds:X509Data>';
  KeyInfo += '\n<ds:KeyValue>';
  KeyInfo += '\n<ds:RSAKeyValue>';
  KeyInfo += '\n<ds:Modulus>\n';
  KeyInfo += modulus;
  KeyInfo += '\n</ds:Modulus>';
  KeyInfo += '\n<ds:Exponent>';
  KeyInfo += exponent;
  KeyInfo += '</ds:Exponent>';
  KeyInfo += '\n</ds:RSAKeyValue>';
  KeyInfo += '\n</ds:KeyValue>';
  KeyInfo += '\n</ds:KeyInfo>';
  KeyInfo_para_hash = KeyInfo.replace('<ds:KeyInfo', '<ds:KeyInfo ' + xmlns);
  var sha1_certificado = sha1_base64(KeyInfo_para_hash);
  var SignedInfo = '';
  SignedInfo += '<ds:SignedInfo Id="Signature-SignedInfo' + SignedInfo_number + '">';
  SignedInfo += '\n<ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315">';
  SignedInfo += '</ds:CanonicalizationMethod>';
  SignedInfo += '\n<ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1">';
  SignedInfo += '</ds:SignatureMethod>';
  SignedInfo += '\n<ds:Reference Id="SignedPropertiesID' + SignedPropertiesID_number + '" Type="http://uri.etsi.org/01903#SignedProperties" URI="#Signature' + Signature_number + '-SignedProperties' + SignedProperties_number + '">';
  SignedInfo += '\n<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">';
  SignedInfo += '</ds:DigestMethod>';
  SignedInfo += '\n<ds:DigestValue>';
  SignedInfo += sha1_SignedProperties;
  SignedInfo += '</ds:DigestValue>';
  SignedInfo += '\n</ds:Reference>';
  SignedInfo += '\n<ds:Reference URI="#Certificate' + Certificate_number + '">';
  SignedInfo += '\n<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">';
  SignedInfo += '</ds:DigestMethod>';
  SignedInfo += '\n<ds:DigestValue>';
  SignedInfo += sha1_certificado;
  SignedInfo += '</ds:DigestValue>';
  SignedInfo += '\n</ds:Reference>';
  SignedInfo += '\n<ds:Reference Id="Reference-ID-' + Reference_ID_number + '" URI="#comprobante">';
  SignedInfo += '\n<ds:Transforms>';
  SignedInfo += '\n<ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature">';
  SignedInfo += '</ds:Transform>';
  SignedInfo += '\n</ds:Transforms>';
  SignedInfo += '\n<ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1">';
  SignedInfo += '</ds:DigestMethod>';
  SignedInfo += '\n<ds:DigestValue>';
  SignedInfo += sha1_comprobante;
  SignedInfo += '</ds:DigestValue>';
  SignedInfo += '\n</ds:Reference>';
  SignedInfo += '\n</ds:SignedInfo>';
  SignedInfo_para_firma = SignedInfo.replace('<ds:SignedInfo', '<ds:SignedInfo ' + xmlns);
  var md = forge.md.sha1.create();
  md.update(SignedInfo_para_firma, 'utf8');
  var signature = btoa(key.sign(md)).match(/.{1,76}/g).join("\n");
  var xades_bes = '';

  //INICIO DE LA FIRMA DIGITAL 
  xades_bes += '<ds:Signature ' + xmlns + ' Id="Signature' + Signature_number + '">';
  xades_bes += '\n' + SignedInfo;
  xades_bes += '\n<ds:SignatureValue Id="SignatureValue' + SignatureValue_number + '">\n';
  xades_bes += signature;
  xades_bes += '\n</ds:SignatureValue>';
  xades_bes += '\n' + KeyInfo;
  xades_bes += '\n<ds:Object Id="Signature' + Signature_number + '-Object' + Object_number + '">';
  xades_bes += '<etsi:QualifyingProperties Target="#Signature' + Signature_number + '">';
  xades_bes += SignedProperties;
  xades_bes += '</etsi:QualifyingProperties>';
  xades_bes += '</ds:Object>';
  xades_bes += '</ds:Signature>';
  return  comprobante.replace(/(<[^<]+)$/, xades_bes + '$1');
}
function sha1_base64(txt) {
  var md = forge.md.sha1.create();
  md.update(txt);
  //console.log('Buffer in: ', Buffer);
  //return new Buffer(md.digest().toHex(), 'hex').toString('base64');
  return new window.buffer.Buffer(md.digest().toHex(), 'hex').toString('base64');
}
function hexToBase64(str) {
  var hex = ('00' + str).slice(0 - str.length - str.length % 2);
  return btoa(String.fromCharCode.apply(null,hex.replace(/\r|\n/g, "").replace(/([\da-fA-F]{2}) ?/g, "0x$1 ").replace(/ +$/, "").split(" ")));
}
function bigint2base64(bigint) {
  var base64 = '';
  base64 = btoa(bigint.toString(16).match(/\w{2}/g).map(function (a) {
      return String.fromCharCode(parseInt(a, 16));
  }).join(""));
  base64 = base64.match(/.{1,76}/g).join("\n");
  return base64;
}
function p_obtener_aleatorio() {
  return Math.floor(Math.random() * 999000) + 990;
}