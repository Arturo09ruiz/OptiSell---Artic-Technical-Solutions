<?php

class Controladorlocal{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarlocal($item, $valor, $orden){

		$tabla = "local";

		$respuesta = Modelolocal::mdlMostrarlocal($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDO
	=============================================*/

	static public function ctrCrearlocal(){

		if(isset($_POST["nuevaDescripcion"])){


				$tabla = "local";

				$datos = array(
							   "aumento_cristal" => $_POST["nuevoMedida"],
							   "tipo_cristal" => $_POST["nuevoTipo"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"],);

				$respuesta = Modelolocal::mdlIngresarlocal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "local";

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

							window.location = "local";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PEDIDOS
	=============================================*/

	static public function ctrEditarlocal(){

		if(isset($_POST["editarDescripcion"])){

		   		

				$tabla = "local";

				$datos = array(
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   );

				$respuesta = Modelolocal::mdlEditarlocal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "local";

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

							window.location = "local";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarlocal(){

		if(isset($_GET["idlocal"])){

			$tabla ="local";
			$datos = $_GET["idlocal"];

			
			$respuesta = Modelolocal::mdlEliminarlocal($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "local";

								}
							})

				</script>';

			}		
		}


	}


		/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarlo(){

		if(isset($_GET["idlocal"])){

			$tabla ="local";
			$datos = $_GET["idlocal"];

			
			$respuesta = Modelolocal::mdlEliminarlo($tabla, $datos);

			
				
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentaslocal(){

		$tabla = "local";

		$respuesta = Modelolocal::mdlMostrarSumaVentaslocal($tabla);

		return $respuesta;

	}


}