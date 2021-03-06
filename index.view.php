<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Visitas <?php echo $hoy;?></title>
</head>
<body>
<div id="datos">
    <div class="container">
        <h2 class="text-center mb-3">Búsqueda de Visitas</h2>
        <form action="" method="POST" class="form" name="buscar">
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
<!--                 Boton para habilitar la exportacion a excel
                <button onclick="buscar.submit()" class="btn btn-primary">Exportar A Excel</button> -->
            </div>
        <div class="table-responsive">   
            <table class="table table-striped text-center" id="myTable">
                <thead>
                    <tr class="table-dark">
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
                    <tr class="table-primary">
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
</div>
    
<!-- jquery y bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>   
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
 
 <!-- datatables con bootstrap -->
 <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>

 <!-- Para usar los botones -->
 <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>


<!-- Para los estilos en Excel     -->
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.templates.min.js"></script>

<script>
$(document).ready(function () {
    $("#myTable").DataTable({
        dom: "Bfrtip",
        buttons:{
            dom: {
                button: {
                    className: 'btn'
                }
            },
            buttons: [
            {
                //definimos estilos del boton de excel
                extend: "excel",
                text:'Exportar a Excel',
                className:'btn btn-outline-success',

                // 1 - ejemplo básico - uso de templates pre-definidos
                //definimos los parametros al exportar a excel
                
                excelStyles: {                
                    //template: "header_blue",  // Apply the 'header_blue' template part (white font on a blue background in the header/footer)
                    //template:"green_medium" 
                    
                    "template": [
                        "blue_medium",
                        "header_green",
                        "title_medium"
                    ] 
                    
                },
                

                // 2 - estilos a una fila   
                /* 
                excelStyles: {                      // Add an excelStyles definition
                    cells: "2",                     // adonde se aplicaran los estilos (fila 2)
                    style: {                        // The style block
                        font: {                     // Style the font
                            name: "Arial",          // Font name
                            size: "14",             // Font size
                            color: "FFFFFF",        // Font Color
                            b: true,               // negrita SI
                        },
                        fill: {                     // Estilo de relleno (background)
                            pattern: {              // tipo de rellero (pattern or gradient)
                                color: "ff7961",    // color de fondo de la fila
                            }
                        }
                    }
                },
                */

                // 3 - uso de condiciones
                /*
                 excelStyles: {
                    cells: 'sD', //(s) de Smart - Referencia de celda inteligente, todas las filas de datos en la columna D (en este caso Edad)
                    condition: {                    // Add the style conditionally
                        type: 'cellIs',             // Using the cellIs type
                        operator: 'between',        // Operator a usar "Entre"
                        formula: [35,50],    // arreglo de valores requeridos para el operador 'entre' (edades entre 35 y 50 años son pintadas)
                    },
                    style: {
                        font: {
                            b: true,                // Make the font bold
                        },
                        fill: {                     // Style the cell fill (background)
                            pattern: {              // Type of fill (pattern or gradient)
                                bgColor: 'e8f401',  // Fill color (be aware of the Excel gotcha that conditonal fills                                
                            }
                        }
                    }
                }
                */

                // 4 - Reemplazar o insertar celdas, columnas y filas

                // 4.1 - Añadir columnas
                /*
                insertCells: [                  // Agregar una opción de configuración insertCells
                    {
                        cells: 'sCh',               // la "s" de Smart, "C" es la columna y "h" se refiere al header,
                        content: 'Nueva columna C',    // nombre del encabezado de la columna que insertamos
                        pushCol: true,              // pushCol hace que se inserte la columna
                    },
                    {
                        cells: 'sC1:C-0',           // Target the data
                        content: 'C',                // Add empty content
                        pushCol: true               // empuja las columnas a la derecha para insertar el nuevo contenido
                    }                    
               ],
                excelStyles: {
                    template: 'cyan_medium',    // Add a template to the result
                }
                */

                // 4.2 - Insertar filas
                /*
                insertCells: [                  // Agregar una opción de configuración insertCells                   
                    {
                        cells: 's5:6',              // Inserta los datos en las filas 5 y 6 contando desde el encabezado
                        content: 'Celdas nuevas',   // contenido a insertar
                        pushRow: true               // empuja las filas hacia abajo para insertar el contenido                    
                    },
                    {
                        cells: 'B3',                // Celda B3
                        content: 'Esta es la celda B3', // Simplemente sobreescribimos su contenido                                                    
                    }
               ],
                excelStyles: {
                    template: 'cyan_medium',    // Add a template to the result
                }
                */


            // ejemplo para IMPRIMIR
            /*
            pageStyle: {
                sheetPr: {
                    pageSetUpPr: {
                        fitToPage: 1            // Fit the printing to the page
                    } 
                },
                printOptions: {
                    horizontalCentered: true,
                    verticalCentered: true,
                },
                pageSetup: {
                    orientation: "landscape",   // Orientacion
                    paperSize: "9",             // Tamaño del papel (1 = Legal, 9 = A4)
                    fitToWidth: "1",            // Ajustar al ancho de la página
                    fitToHeight: "0",           // Ajustar al alto de la página
                },
                pageMargins: {
                    left: "0.2",
                    right: "0.2",
                    top: "0.4",
                    bottom: "0.4",
                    header: "0",
                    footer: "0",
                },
                repeatHeading: true,    // Repeat the heading row at the top of each page
                repeatCol: 'A:A',       // Repeat column A (for pages wider than a single printed page)
            },
            excelStyles: {
                template: 'blue_gray_medium',    // Add a template style as well if you like
            }
            */    

            }
            ]            
        }            
    });
});
    </script>



<script type="text/javascript" src="main.js"></script>
</body>
</html>