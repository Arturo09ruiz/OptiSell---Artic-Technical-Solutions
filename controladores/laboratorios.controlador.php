<?php

class ControladorLaboratorios{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearLaboratorio(){

		if(isset($_POST["nuevoLaboratorio"])){


				$tabla = "laboratorio";

				$datos = $_POST["nuevoLaboratorio"];

				$respuesta = ModeloLaboratorios::mdlIngresarLaboratorios($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Laboratorio ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ingresarlaboratorios";

									}
								})

					</script>';

				}


			}

		}

	

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarLaboratorios($item, $valor){

		$tabla = "laboratorio";

		$respuesta = ModeloLaboratorios::mdlMostrarLaboratorios($tabla, $item, $valor);

		return $respuesta;
	
	}

	

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarLaboratorio(){

		if(isset($_GET["idLaboratorio"])){

			$tabla ="laboratorio";
			$datos = $_GET["idLaboratorio"];

			$respuesta = ModeloLaboratorios::mdlBorrarLaboratorio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Laboratorio ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ingresarlaboratorios";

									}
								})

					</script>';
			}
		}
		
	}
}
