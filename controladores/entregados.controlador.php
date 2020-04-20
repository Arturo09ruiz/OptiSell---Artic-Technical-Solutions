<?php

class Controladorentregados{

	/*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function ctrMostrarentregados($item, $valor, $orden){

		$tabla = "entregados";

		$respuesta = Modeloentregados::mdlMostrarentregados($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	/*=============================================
	CREAR PEDIDO
	=============================================*/

	static public function ctrCrearentregados(){

		if(isset($_POST["descripcion_entregado"])){


				$tabla = "entregados";

				$datos = array(
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

				$respuesta = Modeloentregados::mdlIngresarentregados($tabla, $datos);

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

	static public function ctrEditarterminados(){

		if(isset($_POST["editarDescripcion"])){

		

				$tabla = "terminados";

				$datos = array(
							   "codigo" => $_POST["editarCodigo"],
							   "descripcion" => $_POST["editarDescripcion"],
							   "precio_compra" => $_POST["editarPrecioCompra"],
							   "precio_venta" => $_POST["editarPrecioVenta"],
							   );

				$respuesta = Modeloterminados::mdlEditarterminados($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "El Pedido ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "terminados";

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

							window.location = "terminados";

							}
						})

			  	</script>';
			}
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarterminados(){

		if(isset($_GET["idterminados"])){

			$tabla ="terminados";
			$datos = $_GET["idterminados"];

			
			$respuesta = Modeloterminados::mdlEliminarterminados($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Pedido ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "terminados";

								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function ctrMostrarSumaVentasterminados(){

		$tabla = "terminados";

		$respuesta = Modeloterminados::mdlMostrarSumaVentasterminados($tabla);

		return $respuesta;

	}


}