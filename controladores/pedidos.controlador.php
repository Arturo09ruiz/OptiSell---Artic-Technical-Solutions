<?php

class Controladorpedidos{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarpedidos($item, $valor, $orden){

		$tabla = "pedidos";

		$respuesta = Modelopedidos::mdlMostrarpedidos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDO
	=============================================*/

	static public function ctrCrearpedidos(){

		if(isset($_POST["nuevaDescripcion"])){

				$tabla = "pedidos";

				$datos = array(
							   "codigo" => $_POST["nuevoCodigo"],
							   "aumento_cristal" => $_POST["nuevoMedida"],
							   "tipo_cristal" => $_POST["nuevoTipo"],
							   "lugar" => $_POST["nuevoLugar"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],);

				$respuesta = Modelopedidos::mdlIngresarpedidos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "pedidos";

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

							window.location = "pedidos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PEDIDOS
	=============================================*/

	static public function ctrEditarpedidos(){

		if(isset($_POST["editarDescripcion"])){

		

				$tabla = "pedidos";

				$datos = array(
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   );

				$respuesta = Modelopedidos::mdlEditarpedidos($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "pedidos";

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

							window.location = "pedidos";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarpedidos(){

		if(isset($_GET["idpedidos"])){

			$tabla ="pedidos";
			$datos = $_GET["idpedidos"];

			
			$respuesta = Modelopedidos::mdlEliminarpedidos($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "pedidos";

								}
							})

				</script>';

			}		
		}


	}


		/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarpe(){

		if(isset($_GET["idpedidos"])){

			$tabla ="pedidos";
			$datos = $_GET["idpedidos"];

			
			$respuesta = Modelopedidos::mdlEliminarpedidos($tabla, $datos);

			
				
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentaspedidos(){

		$tabla = "pedidos";

		$respuesta = Modelopedidos::mdlMostrarSumaVentaspedidos($tabla);

		return $respuesta;

	}


}