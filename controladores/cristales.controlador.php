<?php

class ControladorCristales{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarCristales($item, $valor, $orden){

		$tabla = "cristales";

		$respuesta = ModeloCristales::mdlMostrarCristales($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearCristal(){

		if(isset($_POST["nuevaDescripcion"])){

		
		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   
				$tabla = "cristales";

				$datos = array(
							   "codigo" => $_POST["nuevoCodigo"],
							   "tipo_cristal" => $_POST["nuevoTipo"],
							   "aumento_cristal" => $_POST["nuevoMedida"],
							   "descripcion" => $_POST["nuevaDescripcion"],
							   "stock" => $_POST["nuevoStock"],
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "precio_venta" => $_POST["nuevoPrecioVenta"]);

				$respuesta = ModeloCristales::mdlIngresarCristal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Cristal ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "cristales";

										}
									})

						</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Cristal no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cristales";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarCristal(){

		if(isset($_POST["editarDescripcion"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$tabla = "cristales";

				$datos = array("id_categoria" => $_POST["editarCategoria"],
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "stock" => $_POST["editarStock"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							    );

				$respuesta = ModeloCristales::mdlEditarCristal($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Cristal ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "cristales";

										}
									})

						</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El Cristal no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cristales";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarCristal(){

		if(isset($_GET["idCristal"])){

			$tabla ="cristales";
			$datos = $_GET["idCristal"];

			

			$respuesta = ModeloCristales::mdlEliminarCristal($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Cristal ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "cristales";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentasCristal(){

		$tabla = "cristales";

		$respuesta = ModeloCristales::mdlMostrarSumaVentasCristal($tabla);

		return $respuesta;

	}


}