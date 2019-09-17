<!DOCTYPE html>
<html lang="es">
<?php
  session_start();
  $_SESSION['Autorizate'] = $_GET['Autorizate'];
  if($_SESSION['Autorizate'] !== "True"){
    ob_start();
    header("Location: index.php");
    ob_end_flush();
  }
?>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/estilos.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <script src="Script/jquery-3.3.1.js"></script>
  <script src="Script/index.js"></script>
</head>

<body >
  <div class="container" style="margin-top:20px;">
    <div class="btn-group" role="group">
      <button type="button" onclick="LoadAlumno();" class="btn btn-default">+Alumno&nbsp;&nbsp;</button>
      <button type="button" onclick="LoadCurso();" class="btn btn-default">+Curso&nbsp;&nbsp;</button>
      <button type="button" onclick="LoadNota();"  class="btn btn-default">+Notas&nbsp;&nbsp;</button>
      <button type="button" onclick="LoadReporte();" class="btn btn-default">+Reporte&nbsp;&nbsp;</button>
      <button type="button" onclick="window.location.href='index.php'" class="btn btn-default">+Salir&nbsp;&nbsp;</button>
    </div>
    <br>
    <br>
    <br>
    <table class="table table-striped" border="1">
      <thead class="thead-light">
        <tr>
          <th>Alumno</th>
          <th>Curso</th>
          <th>Nota 1</th>
          <th>Nota 2</th>
          <th>Nota 3</th>
          <th>Nota 4</th>
          <th>Promedio</th>
          <th colspan="2">Accion</th>
        </tr>
      </thead>
      <tbody id='result'></tbody>
    </table>
    <footer class="footer">
      <div class="container">
        <span class="text-muted">CopyRight @CursoPHP</span>
      </div>
    </footer>
  </div>

  <div id="ModalGeneral" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="Title"></h4>
        </div>
        <div class="modal-body" id="contentBody">
        </div>
        <div class="modal-footer" id="FotterButton">

        </div>
      </div>
    </div>
  </div>
<input type="hidden" id="icodAlumno">
<input type="hidden" id="icodCurso">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>

</html>
