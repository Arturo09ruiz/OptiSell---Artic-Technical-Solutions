<?php

require_once "../controladores/entre.controlador.php";
require_once "../modelos/entre.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

require_once "../controladores/aumento.controlador.php";
require_once "../modelos/aumento.modelo.php";




class Tablaentre{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaentre(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$entre = Controladorentre::ctrMostrarentre($item, $valor, $orden);	

  		if(count($entre) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($entre); $i++){

			
		  

	
 
		

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial"){

  				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditaterminados' idterminados='".$terminados[$i]["id"]."' data-toggle='modal' data-target='#modalEditarterminados'><i class='fa fa-pencil'></i></button></div>"; 

  			}else{

  				 $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarterminados' idterminados='".$terminados[$i]["id"]."' data-toggle='modal' data-target='#modalEditarterminados'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarterminados' idterminados='".$terminados[$i]["id"]."' codigo='".$terminados[$i]["codigo"]."' imagen='".$terminados[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

			  }
  			=============================================*/ 
			  

			  
			  
		  	$datosJson .='[
				  "'.($i+1).'",
				  "'.$entre[$i]["codigo"].'",
				  "'.$entre[$i]["tipo_cristal"].'",
				  "'.$entre[$i]["aumento_cristal"].'",
				  "'.$entre[$i]["lugar"].'",
				  "'.$entre[$i]["descripcion"].'",
				  "'.$entre[$i]["stock"].'",
			      "'.$entre[$i]["precio_compra"].'",
			      "'.$entre[$i]["precio_venta"].'",
				  "'.$entre[$i]["fecha_entregado"].'",
				  "'.$entre[$i]["fecha_pedido_entregado"].'",
				  "'.$entre[$i]["fecha"].'"



				  
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
$activarentre = new Tablaentre();
$activarentre -> mostrarTablaentre();

