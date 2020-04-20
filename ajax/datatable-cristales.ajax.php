<?php

require_once "../controladores/cristales.controlador.php";
require_once "../modelos/cristales.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";




class TablaCristales{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaCristales(){

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


		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 



		  	$item = "id";
		  	$valor = $cristales[$i]["tipo_cristal"];

		  	$tipo = ControladorTipo::ctrMostrarTipo($item, $valor);

			

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

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCristal' idCristal='".$cristales[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCristal'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCristal' idCristal='".$cristales[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCristal'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCristal' idCristal='".$cristales[$i]["id"]."' codigo='".$cristales[$i]["codigo"]."' imagen='".$cristales[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

  			}

		 
		  	$datosJson .='[
			      "'.($i+1).'",
				  "'.$cristales[$i]["codigo"].'",
				  "'.$tipo["nombre"].'",
			      "'.$cristales[$i]["aumento_cristal"].'",
				  "'.$cristales[$i]["descripcion"].'",
			      "'.$stock.'",
			      "'.$cristales[$i]["precio_compra"].'",
			      "'.$cristales[$i]["precio_venta"].'",
			      "'.$cristales[$i]["fecha"].'",
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
$activarCristales = new TablaCristales();
$activarCristales -> mostrarTablaCristales();

