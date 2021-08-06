<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <title>Buscar</title>
</head>
<body>
<div id="datos">
    <div class="container">
        <h2 class="text-center mb-3">Búsqueda de Visitas</h2>
        <form action="phpspreadsheet/excel.php" method="POST" class="form" name="buscar">
            <div class="form-control">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-control text-center">
                        <h5>Visitante</h5>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">Nombre del visitante:</span>
                                <input name="nomVisitante" id="nomVisitante" value="<?php if(isset($nomVisitante)){echo $nomVisitante;}?>" type="text" class="form-control" placeholder="Ingrese el Nombre o Apellido" autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Doc. de Identidad:</span>
                                <input name="docVisitante" id="docVisitante" value="<?php if(isset($docVisitante)){echo $docVisitante;}?>" type="text" class="form-control" placeholder="Ingrese DNI" autocomplete="off"> 
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Institución:</span>
                                <input name="nomInstitucion" id="nomInstitucion" value="<?php if(isset($nomInstitucion)){echo $nomInstitucion;}?>" type="text" class="form-control" placeholder="Ingrese el nombre" autocomplete="off">
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-control text-center">
                        <h5>Visitado</h5>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Nombre:</label>
                                <input name="nomVisitado" id="nomVisitado" value="<?php if(isset($nomVisitado)){echo $nomVisitado;}?>" type="text" class="form-control" placeholder="Ingrese el Nombre o Apellido" autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Oficina Visitada:</label>
                                <select name="oficina" id="oficina" class="form-select">
                                    <option value="">Todas</option>
                                    <?php while($fila=$resultado->fetch()){ ?>
                                    <option value="<?php echo $fila['nomArea'];?>" <?php if(isset($oficina)){if($oficina ==$fila['nomArea']){echo "selected";}}?>><?php echo $fila['nomArea'];?></option>
                                    <?php }?>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-control text-center">
                        <h5>Periodo</h5>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Desde:</label>
                                <input name="desde" id="desde" type="date" class="form-control" value="<?php if(isset($desde)){echo $desde;}else{echo $hoy;}?>" autocomplete="off">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Hasta:</label>
                                <input name="hasta" id="hasta" type="date" class="form-control" value="<?php if(isset($hasta)){echo $hasta;}else{echo $hoy;}?>" autocomplete="off">
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
            <div class="text-center mt-3 mb-3">
                <button onclick="miFunc()" id="enviar" class="btn btn-primary">Buscar</button>
                <!-- <a href="phpspreadsheet/excel.php" class="btn btn-primary">Exportar A Excel</a> -->
                <button onclick="buscar.submit()" class="btn btn-primary">Exportar A Excel</button>
                <!-- <button type="reset" onclick="buscar.reset()" class="btn btn-primary">Limpiar</button> -->
            </div>
           
            <table class="table table-dark table-striped text-center" id="mytable">
            <thead>
                <tr>
                <th scope="col">Item</th>
                <th scope="col">Fecha</th>
                <th scope="col">HoraIng</th>
                <th scope="col">Nombre</th>
                <th scope="col">Documento</th>
                <th scope="col">Institucion</th>
                <th scope="col">Visitado</th>
                <th scope="col">Cargo</th>
                <th scope="col">Oficina</th>
                <th scope="col">HoraSal</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($datos)){
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
                ?>  
                <tr>
                    <?php    for($i=0;$i<10;$i++){?>
                        <td><?php echo $array[$i];?></td>
                    <?php }?>
                </tr>
            <?php   }
            }?>
            </tbody>
            </table>
            
    </div>
</div>
    <!-- <script type="text/javascript">
        $('#enviar').on('click',function(){
            
                    $(document).ready(function(){    
                    $("#table_refresh").load("seccion.php");
                     }); 
        });
    </script>
    <script>
 // Write on keyup event of keyword input element
 $(document).ready(function(){
    $("#nomVisitante").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
            $.each($("#mytable tbody tr"), function() {
                if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
                else
                $(this).show();
            });
    });
});
</script> -->
<script type="text/javascript" src="main.js"></script>
</body>
</html>