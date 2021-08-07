<?php
include 'funciones.php';
$nuevo = new Funcion();
$con=$nuevo->conectar();
date_default_timezone_set('America/Lima');
$hoy =date('Y-m-d');

$resultado=$nuevo->listararea($con);
$datos=$nuevo->mostrardatos($con,$hoy);

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


require 'index.view.php';
?>