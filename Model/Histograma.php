<?php
class histograma{
    public $datos;

    function ingresar_datos($entrada){
        $this->datos=$entrada;
    }

    function graficar(){
		$barra=100;
		$alto=400;
		$ancho=50 + $barra* count($this->datos);

		$figura=imagecreate($ancho,$alto);
		$ColorFondo=imagecolorallocate($figura,202,164,102);
		$ColorBlanco=imagecolorallocate($figura,255,255,255);

		$ColorFilaPar=imagecolorallocate($figura,90,0,0);
		$ColorFilaImpar=imagecolorallocate($figura,0,0,65);

		imagefill($figura,0,0,$ColorFondo);

		$i=0;
		foreach($this->datos as $m){
			$x1=$barra+$i*$barra;
			$y1=$alto-10*$m['promedio'];
			$x2=$x1 + $barra;
			$y2=$alto;
			if ($i%2==0){
					$ColorFila=$ColorFilaPar;
				}else{
					$ColorFila=$ColorFilaImpar;
			}
			imagefilledrectangle($figura,$x1,$y1,$x2,$y2,$ColorFila);
			imagettftext($figura,9,90,$x1+15,$alto-5, $ColorFondo, "arial.ttf", $m['promedio']  );
			imagettftext($figura,9,90,$x1+15,$alto-5, $ColorBlanco, "arial.ttf", $m['alumno'] );
			$i++;
		}
		header('Content-type: image/png');
		imagepng($figura);
		imagedestroy($figura);
    }
}

include_once('../class/ClaseCon.php');
$Cnx = new ClaseCon();
$sql = "select
a.id_alumno,concat_ws(' ',a.paterno,a.materno,a.nombre) alumno,
b.id_curso,c.curso_nombre,
b.n1,b.n2,b.n3,b.n4,b.promedio,b.notificado
from alumnos a
left join alumno_curso b on a.id_alumno=b.id_alumno
left join cursos c on b.id_curso=c.id_curso where b.id_curso IS NOT NULL
order by a.paterno,a.materno,a.nombre;";
$Histo=new histograma;
$Histo->ingresar_datos($Cnx->consultar($sql));
$Histo->graficar();
?>
