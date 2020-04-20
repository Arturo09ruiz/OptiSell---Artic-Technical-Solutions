
/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/



var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarProducto") == null){

		idQuitarProducto = [];
	
	}else{

		idQuitarProducto.concat(localStorage.getItem("quitarProducto"))

	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS
    	sumarTotalPrecios()

    	// AGREGAR IMPUESTO
	        

        // AGRUPAR PRODUCTOS EN FORMATO JSON

		listarProductos()
		dolarcambio();
		falta_bolivares();

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function(){


	numProducto ++;

	var datos = new FormData();
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
			$(document).ready(function() {
				$('.single').select2();
			});
      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="single nuevaDescripcionProducto form-control" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" id="nuevoPrecioProducto" name="nuevoPrecioProducto" readonly required>'+
	 
				'</div>'+
	             
			  '</div>'+
			  
			  '<input type="hidden" class="form-control tasadeldia"  id="tasadeldia" name="tasadeldia">'+
				
	             
	          '</div>'+

			'</div>');
			

	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){

	         	if(item.stock != 0){

		         	$("#producto"+numProducto).append(

						'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)
		         
		         }	         

	         }

        	 // SUMAR TOTAL DE PRECIOS

    		sumarTotalPrecios()
			falta_bolivares();
	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
	        $(".nuevoPrecioProducto").number(true, 2);

			dolarcambio();

      	}

	})

})



/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionProducto", function(){

	var tasa = $('#tasadia').val();
	$('#tasadeldia').val(tasa);

	var nombreProducto = $(this).val();

	var nuevaDescripcionProducto = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProducto");
	var tasadeldia = $(this).parent().parent().parent().children().children().children(".tasadeldia");


	var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var nuevaCantidadProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProducto");
	
	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	     $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProducto).attr("nuevoStock", Number(respuesta["stock"])-1);
			  $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
			  $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductos()
			dolarcambio();
			falta_bolivares();
      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

	var precioFinal = $(this).val() * precio.attr("precioReal");
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);

		$(this).attr("nuevoStock", $(this).attr("stock"));

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPrecios();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPrecios()

	
    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos()
	dolarcambio();
	falta_bolivares();
})






// $(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

// 	var primerValor = $('#tasadeldia').val();
// 				var segundoValor = $('#nuevoPrecioProducto').val();
// 				var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
// 				$('#nuevoPrecioProductoBolivar').val(resultado);
// 				$("#nuevoPrecioProductoBolivar").number(true, 2);
// 				alert("ufn");

// })




/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 2);
$("#nuevoTotalVentaCristal").number(true, 2);
$("#resultadoventa").number(true, 2);
$("#resultado").number(true, 2);
$("#tasadeldia").number(true, 2);
$("#resultadobolivar").number(true, 2);
$("#falta_por_pagar").number(true, 2);
$("#falta_por_dolares").number(true, 2);
$("#falta_por_dol").number(true, 2);
$("#tasadeldiaeditar").number(true, 2);
$("#resultadobolivareditar").number(true, 2);
$("#falta_por_dolares_2").number(true, 2);

$("#falta_por_pagar_b").number(true, 2);




falta_bolivares();



/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

// $("#nuevoMetodoPago").change(function(){
// 	falta_bolivares();
// 	var metodo = $(this).val();

// 	if(metodo == "Efectivo"){
// 		falta_bolivares();

// 		$(this).parent().parent().removeClass("col-xs-6");

// 		$(this).parent().parent().addClass("col-xs-4");

// 		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

// 			 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 

// 			 	'<div class="input-group">'+ 

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

// 					 '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+

// 			 	'</div>'+

// 			 '</div>'

// 		 )

// 		 $("#cuanto").change(function(){

// 			falta_bolivares();
// 			falta_dolares();
// 			dentro_dolares();

		
// 		});
		
// 		 falta_bolivares();
// 		// Agregar formato al precio

// 		$('#cuanto').number( true, 2);

//       	// Listar método en la entrada
//       	listarMetodos()
// 		  dolarcambio();
// 		  falta_bolivares();

// 	}else{
// 		if(metodo == "TC","TD","TRANS","PM"){
// 		falta_bolivares();
// 		$(this).parent().parent().removeClass('col-xs-4');
// 		falta_bolivares();
// 		$(this).parent().parent().addClass('col-xs-6');
// 		falta_bolivares();
// 		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

// 		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
//                 '<div class="input-group">'+
                     
//                   '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
//                   '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
//                 '</div>'+

//               '</div>')
// 			  falta_bolivares();
// 		}else{
			
// 		}if(metodo == "Divisas"){


// 			$(this).parent().parent().removeClass("col-xs-6");

// 			$(this).parent().parent().addClass("col-xs-4");
	
// 			$(this).parent().parent().parent().children(".cajasMetodoPago").html(
	
// 				 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 
	
// 					 '<div class="input-group">'+ 
	
// 						 '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
	
// 						 '<input type="text" class="form-control cuanto_divisas" id="cuanto_divisas" placeholder="Cuanto Pago?" required>'+
	
// 					 '</div>'+
	
// 				 '</div>'
	
// 			 )
// 			 $('#cuanto_divisas').number( true, 2);

// 			 $("#cuanto_divisas").change(function(){


// 				falta_dolares();
// 				dentro_bolivares();
	
			
// 			});


// 		}else{

// 		}

// 	}
	

// })



// $("#nuevoMetodoPago").change(function(){
// 	falta_bolivares();
// 	var metodo = $(this).val();

// 	if(metodo == "Efectivo"){
// 		falta_bolivares();

// 		$(this).parent().parent().removeClass("col-xs-6");

// 		$(this).parent().parent().addClass("col-xs-4");

// 		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

// 			 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 

// 			 	'<div class="input-group">'+ 

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

// 					 '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+

// 			 	'</div>'+

// 			 '</div>'

// 		 )

// 		 $("#cuanto").change(function(){

// 			falta_bolivares();
// 			falta_dolares();
// 			dentro_dolares();

		
// 		});
		
// 		 falta_bolivares();
// 		// Agregar formato al precio

// 		$('#cuanto').number( true, 2);

//       	// Listar método en la entrada
//       	listarMetodos()
// 		  dolarcambio();
// 		  falta_bolivares();

// 	}else if(metodo == "TC","TD","TRANS","PM"){
// 		falta_bolivares();
// 		$(this).parent().parent().removeClass('col-xs-4');
// 		falta_bolivares();
// 		$(this).parent().parent().addClass('col-xs-6');
// 		falta_bolivares();
// 		 $(this).parent().parent().parent().children('.cajasMetodoPago').html(

// 		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
//                 '<div class="input-group">'+
                     
//                   '<input type="number" min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
                       
//                   '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
//                 '</div>'+

//               '</div>')
// 			  falta_bolivares();
// 		}else if(metodo == "Divisas"){


// 			$(this).parent().parent().removeClass("col-xs-6");

// 			$(this).parent().parent().addClass("col-xs-4");
	
// 			$(this).parent().parent().parent().children(".cajasMetodoPago").html(
	
// 				 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 
	
// 					 '<div class="input-group">'+ 
	
// 						 '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
	
// 						 '<input type="text" class="form-control cuanto_divisas" id="cuanto_divisas" placeholder="Cuanto Pago?" required>'+
	
// 					 '</div>'+
	
// 				 '</div>'
	
// 			 )
// 			 $('#cuanto_divisas').number( true, 2);

// 			 $("#cuanto_divisas").change(function(){


// 				falta_dolares();
// 				dentro_bolivares();
	
			
// 			});


// 		}else{
// 			alert="Ingresa Algo";
// 		}

// 	}
	

// )


$("#nuevoMetodoPago").change(function(){
 	var metodo = $(this).val();

	 if(metodo == "Efectivo"){

		falta_bolivares();

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".cajasMetodoPago").html(

			 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

					 '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+

			 	'</div>'+

			 '</div>'

		 )

		 $("#cuanto").change(function(){

			falta_bolivares();
			falta_dolares();
			dentro_dolares();

		
		});
		
		 falta_bolivares();
		// Agregar formato al precio

		$('#cuanto').number( true, 2);

      	// Listar método en la entrada
      	listarMetodos()
		  dolarcambio();
		  falta_bolivares();


	 } else if(metodo == "Divisas"){
		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");
			
	
			$(this).parent().parent().parent().children(".cajasMetodoPago").html(
	
				 '<div style=" transform: translate(110px);" class="col-xs-6">'+ 
	
					 '<div class="input-group">'+ 
	
						 '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
	
						 '<input type="text" class="form-control cuanto_divisas" id="cuanto_divisas" placeholder="Cuanto Pago?" required>'+
	
					 '</div>'+
	
				 '</div>'
	
			 )

			 $('#cuanto_divisas').number( true, 2);

			 $("#cuanto_divisas").change(function(){


				falta_dolares();
				dentro_bolivares();
	
			
			});

			listarMetodos();


	 }else if(metodo == "TC","TD","TRANS","PM"){
		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");
			
	
		falta_bolivares();
				falta_bolivares();
				falta_bolivares();
				 $(this).parent().parent().parent().children('.cajasMetodoPago').html(
		
				 	'<div class="col-xs-8" style="padding-left:0px">'+
								
		                '<div class="input-group">'+
							 

						  '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+
						  
						  '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
												  
						  '<input min="0" class="form-control" id="nuevoCodigoTransaccion" placeholder="Código transacción"  required>'+
							   
		                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						  
						'</div>'+						
							 	                 						  							
					  '</div>')
					  $("#cuanto").change(function(){

						falta_bolivares();
						falta_dolares();
						dentro_dolares();
			
					
					});
					
					 falta_bolivares();
					// Agregar formato al precio
			
					$('#cuanto').number( true, 2);
			
					  // Listar método en la entrada
					  listarMetodos()
					  dolarcambio();
					  falta_bolivares();
			
					  falta_bolivares();
		

	 }





})







function listarMetodos(){

	var listaMetodos = "";

	if($("#nuevoMetodoPago").val() == "Efectivo"){

		$("#listaMetodoPago").val("Efectivo");

	}else if($("#nuevoMetodoPago").val() == "Divisas"){
		$("#listaMetodoPago").val("Divisas");

	}else {
		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
	}
		
	

}










function falta_bolivares(){

	//Obtengo los datos de los campos
	var primerValor = $('#resultadobolivar').val();
	var segundoValor = $('#cuanto').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_pagar').val(resultado);
	$('#falta').val(resultado);	
}



function falta_dolares(){
	//Obtengo los datos de los campos
	var primerValor = $('#resultadoventa').val();
	var segundoValor = $('#cuanto_divisas').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_dolares').val(resultado);
	$('#falta_por_dol').val(resultado);	
}

function dentro_bolivares(){
	//Obtengo los datos de los campos
	var primerValor = $('#tasadeldia').val();
	var segundoValor = $('#falta_por_dolares').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_pagar').val(resultado);
	$('#falta').val(resultado);	
}

function dentro_dolares(){
	//Obtengo los datos de los campos
	var primerValor = $('#falta_por_pagar').val();
	var segundoValor = $('#tasadeldia').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) / parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_dolares').val(resultado);
	$('#falta_por_dol').val(resultado);	
}






/*=============================================
CAMBIO EN EFECTIVO
// =============================================*/
// $(".formularioVenta").on("change", "input#nuevoValorEfectivo", function(){
// 	falta_bolivares();
// 	var efectivo = $(this).val();

// 	var cambio =  Number(efectivo) - Number($('#nuevoTotalVenta').val());

// 	var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

// 	nuevoCambioEfectivo.val(cambio);

// })

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){
	falta_bolivares();
	// Listar método en la entrada
     listarMetodos()


})


/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/


// function listarMetodos(){

// 	var listaMetodos = "";

// 	if($("#nuevoMetodoPago").val() == "Efectivo"){

// 		$("#listaMetodoPago").val("Efectivo");

// 	}else{
// 		$("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());
		
// 	}

// }




/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarVenta", function(){
	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;


})


$(".tablas").on("click", ".btnEditarVentaTercerPago", function(){
	var idVenta = $(this).attr("idVenta");

	window.location = "index.php?ruta=editar-venta-tercer-pago&idVenta="+idVenta;


})


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto(){
	falta_bolivares();

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){
	falta_bolivares();
	quitarAgregarProducto();

})


/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "ventas";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		// if(mes < 10){

		// 	var fechaInicial = año+"-0"+mes+"-"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-"+dia;

		// }else if(dia < 10){

		// 	var fechaInicial = año+"-"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-"+mes+"-0"+dia;

		// }else if(mes < 10 && dia < 10){

		// 	var fechaInicial = año+"-0"+mes+"-0"+dia;
		// 	var fechaFinal = año+"-0"+mes+"-0"+dia;

		// }else{

		// 	var fechaInicial = año+"-"+mes+"-"+dia;
	 //    	var fechaFinal = año+"-"+mes+"-"+dia;

		// }

		dia = ("0"+dia).slice(-2);
		mes = ("0"+mes).slice(-2);

		var fechaInicial = año+"-"+mes+"-"+dia;
		var fechaFinal = año+"-"+mes+"-"+dia;	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})




function listarProductos(){
	falta_bolivares();
	var listaProductos = [];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");
	var tasa = $(".tasadeldia");




	

	for(var i = 0; i < descripcion.length; i++){

		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val(),
							  "tasa" : $(tasa[i]).val(),

							})

	}
	falta_bolivares();

	$("#listaProductos").val(JSON.stringify(listaProductos)); 
	falta_bolivares();
}
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/




/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

// function agregarImpuesto(){

// 	var impuesto = $("#nuevoImpuestoVenta").val();
// 	var precioTotal = $("#nuevoTotalVenta").attr("total");

// 	var precioImpuesto = Number(precioTotal * impuesto/100);

// 	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
// 	$("#nuevoTotalVenta").val(totalConImpuesto);

// 	$("#totalVenta").val(totalConImpuesto);

// 	$("#nuevoPrecioImpuesto").val(precioImpuesto);

// 	$("#nuevoPrecioNeto").val(precioTotal);

// }

/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/

$(".abrirXML").click(function(){

	var archivo = $(this).attr("archivo");
	window.open(archivo, "_blank");


})

/*IMPRIMIR FACTURA*/

$(".tablas").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/factura-carta.php?codigo="+codigoVenta, "_blank");

})


// $(".tablas").on("click", ".btnImprimirApartado", function(){

// 	var codigoVenta = $(this).attr("codigoVenta");

// 	window.open("extensiones/tcpdf/pdf/apartado.php?codigo="+codigoVenta, "_blank");

// })
$(".tablas").on("click", ".btnImprimirApartado", function(){

	var codigoVenta = $(this).attr("codigoVenta");

	window.open("extensiones/tcpdf/pdf/apartado3.php?codigo="+codigoVenta, "_blank");

})

function sumarTotalPrecios(){

	var precioItem = $(".nuevoPrecioProducto");
	
	var arraySumaPrecio = [];  

	for(var i = 0; i < precioItem.length; i++){

		 arraySumaPrecio.push(Number($(precioItem[i]).val()));
		
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
	
	$("#nuevoTotalVenta").val(sumaTotalPrecio);
	$("#totalVenta").val(sumaTotalPrecio);
	$("#nuevoTotalVenta").attr("total",sumaTotalPrecio);


	  //Almaceno los valores de los inputs
	  var primerValor = $('#nuevoTotalVenta').val();

	  var segundoValor = $('#nuevoTotalVentaCristal').val()

	  var tercervalor = 0;


	if(segundoValor){
		var resultado = parseFloat(primerValor) + parseFloat(segundoValor);		

	 
		//Muestro el resultado
		$("#resultado").val(resultado);
		$("#resultadoventa").val(resultado);	  
  
	}else{		
	
		//Muestro el resultado
		$("#resultado").val(primerValor);
		$("#resultadoventa").val(primerValor);
	}
	
	
	

	var impuesto = $("#impuesto").val();

	var precioTotal = $("#resultadoventa").val();

	var precioImpuesto = Number(precioTotal * impuesto /100);

	var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
	
	$("#resultadoventa").val(totalConImpuesto);

	$("#resultado").val(totalConImpuesto);

	// $("#nuevoPrecioImpuesto").val(precioImpuesto);





	falta_bolivares();

}






$("#nuevoMetodoPago2").change(function(){
	var metodo = $(this).val();

	if(metodo == "Efectivo"){

	   falta_bolivares();

	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");

	   $(this).parent().parent().parent().children(".cajasMetodoPago2").html(

			'<div style=" transform: translate(110px);" class="col-xs-6">'+ 

				'<div class="input-group">'+ 

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

					'<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+

				'</div>'+

			'</div>'

		)

		$("#cuanto").change(function(){

		   falta_bolivares2();
		   dentro_dolares2();
		   


	   
	   });
	   
	   // Agregar formato al precio

	   $('#cuanto').number( true, 2);

		 // Listar método en la entrada
		 listarMetodos2()
		 dolarcambio();


	} else if(metodo == "Divisas"){
	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");
		   
   
		   $(this).parent().parent().parent().children(".cajasMetodoPago2").html(
   
				'<div style=" transform: translate(110px);" class="col-xs-6">'+ 
   
					'<div class="input-group">'+ 
   
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
   
						'<input type="text" class="form-control cuanto_divisas" id="cuanto_divisas" placeholder="Cuanto Pago?" required>'+
   
					'</div>'+
   
				'</div>'
   
			)

			$('#cuanto_divisas').number( true, 2);

			$("#cuanto_divisas").change(function(){


				falta_dolares2();
			   dentro_bolivares2();
   
		   
		   });

		   listarMetodos2();


	}else if(metodo == "TC","TD","TRANS","PM"){
	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");
		   
   
	   
				$(this).parent().parent().parent().children('.cajasMetodoPago2').html(
	   
					'<div class="col-xs-8" style="padding-left:0px">'+
							   
					   '<div class="input-group">'+
							

						 '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+
						 
						 '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
												 
						 '<input min="0" class="form-control nuevoCodigoTransaccion2 " id="nuevoCodigoTransaccion2" placeholder="Código transacción"  required>'+
							  
						 '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						 
					   '</div>'+						
																									   
					 '</div>')
					 $("#cuanto").change(function(){

					   falta_bolivares2();
					   falta_dolares2();
					   dentro_dolares2();
					   listarMetodos2()

				   
				   });
				   $("#nuevoCodigoTransaccion2").change(function(){

					listarMetodos2()

				
				});
				
				   // Agregar formato al precio
		   
				   $('#cuanto').number( true, 2);
		   
					 // Listar método en la entrada
					 listarMetodos2()
					 dolarcambio();
				
	   

	}





})







function listarMetodos2(){

   var listaMetodos = "";

   if($("#nuevoMetodoPago2").val() == "Efectivo"){

	   $("#listaMetodoPago2").val("Efectivo");

   }else if($("#nuevoMetodoPago2").val() == "Divisas"){
	   $("#listaMetodoPago2").val("Divisas");

   }else {
	
	   $("#listaMetodoPago2").val($("#nuevoMetodoPago2").val()+"-"+$("#nuevoCodigoTransaccion2").val());
	   var primerValor = $('#nuevoCodigoTransaccion2').val();
   }
	   
   

}










function falta_bolivares2(){

   //Obtengo los datos de los campos
   var primerValor = $('#falta_por_pagar_b').val();
   var segundoValor = $('#cuanto').val()
   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_pagar_b').val(resultado);
   $('#faltab').val(resultado);	
}



function falta_dolares2(){
	//Obtengo los datos de los campos
	var primerValor = $('#falta_por_dolares_2').val();
	var segundoValor = $('#cuanto_divisas').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_dolares_2').val(resultado);
	$('#falta_por_dol_2').val(resultado);	
 }
function dentro_bolivares2(){
   //Obtengo los datos de los campos
   var primerValor = $('#tasadeldiaeditar').val();
   var segundoValor = $('#falta_por_dolares_2').val()
   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_pagar_b').val(resultado);
   $('#faltab').val(resultado);	
}

function dentro_dolares2(){
   //Obtengo los datos de los campos
   var primerValor = $('#falta_por_pagar_b').val();
   var segundoValor = $('#tasadeldiaeditar').val();

   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) / parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_dolares_2').val(resultado);
   $('#falta_por_dol_2').val(resultado);	
}










$("#nuevoMetodoPago3").change(function(){
	var metodo = $(this).val();

	if(metodo == "Efectivo"){

	   falta_bolivares();

	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");

	   $(this).parent().parent().parent().children(".cajasMetodoPago3").html(

			'<div style=" transform: translate(110px);" class="col-xs-6">'+ 

				'<div class="input-group">'+ 

					'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

					'<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+

				'</div>'+

			'</div>'

		)

		$("#cuanto").change(function(){

		   falta_bolivares3();
		   dentro_dolares3();
		   


	   
	   });
	   
	   // Agregar formato al precio

	   $('#cuanto').number( true, 2);

		 // Listar método en la entrada
		 listarMetodos3()
		 dolarcambio();


	} else if(metodo == "Divisas"){
	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");
		   
   
		   $(this).parent().parent().parent().children(".cajasMetodoPago3").html(
   
				'<div style=" transform: translate(110px);" class="col-xs-6">'+ 
   
					'<div class="input-group">'+ 
   
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
   
						'<input type="text" class="form-control cuanto_divisas" id="cuanto_divisas" placeholder="Cuanto Pago?" required>'+
   
					'</div>'+
   
				'</div>'
   
			)

			$('#cuanto_divisas').number( true, 2);

			$("#cuanto_divisas").change(function(){


				falta_dolares3();
			   dentro_bolivares3();
   
		   
		   });

		   listarMetodos3();


	}else if(metodo == "TC","TD","TRANS","PM"){
	   $(this).parent().parent().removeClass("col-xs-6");

	   $(this).parent().parent().addClass("col-xs-4");
		   
   
	   
				$(this).parent().parent().parent().children('.cajasMetodoPago3').html(
	   
					'<div class="col-xs-8" style="padding-left:0px">'+
							   
					   '<div class="input-group">'+
							

						 '<input type="text" class="form-control cuanto" id="cuanto" placeholder="Cuanto Pago?" required>'+
						 
						 '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 
												 
						 '<input min="0" class="form-control nuevoCodigoTransaccion3 " id="nuevoCodigoTransaccion3" placeholder="Código transacción"  required>'+
							  
						 '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
						 
					   '</div>'+						
																									   
					 '</div>')
					 $("#cuanto").change(function(){

					   falta_bolivares3();
					   falta_dolares3();
					   dentro_dolares3();
					   listarMetodos3()

				   
				   });
				   $("#nuevoCodigoTransaccion3").change(function(){

					listarMetodos3()

				
				});
				
				   // Agregar formato al precio
		   
				   $('#cuanto').number( true, 2);
		   
					 // Listar método en la entrada
					 listarMetodos3()
					 dolarcambio();
				
	   

	}





})







function listarMetodos3(){

   var listaMetodos = "";

   if($("#nuevoMetodoPago3").val() == "Efectivo"){

	   $("#listaMetodoPago3").val("Efectivo");

   }else if($("#nuevoMetodoPago3").val() == "Divisas"){
	   $("#listaMetodoPago3").val("Divisas");

   }else {
	var primerValor = $('#nuevoCodigoTransaccion3').val();

	   $("#listaMetodoPago3").val($("#nuevoMetodoPago3").val()+"-"+$("#nuevoCodigoTransaccion3").val());
   }
	   
   

}










function falta_bolivares3(){

   //Obtengo los datos de los campos
   var primerValor = $('#falta_por_pagar_b').val();
   var segundoValor = $('#cuanto').val()
   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_pagar_b').val(resultado);
   $('#faltab').val(resultado);	
}



function falta_dolares3(){
	//Obtengo los datos de los campos
	var primerValor = $('#falta_por_dolares_2').val();
	var segundoValor = $('#cuanto_divisas').val()
	// Convierto los datos a valores numericos para no concatenar y Realizo la resta
	var resultado = parseFloat(primerValor) - parseFloat(segundoValor);
	
	//Muestro el resultado en los campos
	$('#falta_por_dolares_2').val(resultado);
	$('#falta_por_dol_2').val(resultado);	
 }
function dentro_bolivares3(){
   //Obtengo los datos de los campos
   var primerValor = $('#tasadeldiaeditar').val();
   var segundoValor = $('#falta_por_dolares_2').val()
   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_pagar_b').val(resultado);
   $('#faltab').val(resultado);	
}

function dentro_dolares3(){
   //Obtengo los datos de los campos
   var primerValor = $('#falta_por_pagar_b').val();
   var segundoValor = $('#tasadeldiaeditar').val();

   // Convierto los datos a valores numericos para no concatenar y Realizo la resta
   var resultado = parseFloat(primerValor) / parseFloat(segundoValor);
   
   //Muestro el resultado en los campos
   $('#falta_por_dolares_2').val(resultado);
   $('#falta_por_dol_2').val(resultado);	
}


function ocultar(){
	document.getElementById('mostrarOcultar').style.display="none";
}
function mostrar(){
	document.getElementById('mostrarOcultar').style.display="block";

}

function mostrar3(){
	document.getElementById('mostrarOcultar3').style.display="block";

}

function ocultar3(){
	document.getElementById('mostrarOcultar3').style.display="none";
}











