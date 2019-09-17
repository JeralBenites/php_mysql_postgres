<?php
include_once('../class/ClaseCon.php');
$Cnx = new ClaseCon();
$Data['txtcur']	= $_GET['txtcur'];
$sql = "insert into cursos(curso_nombre)values('".$Data['txtcur']."');";
echo json_encode($Cnx->Guardar($sql));
?>
