<?php
include_once('../class/ClaseCon.php');
include_once('../lib/fpdf181/fpdf.php');
class PDF extends FPDF{
	function Header(){
	    $this->SetFont('Arial','B',15);
	    $this->Cell(0,10,'Reporte Alumnos',0,0,'C');
	    $this->Line(10,30,200,30);
	    $this->Ln(20);
	}

	function Footer(){
	    $this->SetY(-15);
	    $this->SetFont('Arial','I',8);
	    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);

$Cnx = new ClaseCon();
$sql = "select
a.id_alumno,concat_ws(' ',a.paterno,a.materno,a.nombre) alumno,
b.id_curso,c.curso_nombre,
b.n1,b.n2,b.n3,b.n4,b.promedio,b.notificado
from alumnos a
left join alumno_curso b on a.id_alumno=b.id_alumno
left join cursos c on b.id_curso=c.id_curso where b.id_curso IS NOT NULL
order by a.paterno,a.materno,a.nombre;";

$arrayHeader = array(
   "alumno"=>"Alumno",
   "curso_nombre"=>"Curso",
	 "n1"=>"Nota 01",
	 "n2"=>"Nota 02",
	 "n3"=>"Nota 03",
	 "n4"=>"Nota 04",
	 "promedio"=>"Promedio"
);

$pdf->Cell(60,8,$arrayHeader['alumno'],1,0,'C');
$pdf->Cell(50,8,$arrayHeader['curso_nombre'],1,0,'C');
$pdf->Cell(15,8,$arrayHeader['n1'],1,0,'C');
$pdf->Cell(15,8,$arrayHeader['n2'],1,0,'C');
$pdf->Cell(15,8,$arrayHeader['n3'],1,0,'C');
$pdf->Cell(15,8,$arrayHeader['n4'],1,0,'C');
$pdf->MultiCell(20,8,$arrayHeader['promedio'],1,0);

foreach($Cnx->consultar($sql) as $item){
	$pdf->Cell(60,8,utf8_decode($item['alumno']),1,0,'C');
	$pdf->Cell(50,8,utf8_decode($item['curso_nombre']),1,0,'C');
	$pdf->Cell(15,8,$item['n1'],1,0,'C');
	$pdf->Cell(15,8,$item['n2'],1,0,'C');
	$pdf->Cell(15,8,$item['n3'],1,0,'C');
	$pdf->Cell(15,8,$item['n4'],1,0,'C');
	$pdf->MultiCell(20,8,$item['promedio'],1,0);
}

$pdf->Output();

?>
