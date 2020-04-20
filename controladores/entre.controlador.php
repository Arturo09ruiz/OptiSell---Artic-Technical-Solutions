<?php

class Controladorentre{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarentre($item, $valor, $orden){

		$tabla = "entre";

		$respuesta = Modeloentre::mdlMostrarentre($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDO
	=============================================*/

	static public function ctrCrearentre(){

		if(isset($_POST["descripcion_entregado"])){

			if(preg_match('/^[a-zA-Z-,-0-9ñÑáéíóúÁÉ+,-ÍÓÚ ]+$/', $_POST["descripcion_entregado"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["precio_de_venta_entregado"])){

				$tabla = "entre";

				$datos = array(
	    					   "lugar" => $_POST["lugar_entregado"],
							   "aumento_cristal" => $_POST["medida_entregado"],
							   "tipo_cristal" => $_POST["tipo_entregado"],
							   "codigo" => $_POST["codigo_entregado"],
							   "descripcion" => $_POST["descripcion_entregado"],
							   "stock" => $_POST["stock_entregado"],
							   "precio_compra" => $_POST["precio_de_compra_entregado"],
							   "precio_venta" => $_POST["precio_de_venta_entregado"],
                               "fecha_entregado" => $_POST["fecha_entregado"],
							   "fecha_pedido_entregado" => $_POST["fecha_pedido_entregado"]                          
							);

				$respuesta = Modeloentre::mdlIngresarentre($tabla, $datos);

				if($respuesta == "ok"){
					echo'RECARGAR 
					<script>
					swal({
						type: "success",
						title: "¡El Pedido Ha Sido Entregado Correctamente!",
						text: "¡Seras Redireccionado Al Inicio Del Sistema!",
						showConfirmButton: true,
						confirmButtonText: "OK"
						}).then(function(result){
						  if (result.value) {

						  window.location = "inicio";

						  }
					  })

					
					
					
					</script>
					';
					
				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "entre";

							}
						})

			  	</script>';
			}
		}

	}


	/*=============================================
	EDITAR PEDIDOS
	=============================================*/

	static public function ctrEditarentre(){

		if(isset($_POST["editarDescripcion"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

		   		

				$tabla = "entre";

				$datos = array(
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   );

				$respuesta = Modeloentre::mdlEditarentre($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "entre";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "entre";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarentre(){

		if(isset($_GET["identre"])){

			$tabla ="entre";
			$datos = $_GET["identre"];

			
			$respuesta = Modeloentre::mdlEliminarentre($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "entre";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentasentre(){

		$tabla = "entre";

		$respuesta = Modeloentre::mdlMostrarSumaVentasentre($tabla);

		return $respuesta;

	}


}