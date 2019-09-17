$(function() {
  ListaAlumnoNota();
  ListaCursoNota();

  $('#Grabar').click(function() {
    if ($('#cboAlumno').val() == '0') {
    $.alert({title: 'Validacion!', content: 'Seleccione Alumno!',});
      return false;
    }

    if ($('#cboCurso').val() == '0') {
      $.alert({title: 'Validacion!', content: 'Seleccione Curso!',});
      return false;
    }

    if ($('#inN1').val() == '') {
      $.alert({title: 'Validacion!', content: 'Ingrese Nota 01!',});
      return false;
    }
    if ($('#inN2').val() == '') {
      $.alert({title: 'Validacion!', content: 'Ingrese Nota 02!',});
      return false;
    }
    if ($('#inN3').val() == '') {
      $.alert({title: 'Validacion!', content: 'Ingrese Nota 03!',});
      return false;
    }
    if ($('#inN4').val() == '') {
      $.alert({title: 'Validacion!', content: 'Ingrese Nota 04!',});
      return false;
    }

    $.getJSON('../Examen_PHP/Model/EditarNota.php', {
      cboAlumno: $('#cboAlumno').val(),
      cboCurso: $('#cboCurso').val(),
      inN1: $('#inN1').val(),
      inN2: $('#inN2').val(),
      inN3: $('#inN3').val(),
      inN4: $('#inN4').val()
    }, function(rpta) {
      if (rpta === true) {
          $('#ModalGeneral').modal('hide');
          GetData();
          $.alert({title: 'Notificacion!', content: 'Se Registro Correctamente!',});
      } else {
        alert('No se registro correctamente!');
      }
    });
  });
});

function ListaCursoNota(query1) {
  $.getJSON('../Examen_PHP/Model/Lista_curso.php', {}, function(rpta) {
    for (var i = 0; i < rpta.length; i++) {
      $('#cboCurso').append('<option value="' + rpta[i].id_curso + '">' + rpta[i].curso_nombre + '</option>');
    }
    if ($("#icodCurso").val() != '') $('#cboCurso').val($("#icodCurso").val() );
  });
}

function ListaAlumnoNota(query1) {
  $.getJSON('../Examen_PHP/Model/ListarData.php', {},
    function(rpta) {
      for (var i = 0; i < rpta.length; i++) {
        $('#cboAlumno').append('<option value="' + rpta[i].id_alumno + '">' + rpta[i].alumno + '</option>');
      }
      if ($("#icodAlumno").val() != '') $('#cboAlumno').val($("#icodAlumno").val());
    });
}
