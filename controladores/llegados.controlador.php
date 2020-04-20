<?php

class Controladorllegados{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarllegados($item, $valor, $orden){

		$tabla = "llegados";

		$respuesta = Modelollegados::mdlMostrarllegados($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDO
	=============================================*/

	static public function ctrCrearllegados(){

		if(isset($_POST["descripcion_terminado"])){

				$tabla = "llegados";

				$datos = array(
							   "aumento_cristal" => $_POST["medida_terminado"],
							   "tipo_cristal" => $_POST["tipo_terminado"],
							   "codigo" => $_POST["codigo_terminado"],
							   "lugar" => $_POST["lugar_terminado"],
							   "descripcion" => $_POST["descripcion_terminado"],
							   "stock" => $_POST["stock_terminado"],
							   "precio_compra" => $_POST["precio_de_compra_terminado"],
							   "precio_venta" => $_POST["precio_de_venta_terminado"],
							   "fecha_terminado" => $_POST["fecha_terminado"],

							);

				$respuesta = Modelollegados::mdlIngresarllegados($tabla, $datos);

				if($respuesta == "ok"){
					echo'RECARGAR 
					<script>
					swal({
						type: "success",
						title: "¡El Pedido Ha Llegado Correctamente!",
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


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "llegados";

							}
						})

			  	</script>';
			}
		}

	}


	/*=============================================
	EDITAR PEDIDOS
	=============================================*/

	static public function ctrEditarllegados(){

		if(isset($_POST["editarDescripcion"])){

	
				$tabla = "llegados";

				$datos = array(
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   );

				$respuesta = Modelollegados::mdlEditarllegados($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "llegados";

										}
									})

						</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Pedido no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "llegados";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarllegados(){

		if(isset($_GET["idllegados"])){

			$tabla ="llegados";
			$datos = $_GET["idllegados"];

			
			$respuesta = Modelollegados::mdlEliminarllegados($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "llegados";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentasllegados(){

		$tabla = "llegados";

		$respuesta = Modelollegados::mdlMostrarSumaVentasllegados($tabla);

		return $respuesta;

	}


}