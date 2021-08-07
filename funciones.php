<?php

     class Funcion{
        
        public function conectar(){
            $bd="mysql:host=localhost;dbname=visitas";
            $user="root";
            $pass=""; 
            try {
                $conexion = new PDO($bd,$user,$pass);
              }catch(PDOException $e){
                echo "Error:" . $e->getMessage();;
              }
            return $conexion;  
        }

        public function mostrardatos($con,$hoy){
            $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i"),date_format(fecha, "%d/%m/%Y") FROM `visitas`
            WHERE fecha BETWEEN "'.$hoy.'" and "'.$hoy.'"');
            $consulta->execute();
            return $consulta;
        }

        public function buscarsindoc($con,$nombre,$insti,$visitado,$oficina,$desde,$hasta){
            $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i"),date_format(fecha, "%d/%m/%Y")
            FROM `visitas`
             WHERE nombre LIKE "%'.$nombre.'%" 
            AND institucion LIKE "%'.$insti.'%"
            AND visitado LIKE "%'.$visitado.'%"
            AND oficina LIKE "%'.$oficina.'%"
            AND fecha BETWEEN "'.$desde.'" AND "'.$hasta.'"
            ');
            $consulta->execute();
            return $consulta;
        }
        
        // public function buscarconDoc($con){
        //     $consulta=$con->prepare('
        //     SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i") 
        //     FROM `visitas`
        //     WHERE nombre LIKE "%%" 
        //     AND documento="" 
        //     AND institucion LIKE "%%"
        //     ');
        // }

        // public function buscarnomvisitante($con,$nombre){
        //     $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i") FROM `visitas` WHERE nombre LIKE "%'.$nombre.'%" ');
        //     $consulta->execute();
        //     return $consulta;
        // }
        public function buscardocvisitante($con,$doc){
            $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i") FROM `visitas` WHERE documento="'.$doc.'"');
            $consulta->execute();
            return $consulta;
        }
        // public function buscarinstvisitante($con,$insti){
        //     $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i") FROM `visitas` WHERE institucion LIKE "%'.$insti.'%"');
        //     $consulta->execute();
        //     return $consulta;
        // }

        // public function buscarnomvisitado($con,$nombre){
        //     $consulta=$con->prepare('SELECT *,time_format(horaingreso, "%H:%i"),time_format(horasalida, "%H:%i") FROM `visitas` WHERE visitado LIKE "%'.$nombre.'%" ');
        //     $consulta->execute();
        //     return $consulta;
        // }

        public function listararea($con){
            $consulta=$con->prepare('SELECT * FROM `area`');
            $consulta->execute();
            return $consulta;
        }

        public function registrarvisita($con,$nomTante,$docTante,$nomInsti,$nomTado,$ofi,$fecha,$horaing,$horasal,$cargo){
            $consulta=$con->prepare('INSERT INTO `visitas` (`fecha`, `horaingreso`, `nombre`, `documento`, `institucion`, `visitado`, `cargo`, `oficina`, `horasalida`) VALUES ("'.$fecha.'", "'.$horaing.'", "'.$nomTante.'", "'.$docTante.'", "'.$nomInsti.'", "'.$nomTado.'", "'.$cargo.'", "'.$ofi.'", "'.$horasal.'")');
            $consulta->execute();
            return $consulta;
        }
    }

?>