
$(".tablas").on("click", ".btnEliminarLaboratorio", function(){

	 var idLaboratorio = $(this).attr("idLaboratorio");

	 swal({
	 	title: '¿Está seguro de borrar El Laboratorio?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Laboratorio!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=ingresarlaboratorios&idLaboratorio="+idLaboratorio;

	 	}

	 })

})