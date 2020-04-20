<?php

require_once "../controladores/terminados.controlador.php";
require_once "../modelos/terminados.modelo.php";




class Tablaterminados{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablaterminados(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$terminados = Controladorterminados::ctrMostrarterminados($item, $valor, $orden);	

  		if(count($terminados) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($terminados); $i++){


 
			$status= "<button id ='' class='btn_entregado btn btn-primary' idterminado='" . $terminados[$i]["id"];
			$status = $status . "'  codigo='" . $terminados[$i]["codigo"];
			$status = $status . "'  tipo='" . $terminados[$i]["tipo_cristal"] . "'  medida='" . $terminados[$i]["aumento_cristal"] . "'  descripcion='" . $terminados[$i]["descripcion"] . "'  stock='" . $terminados[$i]["stock"];
			$status = $status . "' precio_venta='" . $terminados[$i]["precio_venta"]  . "'  precio_compra='" . $terminados[$i]["precio_compra"] . "' fecha='" . $terminados[$i]["fecha"] . "' fecha_terminado='" . $terminados[$i]["fecha_terminado"] . "' ><i>Entregado</i></button>";       

	
 
		

			
		   
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
				  "'.$terminados[$i]["codigo"].'",
				  "'.$terminados[$i]["tipo_cristal"].'",
				  "'.$terminados[$i]["aumento_cristal"].'",
				  "'.$terminados[$i]["descripcion"].'",
				  "'.$terminados[$i]["stock"].'",
			      "'.$terminados[$i]["precio_compra"].'",
			      "'.$terminados[$i]["precio_venta"].'",
				  "'.$terminados[$i]["fecha_terminado"].'",
				  "'.$terminados[$i]["fecha_de_terminado"].'",
				  "'.$status.'"				  
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
$activarterminados = new Tablaterminados();
$activarterminados -> mostrarTablaterminados();

