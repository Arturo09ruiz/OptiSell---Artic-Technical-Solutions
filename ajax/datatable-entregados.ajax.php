<?php

require_once "../controladores/entregados.controlador.php";
require_once "../modelos/entregados.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

require_once "../controladores/aumento.controlador.php";
require_once "../modelos/aumento.modelo.php";




class Tablaentregados{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaentregados(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$entregados = Controladorentregados::ctrMostrarentregados($item, $valor, $orden);	

  		if(count($entregados) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($entregados); $i++){

			
		  

	
 
		

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
				  "'.$entregados[$i]["codigo"].'",
				  "'.$entregados[$i]["tipo_cristal"].'",
				  "'.$entregados[$i]["aumento_cristal"].'",
				  "'.$entregados[$i]["descripcion"].'",
				  "'.$entregados[$i]["stock"].'",
			      "'.$entregados[$i]["precio_compra"].'",
			      "'.$entregados[$i]["precio_venta"].'",
				  "'.$entregados[$i]["fecha_entregado"].'",
				  "'.$entregados[$i]["fecha_pedido_entregado"].'",
				  "'.$entregados[$i]["fecha"].'"



				  
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
$activarentregados = new Tablaentregados();
$activarentregados -> mostrarTablaentregados();

