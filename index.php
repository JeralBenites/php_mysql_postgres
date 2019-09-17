<?php
session_unset();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="css/estilos.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="Script/jquery-3.3.1.js"></script>
</head>
<body id="dot-matrix">
  <div class="container" style="margin-top:20px;">
    <div class="col-md-4 col-md-offset-4">
      <section>
        <div class="panel panel-default top caja">
          <div class="panel-body">
            <h3 class="text-center">ACCESO</h3>
            <br>
            <form>
              <div class="input-group input-group-lg">
                <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user" aria-hidden="true"></i>Usuario</span>
                <input type="text" name="txtusuario" id="txtusuario" class="form-control" placeholder="Usuario">
              </div>
              <br>
              <div class="input-group input-group-lg">
                <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-key" aria-hidden="true"></i>Clave</span>
                <input type="text" name="txtclave" id="txtclave" class="form-control" placeholder="Clave">
              </div>
              <br>
              <button type="button" class="btn btn-primary btn-block" id="BtnRegistro">Ingresar</button>
            </form>
          </div>
        </div>
      </section>
    </div>
  </div>
  <script src="Script/login.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
