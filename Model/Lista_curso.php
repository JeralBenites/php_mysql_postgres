<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();
$sql = "select * from cursos;";
echo json_encode($Cnx->consultar($sql));
?>
