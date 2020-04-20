<?php

class ControladorTipo{

	

	/*=============================================
	MOSTRAR TIPO DE CRISTAL
	=============================================*/

	static public function ctrMostrarTipo($item, $valor){

		$tabla = "tipo";

		$respuesta = ModeloTipo::mdlMostrarTipo($tabla, $item, $valor);

		return $respuesta;
	
	}

	
}
