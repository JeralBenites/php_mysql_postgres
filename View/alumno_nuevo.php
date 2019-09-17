<html>
<head>
	<script src="../Examen_PHP/Script/alumno_nuevo.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group ">
					<label for="paterno">Apellido Paterno</label>
					<input type="text" class="form-control" id="paterno" placeholder="Apellido Paterno">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="materno">Apellido Materno</label>
					<input type="text" class="form-control" id="materno" placeholder="Apellido Paterno">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" placeholder="nombre">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="dni">D.N.I</label>
					<input type="text" maxlength="8" onkeypress="return isNumber(event)" class="form-control" id="dni" placeholder="D.N.I">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="cumple">cumple</label>
					<input type="date" class="form-control" id="cumple" placeholder="Cumpleaños">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="correo">correo</label>
					<input type="email" class="form-control" id="correo" placeholder="Correo">
				</div>
			</div>
		</div>
	</div>
</body>
</html>
