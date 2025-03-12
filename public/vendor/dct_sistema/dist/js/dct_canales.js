var validation = {
	isEmailAddress: function (str) {
		var pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		return pattern.test(str);
	},
	isNotEmpty: function (str) {
		var pattern = /\S+/;
		return pattern.test(str);
	},
	isNumber: function (str) {
		var pattern = /^\d+$/;
		return pattern.test(str);
	},
	isSame: function (str1, str2) {
		return str1 === str2;
	}
};
function redireccionarDreConsTec() {
	window.location = "https://www.insotec.net/";
}
$(document).ready(function () {

	$('.bg_load').hide();
	$(document)
		.ajaxStart(function () { $('.bg_load').show(); })
		.ajaxStop(function () { $('.bg_load').hide(); });

	$('#btnCanalWeb').click(function () {
		window.location.href = 'https://www.dreconstec.com/';
		return false;
	});
	$('#btnCanalWhatsapp').click(function () {
		window.location.href = 'https://api.whatsapp.com/send?phone=+593960939030&text=Hola...!!!%20Necesito%20saber%20de%20sus%20servicios.';
		return false;
	});
	$('#btnCanalFacebook').click(function () {
		window.location.href = 'https://www.facebook.com/dreconstec';
		return false;
	});
	$('#btnCanalInstagram').click(function () {
		window.location.href = 'https://www.instagram.com/dreconstec/';
		return false;
	});
	$('#btnCanalLinkedin').click(function () {
		window.location.href = 'https://www.linkedin.com/in/mauro-echeverría-chugulí-a054625a/';
		return false;
	});
	$('#btnCanalContactenos').click(function () {
		window.location.href = 'https://www.dreconstec.com/contactanos/';
		return false;
	});
});