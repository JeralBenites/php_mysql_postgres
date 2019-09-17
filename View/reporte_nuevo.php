<html>
<head>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="txtcur">Pdf</label>
          <form name="f1" method="post" action="../Examen_PHP/Model/Pdf.php">
            <input class="btn btn-secondary" type="submit" value="Generar pdf"> <br/>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="txtcur">Excel</label>
          <form name="f1" method="post" action="../Examen_PHP/Model/Excel.php">
            <input class="btn btn-secondary" type="submit" value="Generar excel"> <br/>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="txtcur">Histograma</label>
          <form name="f1" method="post" action="../Examen_PHP/Model/Histograma.php">
            <input class="btn btn-secondary" type="submit" value="Generar Histograma"> <br/>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
