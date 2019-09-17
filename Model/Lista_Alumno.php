<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();
$sql = "select * from alumnos";
echo json_encode($Cnx->consultar($sql));
?>
