<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();

$Data['cboAlumno']	= $_GET['cboAlumno'];
$Data['cboCurso']	= $_GET['cboCurso'];


$sql ="DELETE FROM alumno_curso WHERE id_alumno = ".$Data['cboAlumno']." and id_curso = ".$Data['cboCurso'];

echo json_encode($Cnx->Guardar($sql));
?>
