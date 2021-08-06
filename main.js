

function buscar_datos(nomVisitante,docVisitante,nomInstitucion,nomVisitado,oficina,desde,hasta){
	$.ajax({
		url: 'index.php' ,
		type: 'POST' ,
		dataType: 'html',
		data: {nomVisitante: nomVisitante,
            docVisitante: docVisitante,
            nomInstitucion:nomInstitucion,
			nomVisitado: nomVisitado,
			oficina: oficina,
			desde:desde,
			hasta:hasta
        },
	})
	.done(function(respuesta){
		$("#datos").html(respuesta);
	})
	.fail(function(){
		console.log("error");
	});
}

function miFunc() {
	var nomVisitante = document.getElementById("nomVisitante").value;
    var docVisitante = document.getElementById("docVisitante").value;
    var nomInstitucion =document.getElementById("nomInstitucion").value;

    var nomVisitado = document.getElementById("nomVisitado").value;
    var oficina = document.getElementById("oficina").value;

	var desde=document.getElementById("desde").value;
	var hasta=document.getElementById("hasta").value;
	if (nomVisitante != "" || docVisitante!="" || nomInstitucion!=""||nomVisitado!="" || oficina !=""||desde!=""||hasta!="") {
		buscar_datos(nomVisitante,docVisitante,nomInstitucion,nomVisitado,oficina,desde,hasta);
	}else{
		buscar_datos();
	}
}

