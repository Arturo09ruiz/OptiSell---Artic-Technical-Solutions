
$(".tablas").on("click", ".btnImprimirlaboratorio", function(){

	var codigo = $(this).attr("codigo");

	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigo, "_blank");

})






/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});


$.ajax({

	url: "ajax/datatable-llegados.ajax.php",
	success:function(respuesta){
		
		console.log("Estoy Funcionando", respuesta);

	}

})

var perfilOculto = $("#perfilOculto").val();

$('.tablallegados').DataTable( {
    "ajax": "ajax/datatable-llegados.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

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
$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(".nuevoPorcentaje").val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(this).val();
		
		var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

		var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());

		$("#nuevoPrecioVenta").val(porcentaje);
		$("#nuevoPrecioVenta").prop("readonly",true);

		$("#editarPrecioVenta").val(editarPorcentaje);
		$("#editarPrecioVenta").prop("readonly",true);

	}

})

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})


/*EDITAR*/
$(".tablallegados tbody").on("click", "button.btnEditarllegados", function(){

	var idllegados = $(this).attr("idllegados");
	
	var datos = new FormData();
    datos.append("idllegados", idllegados);

     $.ajax({

      url:"ajax/llegados.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datoslista = new FormData();
          datoslista.append("tipo",respuesta["tipo_cristal"]);

           $.ajax({

              url:"ajax/tipo.ajax.php",
              method: "POST",
              data: datoslista,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
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
/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablallegados tbody").on("click", "button.btnEliminarllegados", function(){

	var idllegados = $(this).attr("idllegados");
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
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=llegados&idllegados="+idllegados+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})
	


$(".tablallegados tbody").on("click", "button.btn_llegados", function () {
	var datos = new FormData();
	datos.append("idllegados", idllegados);
	
	var idllegados = $(this).attr("idllegados");
	var lugar = $(this).attr("lugar");
	var codigo = $(this).attr("codigo");
	var tipo = $(this).attr("tipo");
	var medida = $(this).attr("medida");
	var descripcion = $(this).attr("descripcion");
	var stock = $(this).attr("stock");
	var precio_compra = $(this).attr("precio_compra");
	var precio_venta = $(this).attr("precio_venta");
	var fecha = $(this).attr("fecha");
	var fechaterminado = $(this).attr("fecha_terminado");

	var fecha_de_terminado = new Date();

	// Variables para delcarar la fecha en JS
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth() + 1;
	var yyyy = hoy.getFullYear();
	hoy = dd + '/' + mm + '/' + yyyy;



	// Traer Datos a los Inputs
	document.getElementById("lugar_entregado").value = lugar;
	document.getElementById("codigo_entregado").value = codigo;
	document.getElementById("tipo_entregado").value = tipo;
	document.getElementById("medida_entregado").value = medida;
	document.getElementById("descripcion_entregado").value = descripcion;
	document.getElementById("stock_entregado").value = stock;
	document.getElementById("precio_de_compra_entregado").value = precio_compra;
	document.getElementById("precio_de_venta_entregado").value = precio_venta;
	document.getElementById("fecha_entregado").value = fecha;
	document.getElementById("fecha_pedido_entregado").value = fechaterminado;


		swal({

			title: 'El Pedido fue Entregado?',
			text: "¡Si no lo está puede cancelar la accíón!",
			type: 'success',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			confirmButtonText: 'Si, El Pedido Ha Sido Entregado!'
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
								url: "ajax/prueba-llegados.ajax.php",
								data:'idllegados=' + idllegados ,
								dataType:"html",
								asycn:false, //el error que cometí de sintaxis, es async
									success: function (respuesta) {
									 document.forms["prueba-llegados"].submit();
				
							
						}
				
			
				})
			


				
	
	


		


				// window.location = "index.php?ruta=local&idlocal=" + idlocal;








			

			}});


		})