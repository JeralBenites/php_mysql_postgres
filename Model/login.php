<?php
include_once('../class/ClaseCon.php');
$Cnx = new ClaseCon();
$Data['usuario']	= $_GET['usuario'];
$Data['password']	= $_GET['password'];
$sql = "SELECT * FROM usuarios WHERE login = trim('".$Data['usuario']."') and clave = trim('".$Data['password']."');";
echo json_encode($Cnx->ejecutar($sql));
?>
