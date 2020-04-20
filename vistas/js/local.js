
$(".tablas").on("click", ".btnImprimirlaboratorio", function () {

	var codigo = $(this).attr("codigo");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo=" + codigo, "_blank");

})






/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
jQuery(document).ready(function ($) {
	$(document).ready(function () {
		$('.mi-selector').select2();
	});
});


$.ajax({

	url: "ajax/datatable-local.ajax.php",
	success: function (respuesta) {

		console.log("Estoy Funcionando", respuesta);

	}

})

var perfilOculto = $("#perfilOculto").val();

$('.tablalocal').DataTable({
	"ajax": "ajax/datatable-local.ajax.php?perfilOculto=" + perfilOculto,
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================*/
// $("#nuevaCategoria").change(function(){

// 	var idCategoria = $(this).val();

// 	var datos = new FormData();
//   	datos.append("idCategoria", idCategoria);

//   	$.ajax({

//       url:"ajax/productos.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){

//       	if(!respuesta){

//       		var nuevoCodigo = idCategoria+"01";
//       		$("#nuevoCodigo").val(nuevoCodigo);

//       	}else{

//       		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
//           	$("#nuevoCodigo").val(nuevoCodigo);

//       	}

//       }

//   	})

// })

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function () {

	if ($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var porcentaje = Number(($("#nuevoPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly", true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function () {

	if ($(".porcentaje").prop("checked")) {

		var valorPorcentaje = $(this).val();

		var porcentaje = Number(($("#nuevoPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje / 100)) + Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly", true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly", true);

	}

})

$(".porcentaje").on("ifUnchecked", function () {

	$("#nuevoPrecioVenta").prop("readonly", false);
	$("#editarPrecioVenta").prop("readonly", false);

})

$(".porcentaje").on("ifChecked", function () {

	$("#nuevoPrecioVenta").prop("readonly", true);
	$("#editarPrecioVenta").prop("readonly", true);

})






/*EDITAR*/
$(".tablalocal tbody").on("click", "button.btnEditarlocal", function () {

	var idlocal = $(this).attr("idlocal");

	var datos = new FormData();
	datos.append("idlocal", idlocal);

	$.ajax({

		url: "ajax/local.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {

			var datoslista = new FormData();
			datoslista.append("tipo", respuesta["tipo_cristal"]);

			$.ajax({

				url: "ajax/tipo.ajax.php",
				method: "POST",
				data: datoslista,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function (respuesta) {

					$("#editarlista").val(respuesta["id"]);
					$("#editarlista").html(respuesta["idlista"]);

				}

			})

			$("#editarCodigo").val(respuesta["codigo"]);

			$("#editarDescripcion").val(respuesta["descripcion"]);

			$("#editarStock").val(respuesta["stock"]);

			$("#editarPrecioCompra").val(respuesta["precio_compra"]);

			$("#editarPrecioVenta").val(respuesta["precio_venta"]);





		}

	})

})





$(".tablalocal tbody").on("click", "button.btn_terminado", function () {
	var datos = new FormData();
	datos.append("idlocal", idlocal);
	
	var idlocal = $(this).attr("idlocal");
	var codigo = $(this).attr("codigo");
	var tipo = $(this).attr("tipo");
	var medida = $(this).attr("medida");
	var descripcion = $(this).attr("descripcion");
	var stock = $(this).attr("stock");
	var precio_compra = $(this).attr("precio_compra");
	var precio_venta = $(this).attr("precio_venta");
	var fecha = $(this).attr("fecha");
	var fecha_de_terminado = new Date();

	// Variables para delcarar la fecha en JS
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth() + 1;
	var yyyy = hoy.getFullYear();
	hoy = dd + '/' + mm + '/' + yyyy;



	// Traer Datos a los Inputs
	document.getElementById("codigo_terminado").value = codigo;
	document.getElementById("tipo_terminado").value = tipo;
	document.getElementById("medida_terminado").value = medida;
	document.getElementById("descripcion_terminado").value = descripcion;
	document.getElementById("stock_terminado").value = stock;
	document.getElementById("precio_de_compra_terminado").value = precio_compra;
	document.getElementById("precio_de_venta_terminado").value = precio_venta;
	document.getElementById("fecha_terminado").value = fecha;
	document.getElementById("fecha_de_terminado").value = hoy;


		swal({

			title: 'Pedido Terminado',
			text: "¡Si no lo está puede cancelar la accíón!",
			type: 'success',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, El Pedido Esta Terminado!'
		}).then(function (result) {
			if (result.value) {

				$.ajax({
					// url: "ajax/prueba.ajax.php",
					// method: "POST",
					// data: datos,
					// cache: false,
					// contentType: false,
					// processData: false,
					 // dataType: "json",
				
				
						type: "POST",
								url: "ajax/prueba.ajax.php",
								data:'idlocal=' + idlocal ,
								dataType:"html",
								asycn:false, //el error que cometí de sintaxis, es async
									success: function (respuesta) {
									 document.forms["prueba"].submit();
				
							
						}
				
			
				})
			


				
	
	


		


				// window.location = "index.php?ruta=local&idlocal=" + idlocal;








			

			}});













	





	//         //    $.ajax({

	// 		// 	url: "ajax/insertar_pedido.php",
	// 		// 	method: "POST",
	// 		// 	data: datos,
	// 		// 	cache: false,
	// 		// 	contentType: false,
	// 		// 	processData: false,
	// 		// 	dataType: "json",
	// 		// 	success: function () {

	// 		// 		alert('Hola');

	// 		// 	}})



	// 			// console.log(datos[8]);












	// // var datos = new FormData();
	// // datos.append("idlocal", idlocal);


	// //     $.each(datos, function (i, item) {
	// // 		// console.log(datos[i].codigo + " - " + datos[i].tipo);
	// // 		console.log()
	// //     })


















	// 		}


	// 	})
	// $("#button.btn_terminado").removeClass("btn-primary");
	// $("#button.btn_terminado").addClass("btn-success");
	// var tableX = $('.tablalocal tbody').DataTable();
	// btn_terminado.css('background', 'lightyellow');

})

// tablalocal = $('.tablalocal tbody').DataTable({
// 			"pageLength": 25, //number of rows to display per page
// 			"searching": true,
// 			"order": [0, "asc"],
// 			"paging": true,
// 			"info": true,
// 			"dom": "Bfrtip",
// 			"buttons": [{
// 						"text": "A",
// 						"action": function (e, dt, node, config) {
// 							regExSearch = '^' + 'A';
// 							dt.column(0).search(regExSearch, true, false).draw();
// 						}
// 					},
// 					{
// 						"text": "B",
// 						"action": function (e, dt, node, config) {
// 							regExSearch = '^' + 'B';
// 							dt.column(0).search(regExSearch, true, false).draw();
// 						}
// 					}],
// });
/*=============================================
ELIMINAR PRODUCTO
=============================================*/
$(".tablalocal tbody").on("click", "button.btnEliminarlocal", function () {

	var idlocal = $(this).attr("idlocal");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");

	swal({

		title: '¿Está seguro de borrar el Pedido?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar Pedido!'
	}).then(function (result) {
		if (result.value) {

			window.location = "index.php?ruta=local&idlocal=" + idlocal + "&imagen=" + imagen + "&codigo=" + codigo;

		}


	})

})

