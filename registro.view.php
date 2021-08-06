<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Registrar Visita</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-3">Registrar Visitas</h2>
        <form action="registro.php" method="POST">
            <div class="form-control">
                <div class="row">
                    <div class="col-md-4">
                        <h5>Visitante</h5>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre:</span>
                            <input name="nomVisitante" id="nomVisitante" type="text" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Documento:</span>
                            <input name="docVisitante" id="docVisitante" type="text" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Institucion:</span>
                            <input name="nomInstitucion" id="nomInstitucion" type="text" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Visitado</h5>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre:</span>
                            <input name="nomVisitado" id="nomVisitado" type="text" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Oficina:</span>
                            <select name="oficina" id="oficina" class="form-select" required>
                                <option value=""></option>
                                <?php while($fila=$resultado->fetch()){ ?>
                                    <option value="<?php echo $fila['nomArea'];?>"><?php echo $fila['nomArea'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Cargo:</span>
                            <input type="text" name="cargo" id="cargo" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                    <h5>Periodo</h5>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Fecha:</label>
                                <input name="fecha" id="fecha" type="date" class="form-control" placeholder="Ingrese el Nombre o Apellido">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Hora de Ingreso:</label>
                                <input name="Hingreso" id="Hingreso" type="time" class="form-control" placeholder="Ingrese el Nombre o Apellido">
                            </div>
                            <div class="input-group mb-3">
                                <label class="input-group-text">Hora de Salida:</label>
                                <input name="Hsalida" id="Hsalida" type="time" class="form-control" placeholder="Ingrese el Nombre o Apellido">
                            </div>
                    </div>
                    
                </div>
            </div>
            <div class="text-center mt-3 mb-3">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <button type="reset" class="btn btn-primary">Limpiar</button>
            </div>
        </form>
    </div>
</body>
</html>