<?php

require_once "../controladores/cristales.controlador.php";
require_once "../modelos/cristales.modelo.php";


class TablaCristalesVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaCristalesVentas(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$cristales = ControladorCristales::ctrMostrarCristales($item, $valor, $orden);
 		
  		if(count($cristales) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($cristales); $i++){

		  	/*=============================================
 	 		TRAEMOS LA IMAGEN
  			=============================================*/ 

		  	$imagen = "<img src='".$cristales[$i]["imagen"]."' width='40px'>";

		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

  			if($cristales[$i]["stock"] <= 10){

  				$stock = "<button class='btn btn-danger'>".$cristales[$i]["stock"]."</button>";

  			}else if($cristales[$i]["stock"] > 11 && $cristales[$i]["stock"] <= 15){

  				$stock = "<button class='btn btn-warning'>".$cristales[$i]["stock"]."</button>";

  			}else{

  				$stock = "<button class='btn btn-success'>".$cristales[$i]["stock"]."</button>";

  			}

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

		  	$botones =  "<div class='btn-group'><button class='btn btn-primary agregarCristal recuperarBoton' idCristal='".$cristales[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$imagen.'",
			      "'.$cristales[$i]["codigo"].'",
			      "'.$cristales[$i]["descripcion"].'",
			      "'.$stock.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarCristalesVentas = new TablaCristalesVentas();
$activarCristalesVentas -> mostrarTablaCristalesVentas();

