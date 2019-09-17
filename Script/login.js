$(function(){

	$('#BtnRegistro').click(function(){
		if($('#txtusuario').val() == ''){
			alert('ingrese usuario');
			return false;
		}

		if($('#txtclave').val() == ''){
			alert('ingrese Clave');
			return false;
		}

		 $.getJSON('../Examen_PHP/Model/login.php',{
		    	usuario: $('#txtusuario').val(),
		    	password: $('#txtclave').val()
		  },function(rpta){
				console.log(rpta);
				if(rpta === false){
			  	alert('Usuario Incorrecto');
				}else if(rpta==null){
					alert('Usuario Incorrecto');
		  	}else{
		  		window.location.href = "../Examen_PHP/principal.php?Autorizate=True";
		  }
		});
	});
});
