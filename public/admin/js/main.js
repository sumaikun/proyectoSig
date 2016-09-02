function armar_sonsecutivo(numero){

		var aux = null;
		switch ((numero.toString()).length) {
		   case 1:
		        aux = "000"+numero;
		   break;
		   case 2:
		        aux = "00"+numero;
		   break;
		   case 3:
		        aux = "0"+numero;
		   break;
		   case 4:
		        aux = numero;
		   break;
		}

		return aux;
	}



// esto es para el boton de informacion de cada vista
$('.fab').hover(function () {
    $(this).toggleClass('active');
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})