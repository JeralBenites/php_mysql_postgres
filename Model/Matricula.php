<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();

$Data['cboCurso']	= $_GET['cboCurso'];
$Data['cboAlumno']	= $_GET['cboAlumno'];
$sql = "INSERT INTO alumno_curso(id_alumno,id_curso) values (".$Data['cboAlumno'].",".$Data['cboCurso'].");";
echo json_encode($Cnx->Guardar($sql));
?>
