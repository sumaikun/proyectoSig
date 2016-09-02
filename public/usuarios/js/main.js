function armar_sonsecutivo(numero){

		var aux = null;
		switch (numero.length) {
		   case 1:
		        aux="000"+numero;
		   break;
		   case 2:
		        aux="00"+numero;
		   break;
		   case 3:
		        aux="0"+numero;
		   break;
		   case 4:
		        aux=numero;
		   break;
		}

		return aux;
	}



$('.fab').hover(function () {
    $(this).toggleClass('active');
});
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})




$( ".maxi" ).click(function() {
	animate('.maxi', 'animated flip');
	return false;
});

function animate(elementoid, animation){
	$(elementoid).addClass(animation);
	var wait = window.setTimeout(function (){	$(elementoid).removeClass(animation); }, 1500);
}



$( "#mximin" ).click(function() {

	// $('.maxi').addClass('animated bounceOutLeft');
  
  	if ($(this).hasClass('fa-expand')){
		$(this).removeClass('fa-expand').addClass('fa-compress');

		// $("#menula").fadeOut(2000);

		$("#menula").addClass('hide').removeClass('show');

		$("#menula").removeClass('col-lg-2');

		$("#conte").removeClass('col-lg-offset-2 col-lg-10').addClass('col-lg-12');
		
	}else{
		$(this).removeClass('fa-compress').addClass('fa-expand');
		
		$("#menula").fadeIn(1500).addClass('show').removeClass('hide');

		$("#menula").addClass('col-lg-2');

		$("#conte").addClass('col-lg-offset-2 col-lg-10').removeClass('col-lg-12');

	}




});