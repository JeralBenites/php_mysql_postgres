<html>
<head>
	<script src="../Examen_PHP/Script/notas_nuevo.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="cboAlumno">Alumno</label>
					<select id="cboAlumno" class="form-control">
						<option value="0">(Seleccione)</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="cboCurso">Curso</label>
					<select id="cboCurso" class="form-control">
						<option value="0">(Seleccione)</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="txtcur">Notas 1</label>
					<input type="text" class="form-control" onkeypress="return isDecimal(event)" id="inN1" placeholder="Notas 1">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="txtcur">Notas 2</label>
					<input type="text" class="form-control"  onkeypress="return isDecimal(event)" id="inN2" placeholder="Notas 2">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="txtcur">Notas 3</label>
					<input type="text" class="form-control"  onkeypress="return isDecimal(event)" id="inN3" placeholder="Notas 3">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="txtcur">Notas 4</label>
					<input type="text" class="form-control"  onkeypress="return isDecimal(event)" id="inN4" placeholder="Notas 4">
				</div>
			</div>
		</div>
	</div>
</body>
</html>
