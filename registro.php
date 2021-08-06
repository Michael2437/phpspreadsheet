<?php 
include 'funciones.php';
date_default_timezone_set('America/Lima');
$nuevo= new Funcion();
$con= $nuevo->conectar();
$fecha = date("Y-m-d H:i:s"); 
$resultado=$nuevo->listararea($con);

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $nomVisitante=$_POST['nomVisitante'];
    $docVisitante=$_POST['docVisitante'];
    $nomInstitucion=$_POST['nomInstitucion'];
    $nomVisitado=$_POST['nomVisitado'];
    $oficina=$_POST['oficina'];
    $cargo =$_POST['cargo'];
    $fecha=$_POST['fecha'];
    $Hingreso=$_POST['Hingreso'];
    $Hsalida=$_POST['Hsalida'];
    
    if(!empty($nomVisitante)&&!empty($docVisitante)){
        $nuevo->registrarvisita($con,$nomVisitante,$docVisitante,$nomInstitucion,$nomVisitado,$oficina,$fecha,$Hingreso,$Hsalida,$cargo);
    }
}

require 'registro.view.php';
?>