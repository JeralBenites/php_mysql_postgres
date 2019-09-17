<?php
include_once('../class/ClaseCon.php');

$Cnx = new ClaseCon();
$sql = "select
a.id_alumno,concat_ws(' ',a.paterno,a.materno,a.nombre) alumno,
b.id_curso,c.curso_nombre,
b.n1,b.n2,b.n3,b.n4,b.promedio,b.notificado
from alumnos a
left join alumno_curso b on a.id_alumno=b.id_alumno
left join cursos c on b.id_curso=c.id_curso where b.id_curso IS NULL
order by a.paterno,a.materno,a.nombre;";
echo json_encode($Cnx->consultar($sql));
?>
