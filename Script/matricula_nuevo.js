$(function(){

 ListaAlumno();
 ListaCurso();

	$('#Grabar').click(function(){
		if($('#cboAlumno').val() == '0'){
			alert('Seleccione alumno');
			return false;
		}

		if($('#cboCurso').val() == '0'){
			alert('Seleccione curso');
			return false;
		}

		 $.getJSON('../Examen_PHP/Model/Matricula.php',{
		    	cboCurso: $('#cboCurso').val(),
		    	cboAlumno: $('#cboAlumno').val()
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

function ListaCurso(){
 $.getJSON('../Examen_PHP/Model/Lista_curso.php',{
		  },function(rpta){
		  	for (var i = 0; i < rpta.length; i++)
		  	{
		  		$('#cboCurso').append( '<option value="'+rpta[i].id_curso+'">'+rpta[i].curso_nombre+'</option>' );
		  	}
		});
}

function ListaAlumno(){
 $.getJSON('../Examen_PHP/Model/Lista_Alumno.php',{},
  function(rpta){
    for (var i = 0; i < rpta.length; i++)
    {
      $('#cboAlumno').append( '<option value="'+rpta[i].id_alumno+'">'+rpta[i].paterno+", "+rpta[i].materno+" "+rpta[i].nombre+'</option>' );
    }
  });
}
