<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();

$Data['cboAlumno']	= $_GET['cboAlumno'];
$Data['cboCurso']	= $_GET['cboCurso'];
$Data['inN1']	= $_GET['inN1'];
$Data['inN2']	= $_GET['inN2'];
$Data['inN3']	= $_GET['inN3'];
$Data['inN4']	= $_GET['inN4'];

#$sql = "UPDATE alumno_curso SET	n1=".$Data['inN1'].",	n2=".$Data['inN2'].",	n3=".$Data['inN3'].",	n4=".$Data['inN4']." WHERE id_alumno =".$Data['cboAlumno']." and id_curso = ".$Data['cboCurso']."";
$sql = "insert into  alumno_curso(id_alumno,id_curso,n1,n2,n3,n4)values (".$Data['cboAlumno'].",".$Data['cboCurso'].",".$Data['inN1'].",".$Data['inN2'].",".$Data['inN3'].",".$Data['inN4'].")";

echo json_encode($Cnx->Guardar($sql));
?>
