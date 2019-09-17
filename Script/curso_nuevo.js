$(function(){
	$('#Grabar').click(function(){
		if($('#txtcur').val() == ''){$.alert({title: 'Validacion!', content: 'Ingrese Nombre Curso!',});return false;}
  	$.getJSON('../Examen_PHP/Model/Curso.php',{
		    	txtcur: $('#txtcur').val()
		  },function(rpta){
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
