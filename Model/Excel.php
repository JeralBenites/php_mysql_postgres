<?php
include_once('../class/ClaseCon.php');
include_once('../lib/PHPExcel/Classes/PHPExcel.php');

$Cnx = new ClaseCon();
$sql = "select
a.id_alumno,concat_ws(' ',a.paterno,a.materno,a.nombre) alumno,
b.id_curso,c.curso_nombre,
b.n1,b.n2,b.n3,b.n4,b.promedio,b.notificado
from alumnos a
left join alumno_curso b on a.id_alumno=b.id_alumno
left join cursos c on b.id_curso=c.id_curso where b.id_curso IS NOT NULL
order by a.paterno,a.materno,a.nombre;";
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Php2")
					 ->setTitle("Reporte Excel")
					 ->setSubject("Reporte Excel")
					 ->setDescription("Reporte de alumnos")
					 ->setKeywords("reporte alumnos ")
					 ->setCategory("Reporte excel");

$tituloReporte = "Relación de alumnos ";
$titulosColumnas = array('Alumno', 'Curso', 'Nota 01', 'Nota 02', 'Nota 03', 'Nota 04', 'Promedio');

$objPHPExcel->setActiveSheetIndex(0)
    		    ->mergeCells('A1:G1');

$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1',$tituloReporte)
    		    ->setCellValue('A3',  $titulosColumnas[0])
            ->setCellValue('B3',  $titulosColumnas[1])
    		    ->setCellValue('C3',  $titulosColumnas[2])
        		->setCellValue('D3',  $titulosColumnas[3])
        		->setCellValue('E3',  $titulosColumnas[4])
        		->setCellValue('F3',  $titulosColumnas[5])
        		->setCellValue('G3',  $titulosColumnas[6]);

  $i = 4;
  foreach($Cnx->consultar($sql) as $item){
    $objPHPExcel->setActiveSheetIndex(0)
              ->setCellValue('A'.$i, $item['alumno'])
              ->setCellValue('B'.$i, $item['curso_nombre'])
              ->setCellValue('C'.$i, $item['n1'])
              ->setCellValue('D'.$i, $item['n2'])
              ->setCellValue('E'.$i, $item['n3'])
              ->setCellValue('F'.$i, $item['n4'])
              ->setCellValue('G'.$i, $item['promedio']);
        $i++;
      }
      $estiloTituloReporte = array(
              	'font' => array(
      	        	'name'      => 'Verdana',
          	        'bold'      => true,
              	    'italic'    => false,
                      'strike'    => false,
                     	'size' =>16,
      	            	'color'     => array(
          	            	'rgb' => 'FFFFFF'
              	       	)
                  ),
      	        'fill' => array(
      				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
      				'color'	=> array('argb' => 'FF220835')
      			),
                  'borders' => array(
                     	'allborders' => array(
                      	'style' => PHPExcel_Style_Border::BORDER_NONE
                     	)
                  ),
                  'alignment' =>  array(
              			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              			'rotation'   => 0,
              			'wrap'          => TRUE
          		)
              );

      		$estiloTituloColumnas = array(
                  'font' => array(
                      'name'      => 'Arial',
                      'bold'      => true,
                      'color'     => array(
                          'rgb' => 'FFFFFF'
                      )
                  ),
                  'fill' 	=> array(
      				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
      				'rotation'   => 90,
              		'startcolor' => array(
                  		'rgb' => 'c47cf2'
              		),
              		'endcolor'   => array(
                  		'argb' => 'FF431a5d'
              		)
      			),
                  'borders' => array(
                  	'top'     => array(
                          'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                          'color' => array(
                              'rgb' => '143860'
                          )
                      ),
                      'bottom'     => array(
                          'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                          'color' => array(
                              'rgb' => '143860'
                          )
                      )
                  ),
      			'alignment' =>  array(
              			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              			'wrap'          => TRUE
          		));

      		$estiloInformacion = new PHPExcel_Style();
      		$estiloInformacion->applyFromArray(
      			array(
                 		'font' => array(
                     	'name'      => 'Arial',
                     	'color'     => array(
                         	'rgb' => '000000'
                     	)
                 	),
                 	'fill' 	=> array(
      				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
      				'color'		=> array('argb' => 'FFd9b7f4')
      			),
                 	'borders' => array(
                     	'left'     => array(
                         	'style' => PHPExcel_Style_Border::BORDER_THIN ,
      	                'color' => array(
          	            	'rgb' => '3a2a47'
                         	)
                     	)
                 	)
              ));

      		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
      		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);
      		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));

      		for($i = 'A'; $i <= 'G'; $i++){
      			$objPHPExcel->setActiveSheetIndex(0)
      				->getColumnDimension($i)->setAutoSize(TRUE);
      		}

      		// Se asigna el nombre a la hoja
      		$objPHPExcel->getActiveSheet()->setTitle('Alumnos');

      		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
      		$objPHPExcel->setActiveSheetIndex(0);
      		// Inmovilizar paneles
      		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
      		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
          $date=new DateTime();;
          $result = $date->format('Y-m-d-H-i-s');
          $krr = explode('-',$result);
          $result = implode("",$krr);
          // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
      		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      		header('Content-Disposition: attachment;filename="Reportedealumnos'.$result.'.xlsx"');
      		header('Cache-Control: max-age=0');

      		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      		$objWriter->save('php://output');
      		exit;
?>
