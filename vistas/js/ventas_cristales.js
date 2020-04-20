
$("#tasadeldia").change(function(){
	
var resultado = $('#tasadeldia').val()

 $('#tasadia').val(resultado);



	dolarcambio();

	falta_bolivares();

});





$("#tasadeldiaeditar").change(function(){
	
	var resultado = $('#tasadeldiaeditar').val()
	
	 $('#tasadiae').val(resultado);
	
	
	
		dolarcambio();
	
		falta_bolivares();
	
	});
	


$(document).ready(function() {
    $('.single').select2();
});
/*=============================================
QUITAR Cristales DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarCristal = [];

localStorage.removeItem("quitarCristal");

$(".formularioVenta").on("click", "button.quitarCristal", function(){
	falta_bolivares();

	$(this).parent().parent().parent().parent().remove();

	var idCristal = $(this).attr("idCristal");

	/*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL CRISTAL A QUITAR
	=============================================*/

	if(localStorage.getItem("quitarCristal") == null){

		idQuitarCristal = [];
	
	}else{

		idQuitarCristal.concat(localStorage.getItem("quitarCristal"))

	}

	idQuitarCristal.push({"idCristal":idCristal});

	localStorage.setItem("quitarCristal", JSON.stringify(idQuitarCristal));

	$("button.recuperarBoton[idCristal='"+idCristal+"']").removeClass('btn-default');

	$("button.recuperarBoton[idCristal='"+idCristal+"']").addClass('btn-primary agregarCristal');

	if($(".nuevoCristal").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalVenta").val(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosCristal()

    	// AGREGAR IMPUESTO
	        
     //   agregarImpuestoCristal()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarCristales()
		dolarcambio();
		falta_bolivares();
	}

})



/*=============================================
AGREGANDO CRISTALES DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numCristal = 0;

$(".btnAgregarCristal").click(function(){
	falta_bolivares();
	numCristal ++;

	var datos = new FormData();
	datos.append("traerCristales", "ok");

	$.ajax({

		url:"ajax/cristales.ajax.php",
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
      	    	$(".nuevoCristal").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del Cristal -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarCristal" idCristal><i class="fa fa-times"></i></button></span>'+

	              '<select class="single form-control nuevaDescripcionCristal" id="cristal'+numCristal+'" idCristal name="nuevaDescripcionCristal" required>'+

	              '<option>Seleccione el Cristal</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del Cristal -->'+

	          '<div class="col-xs-3 ingresoCantidadCristal">'+
	            
	             '<input type="number" class="form-control nuevaCantidadCristal" id="nuevaCantidadCristal" name="nuevaCantidadCristal" min="1" value="0" stockcristal nuevoStockCristal required>'+

	          '</div>' +

	          '<!-- Precio del CRISTAL -->'+

	          '<div class="col-xs-3 ingresoPrecioCristal" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioCristal" id="nuevoPrecioCristal" precioRealCristal="" name="nuevoPrecioCristal" readonly required>'+
	 
	            '</div>'+
	             
			  '</div>'+

		

			'</div>');
			

			falta_bolivares();

	        // AGREGAR LOS CRISTALES AL SELECT 
			
	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){
									//Verificar Variable Item
	         	if(item.stock != 0){

		         	$("#cristal"+numCristal).append(

						'<option idCristal="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
		         	)

		         
		         }	         

	         }

        	 // SUMAR TOTAL DE PRECIOS
			 falta_bolivares();
    		sumarTotalPreciosCristal()

    		// AGREGAR IMPUESTO
	        
	       // agregarImpuestoCristal()

	        // PONER FORMATO AL PRECIO DE LOS Cristales

			$(".nuevoPrecioCristal").number(true, 2);
			dolarcambio();
			falta_bolivares();


      	}

	})

})



/*=============================================
SELECCIONAR CRISTAL
=============================================*/

$(".formularioVenta").on("change", "select.nuevaDescripcionCristal", function(){
	falta_bolivares();

	var nombreCristal = $(this).val();

	var nuevaDescripcionCristal = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionCristal");

	var nuevoPrecioCristal = $(this).parent().parent().parent().children(".ingresoPrecioCristal").children().children(".nuevoPrecioCristal");

	var nuevaCantidadCristal = $(this).parent().parent().parent().children(".ingresoCantidadCristal").children(".nuevaCantidadCristal");
	var datos = new FormData();
    datos.append("nombreCristal", nombreCristal);


	  $.ajax({

     	url:"ajax/cristales.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
			falta_bolivares();
			   $(nuevaDescripcionCristal).attr("idCristal", respuesta["id"]);
			   //Verificar Stock
      	    $(nuevaCantidadCristal).attr("stockcristal", respuesta["stock"]);
      	    $(nuevaCantidadCristal).attr("nuevoStockcristal", Number(respuesta["stock"])-1);
      	    $(nuevoPrecioCristal).val(respuesta["precio_venta"]);
      	    $(nuevoPrecioCristal).attr("precioRealCristal", respuesta["precio_venta"]);

  	      // AGRUPAR CRISTALES EN FORMATO JSON

		   listarCristales();
		   dolarcambio();
		   falta_bolivares();

      	}

      })
})


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadCristal", function(){
	falta_bolivares();
	var preciocristal = $(this).parent().parent().children(".ingresoPrecioCristal").children().children(".nuevoPrecioCristal");

	var precioFinalCristal = $(this).val() * preciocristal.attr("precioRealCristal");
	
	preciocristal.val(precioFinalCristal);

	var nuevoStockCristal = Number($(this).attr("stockcristal")) - $(this).val();


	$(this).attr("nuevoStockCristal", nuevoStockCristal);

	if(Number($(this).val()) > Number($(this).attr("stockcristal"))){


		falta_bolivares();

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		$(this).val(0);

		$(this).attr("nuevoStockCristal", $(this).attr("stockcristal"));

		var precioFinalCristal = $(this).val() * preciocristal.attr("precioRealCristal");

		preciocristal.val(precioFinalCristal);

		sumarTotalPreciosCristal();
		dolarcambio();

		swal({
		  title: "La cantidad supera el Stock",
		  
	      text: "¡Sólo hay "+$(this).attr("stockcristal")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    return;

	}

	// SUMAR TOTAL DE PRECIOS
	falta_bolivares();

	sumarTotalPreciosCristal()



	// AGREGAR IMPUESTO
	        
  //  agregarImpuestoCristal()

    // AGRUPAR CRISTALES EN FORMATO JSON

	listarCristales()

	dolarcambio()
	falta_bolivares();

})



$("#nuevoImpuestoVentaCristal").change(function(){

	agregarImpuestoCristal();
	falta_bolivares();

});

$("#nuevoTotalVentaCristal").number(true, 2);



/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL CRISTAL YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarCristal(){
	falta_bolivares();

	var idCristales = $(".quitarCristal");

	var botonesTablaCristal = $(".tablaVentas tbody button.agregarCristal");

	for(var i = 0; i < idCristales.length; i++){

		var botoncristal = $(idCristales[i]).attr("idCristal");
		
		for(var j = 0; j < botonesTablaCristal.length; j ++){

			if($(botonesTablaCristal[j]).attr("idCristal") == boton){

				$(botonesTablaCristal[j]).removeClass("btn-primary agregarCristal");
				$(botonesTablaCristal[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){
	falta_bolivares();

	quitarAgregarCristal();

})




function listarCristales(){
	falta_bolivares();

	var listaCristales = [];

	var descripcioncristal = $(".nuevaDescripcionCristal");

	var cantidadcristal = $(".nuevaCantidadCristal");

	var preciocristal = $(".nuevoPrecioCristal");

	var preciocristalbolivar = $(".nuevoPrecioCristalBolivar");


	for(var i = 0; i < descripcioncristal.length; i++){

		listaCristales.push({ "id" : $(descripcioncristal[i]).attr("idCristal"), 
							  "descripcion" : $(descripcioncristal[i]).val(),
							  "cantidad" : $(cantidadcristal[i]).val(),
							  "stock" : $(cantidadcristal[i]).attr("nuevoStockCristal"),
							  "precio" : $(preciocristal[i]).attr("precioRealCristal"),
							  "total" : $(preciocristal[i]).val(),
							})

	}

	$("#listaCristales").val(JSON.stringify(listaCristales)); 

}




$(".btnLaboratorioExterno").click(function(){

	// console.log("Hola funciono");

	window.location = "pedidos";

})


$(".btnLaboratorioLocal").click(function(){

	// console.log("Hola funciono");

	window.location = "local";

})


function sumarTotalPreciosCristal(){
	falta_bolivares();

var precioItemCristal = $(".nuevoPrecioCristal");
	
	var arraySumaPrecioCristal = [];  

	for(var i = 0; i < precioItemCristal.length; i++){

		 arraySumaPrecioCristal.push(Number($(precioItemCristal[i]).val()));
		
		 
	}

	function sumaArrayPreciosCristal(total, numero){

		return total + numero;

	}

	var sumaTotalPreciosCristal = arraySumaPrecioCristal.reduce(sumaArrayPreciosCristal);
	
	$("#nuevoTotalVentaCristal").val(sumaTotalPreciosCristal);
	$("#totalVentaCristal").val(sumaTotalPreciosCristal);
	$("#nuevoTotalVentaCristal").attr("total",sumaTotalPreciosCristal);


	  //Almaceno los valores de los inputs
	  var primerValor = $('#nuevoTotalVenta').val();
	  var segundoValor = $('#nuevoTotalVentaCristal').val()

	  if(primerValor){
	
		var resultado = parseFloat(primerValor) + parseFloat(segundoValor);		

	 
	  //Muestro el resultado
	  $("#resultado").val(resultado);
	  $("#resultadoventa").val(resultado);	  
	}else{
		 //Muestro el resultado
		 $("#resultado").val(segundoValor);
		 $("#resultadoventa").val(segundoValor);	  
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






// $(function() {
// 	//Operaciones matemáticas
//   $('#calcular').click(function(e) {
// 	  e.preventDefault();
// 	  //Almaceno los valores de los inputs
// 	  var primerValor = $('#nuevoTotalVenta').val();
// 	  var segundoValor = $('#nuevoTotalVentaCristal').val()
	
// 		var resultado = parseFloat(primerValor) + parseFloat(segundoValor);		

	 
// 	  //Muestro el resultado
// 	  $("#resultado").val(resultado);
// 	  $("#resultadoventa").val(resultado);	  

//   });
// });


// $(".btnconvertir").click(function(){

// 	var primerValor = $('#resultadoventa').val();
// 	var segundoValor = $('#tasadeldia').val()

// 	var resultado = parseFloat(primerValor) * parseFloat(segundoValor);



// 	$('#resultadobo').val(resultado);
// 	$('#resultadobolivar').val(resultado);



// })



function dolarcambio(){	
	falta_bolivares();

	
	var  segundoValor = $('#resultadoventa').val();
	var  primerValor = $('#tasadeldia').val()

	var resultado = parseFloat(primerValor) * parseFloat(segundoValor);



	$('#resultadobo').val(resultado);
	$('#resultadobolivar').val(resultado);

	falta_bolivares();

	}
	






	function Totalenbolivareseditar(){	
		
		var primerValor = $('#nuevoTotalVenta').val();

		var segundoValor = $('#tasadeldiaeditar').val()


		var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
	
	
	
		 $('#resultadoeditarb').val(resultado);
		$('#resultadobolivareditar').val(resultado);
	
	
		}
	

		function Faltaenbolivareseditar(){	
		
			var primerValor = $('#falta_por_dolares_2').val();
	
			var segundoValor = $('#tasadeldiaeditar').val()
	
	
			var resultado = parseFloat(primerValor) * parseFloat(segundoValor);
		
		
		
			 $('#faltab').val(resultado);
			$('#falta_por_pagar_b').val(resultado);
		
		
			}



	$("#tasadeldiaeditar").change(function(){
		Totalenbolivareseditar();
		Faltaenbolivareseditar();

		

	});


















	
