$(document).ready(function() {
  GetData();
});

var LoadAlumno = function() {
  $.ajax({
    url: "../Examen_PHP/View/alumno_nuevo.php",
    success: function(result) {
      $("#FotterButton").html("<input type=\"submit\" class=\"btn btn-primary\" value=\"Grabar\" id=\"Grabar\">");
      $("#contentBody").html(result);
      $("#Title").html("Nuevo Alumno");
      $("#ModalGeneral").modal('show');
    }
  });
}
var LoadCurso = function() {
  $.ajax({
    url: "../Examen_PHP/View/curso_nuevo.php",
    success: function(result) {
      $("#FotterButton").html("<input type=\"submit\" class=\"btn btn-primary\" value=\"Grabar\" id=\"Grabar\">");
      $("#contentBody").html(result);
      $("#Title").html("Nuevo Curso");
      $("#ModalGeneral").modal('show');
    }
  });
}
var LoadNota = function() {
  $.ajax({
    url: "../Examen_PHP/View/notas_nuevo.php",
    success: function(result) {
      $("#FotterButton").html("<input type=\"submit\" class=\"btn btn-primary\" value=\"Grabar\" id=\"Grabar\">");
      $("#contentBody").html(result);
      $("#Title").html("Registar Nota");
      $("#ModalGeneral").modal('show');
    }
  });
}
var LoadReporte = function() {
  $.ajax({
    url: "../Examen_PHP/View/reporte_nuevo.php",
    success: function(result) {
      $("#contentBody").html(result);
      $("#Title").html("Reportes");
      $("#ModalGeneral").modal('show');
    }
  });
}

function GetData() {
  $.ajax({
    type: 'get',
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    cache: false,
    async: false,
    url: '../Examen_PHP/Model/ListarData.php',
    success: function(data) {
      var response;
      $('#result').html('');
      $.each(data, function(i, item) {
        response += '<tr><td>' + (item.alumno == null ? '' : item.alumno) +
          '</td><td>' + (item.curso_nombre == null ? '' : item.curso_nombre) +
          '</td><td>' + (item.n1 == null ? '' : item.n1) +
          '</td><td>' + (item.n2 == null ? '' : item.n2) +
          '</td><td>' + (item.n3 == null ? '' : item.n3) +
          '</td><td>' + (item.n4 == null ? '' : item.n4) +
          '</td><td>' + (item.promedio == null ? '' : item.promedio) +
          '</td><th>' + (item.id_curso == null ? '</th></tr>' : '<button type="button" class="btn btn-primary" onclick="return Editar(' + item.id_alumno + ', ' + item.id_curso + ')">Editar</button><button type="button" class="btn btn-danger" onclick="Eliminar(' + item.id_alumno + ', ' + item.id_curso + ')">Eliminar</button></th></tr>');
      });
      $('#result').html(response);
    }
  });
}

var Editar = function(Alumno, Curso) {
  $("#icodAlumno").val(Alumno);
  $("#icodCurso").val(Curso);
  $.ajax({
    url: "../Examen_php/View/editarNota.php",
    success: function(result) {
      $("#FotterButton").html("<input type=\"submit\" class=\"btn btn-primary\" value=\"Grabar\" id=\"Grabar\">");
      $("#contentBody").html(result);
      $("#Title").html("Reportes");
      $("#ModalGeneral").modal('show');
    }
  });
};

var Eliminar = function(Alumno, Curso) {
  $.confirm({
    title: 'Confirmacion!',
    content: 'Seguro de Eliminar?',
    buttons: {
      Confirmar: {
        text: 'Confirmar',
        btnClass: 'btn-danger',
        action: function() {
          $.getJSON('../Examen_php/Model/Eliminarnota.php', {
            cboAlumno: Alumno,
            cboCurso: Curso
          }, function(rpta) {
            if (rpta === true) {
              location.reload();
            } else {
              alert('No se Elimino correctamente!');
            }
          });
        }
      },
      Cancelar: {
        text: 'Cancelar',
        action: function() {
          $.alert('Cancelado!');
        }
      }
    }
  });
};

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if ((charCode > 31 && charCode < 48) || charCode > 57) {
        return false;
    }
    return true;
}

function isDecimal(event) {
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
    ((event.which < 48 || event.which > 57) &&
      (event.which != 0 && event.which != 8))) {
      event.preventDefault();
  }
  var text = $(this).val();
  if ((text.indexOf('.') != -1) &&
    (text.substring(text.indexOf('.')).length > 1) &&
    (event.which != 0 && event.which != 8) &&
    ($(this)[0].selectionStart >= text.length - 1)) {
      event.preventDefault();
  }
}
