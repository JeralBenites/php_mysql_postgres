<?php
include_once('Config/cBaseDatos.php');

$Data['iTipoBd']	= $_GET['iTipoBd'];
$datos = new cBaseDatos($Data['iTipoBd']);
$Data['iTipo']	= $_GET['iTipo'];
$Data['id']		=$_GET['id'];
$Data['nombre']	=$_GET['nombre'];
$Data['cumple']	=$_GET['cumple'];
$Data['estado']	=$_GET['estado'];
switch ($Data['iTipo']) {
	case 1:			
		   $sql = "CALL InsertarUsuario('".$Data['nombre']."', '".$Data['cumple']."', '".$Data['estado']."')";
		   $sqlPg = "SELECT InsertarUsuario('".$Data['nombre']."', '".$Data['cumple']."', '".$Data['estado']."')";
		   $stmt = ($Data['iTipoBd'] == '4' ? $sql : $sqlPg );
		   echo json_encode($datos->ejecutar($stmt));
		break;	
	case 2:
		   $sql = "CALL EditarUsuario('".$Data['nombre']."', '".$Data['cumple']."', '".$Data['estado']."', ".$Data['id']." )";
		   $sqlPg = "SELECT EditarUsuario('".$Data['nombre']."', '".$Data['cumple']."', '".$Data['estado']."', ".$Data['id']." )";
		   $stmt = ($Data['iTipoBd'] == '4' ? $sql : $sqlPg );
		   echo json_encode($datos->ejecutar($stmt));
		break;		
	case 3:
		   $sql = "CALL EliminarUsuarios(".$Data['id'].")";
		   $sqlPg = "SELECT EliminarUsuarios(".$Data['id'].")";
		   $stmt = ($Data['iTipoBd'] == '4' ? $sql : $sqlPg );
		   echo json_encode($datos->ejecutar($stmt));	
		 break;
	case 4:
		   $sql = "select * from usuarios";
		   echo json_encode($datos->consultar($sql));
		break;		
	case 5:
		   $sqlPg = "select IDpersona as id,NOMBRE,CUMPLE, CASE  WHEN (estado = 'T') THEN '1'  ELSE '0' END AS estado from public.usuarios 
		   order by IDpersona asc ";
		   echo json_encode($datos->consultar($sqlPg));
		break;	
	}
?>