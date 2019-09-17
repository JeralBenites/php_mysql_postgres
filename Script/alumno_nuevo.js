$(function(){

	$('#Grabar').click(function(){

		if($('#paterno').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Apellido Paterno!',});return false;}
		if($('#materno').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Apellido Materno!',});return false;}
		if($('#nombre').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Nombre!',});return false;}
		if($('#dni').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese D.N.I!',});return false;}
		if($('#cumple').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Cumpleaños!',});return false;}
		if($('#correo').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Correo!',});return false;}
	 $.getJSON('../Examen_PHP/Model/Alumno.php',{
		    	paterno: $('#paterno').val(),
		    	materno: $('#materno').val(),
		    	nombre: $('#nombre').val(),
		    	dni: $('#dni').val(),
		    	cumple: $('#cumple').val(),
		    	correo: $('#correo').val()
		  },function(rpta){
				console.log(rpta);
		  	if(rpta === true){
		  			$('#ModalGeneral').modal('hide');
						GetData();
						$.alert({title: 'Notificacion!', content: 'Se Registro Correctamente!',});
		  }else{
		  	alert('No se registro correctamente!');
		  }
		});
	});
});
