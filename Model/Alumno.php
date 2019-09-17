<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();

$Data['paterno']	= $_GET['paterno'];
$Data['materno']	= $_GET['materno'];
$Data['nombre']	= $_GET['nombre'];
$Data['dni']	= $_GET['dni'];
$Data['cumple']	= $_GET['cumple'];
$Data['correo']	= $_GET['correo'];
$sql = "insert into alumnos(paterno,materno,nombre,dni,cumple,correo) values('".$Data['paterno']."','".$Data['materno']."','".$Data['nombre']."','".$Data['dni']."','".$Data['cumple']."','".$Data['correo']."');";
echo json_encode($Cnx->Guardar($sql));
?>
