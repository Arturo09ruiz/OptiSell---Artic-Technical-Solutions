<?php

class ControladorAumento{

	

	/*=============================================
	MOSTRAR AUMENTO DEL CRISTAL
	=============================================*/

	static public function ctrMostrarAumento($item, $valor){

		$tabla = "aumento";

		$respuesta = ModeloAumento::mdlMostrarAumento($tabla, $item, $valor);

		return $respuesta;
	
	}

	
}
