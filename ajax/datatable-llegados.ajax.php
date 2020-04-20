<?php

require_once "../controladores/llegados.controlador.php";
require_once "../modelos/llegados.modelo.php";




class Tablallegados{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablallegados(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$llegados = Controladorllegados::ctrMostrarllegados($item, $valor, $orden);	

  		if(count($llegados) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($llegados); $i++){


 
			$status= "<button id ='' class='btn_llegados btn btn-primary' idllegados='" . $llegados[$i]["id"];
			$status = $status . "'  lugar='" . $llegados[$i]["lugar"] . "'  codigo='" . $llegados[$i]["codigo"];
			$status = $status . "'  tipo='" . $llegados[$i]["tipo_cristal"] . "'  medida='" . $llegados[$i]["aumento_cristal"]. "'  descripcion='" . $llegados[$i]["descripcion"] . "'  stock='" . $llegados[$i]["stock"];
			$status = $status . "' precio_venta='" . $llegados[$i]["precio_venta"]  . "'  precio_compra='" . $llegados[$i]["precio_compra"] . "' fecha='" . $llegados[$i]["fecha"] . "' fecha_terminado='" . $llegados[$i]["fecha_terminado"] . "' ><i>Entregado</i></button>";       

	
 
		

			
		   
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
				  "'.$llegados[$i]["codigo"].'",
				  "'.$llegados[$i]["tipo_cristal"].'",
				  "'.$llegados[$i]["aumento_cristal"].'",
				  "'.$llegados[$i]["lugar"].'",
				  "'.$llegados[$i]["descripcion"].'",
				  "'.$llegados[$i]["stock"].'",
			      "'.$llegados[$i]["precio_compra"].'",
			      "'.$llegados[$i]["precio_venta"].'",
				  "'.$llegados[$i]["fecha_terminado"].'",
				  "'.$llegados[$i]["fecha_de_terminado"].'",
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
$activarllegados = new Tablallegados();
$activarllegados -> mostrarTablallegados();

