<?php


require 'vendor/autoload.php';
include '../funciones.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
$worksheet = IOFactory::load('template.xlsx');

$nuevo = new Funcion();
$con=$nuevo->conectar();
date_default_timezone_set('America/Lima');
$hoy =date('Y-m-d');

$resultado=$nuevo->listararea($con);
$datos=$nuevo->mostrardatos($con);


// $hoja->setTitle("alumnos");
// $hoja->getColumnDimension('A')->sedWidth(10);

if(!empty($_POST['nomVisitante'])  || !empty($_POST['nomInstitucion']) || !empty($_POST['nomVisitado'])||!empty($_POST['oficina'])||!empty($_POST['desde']) || !empty($_POST['hasta'])){
    $nomVisitante=$_POST['nomVisitante'];
    $nomInstitucion=$_POST['nomInstitucion'];

    $nomVisitado=$_POST['nomVisitado'];
    $oficina=$_POST['oficina'];

    $desde=$_POST['desde'];
    $hasta=$_POST['hasta'];
    $datos=$nuevo->buscarsindoc($con,$nomVisitante,$nomInstitucion,$nomVisitado,$oficina,$desde,$hasta);
}
if(!empty($_POST['docVisitante'])){
    $docVisitante=$_POST['docVisitante'];
    $datos=$nuevo->buscardocvisitante($con,$docVisitante);
}

$spreadsheet = new Spreadsheet();
$sheet = $worksheet->getActiveSheet();
$num=1;

if(!empty($datos)){
    while($fila=$datos->fetch()){
        $id=$fila['idvisita'];
        $fecha=$fila['date_format(fecha, "%d/%m/%Y")'];
        $horaing=$fila['time_format(horaingreso, "%H:%i")'];
        $nombre=$fila['nombre'];
        $documento=$fila['documento'];
        $institucion=$fila['institucion'];
        $visitado=$fila['visitado'];
        $cargo=$fila['cargo'];
        $oficina=$fila['oficina'];
        $horasal=$fila['time_format(horasalida, "%H:%i")'];
        $array=array($id,$fecha,$horaing,$nombre,$documento,$institucion,$visitado,$cargo,$oficina,$horasal);
        for($i=0;$i<10;$i++){
            $letra = 'ABCDEFGHIJ';
            $celda=$letra[$i].$num;
            $sheet->setCellValue($celda, $array[$i]);
          }
          
        $num++;
    }
}
//dandole una cabecera primero, para obtener los resultado en archivo xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheet.sheet');
//dando un nombre al archivo xlsx
header('Content-Disposition: attachament;filename="visitas.xls"');

//creando un objeto iofactory
$create =IOFactory::createWriter($worksheet,'Xls');
//guardando en la salida de php
$create->save('php://output');

?>