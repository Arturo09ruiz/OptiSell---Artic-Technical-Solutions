<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

require_once "../controladores/laboratorios.controlador.php";
require_once "../modelos/laboratorios.modelo.php";


class Tablapedidos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablapedidos(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$pedidos = Controladorpedidos::ctrMostrarpedidos($item, $valor, $orden);	

  		if(count($pedidos) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pedidos); $i++){

			
		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $pedidos[$i]["tipo_cristal"];

		  	$tipo = ControladorTipo::ctrMostrarTipo($item, $valor);

	


			  
		  	$item = "id";
		  	$valor = $pedidos[$i]["lugar"];

		  	$lu = ControladorLaboratorios::ctrMostrarLaboratorios($item, $valor);




		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

	
  			if($pedidos[$i]["stock"] <= 10){

				$stock = "<button class='btn btn-danger'>".$pedidos[$i]["stock"]."</button>";

			}else if($pedidos[$i]["stock"] > 11 && $pedidos[$i]["stock"] <= 15){

				$stock = "<button class='btn btn-warning'>".$pedidos[$i]["stock"]."</button>";

			}else{

				$stock = "<button class='btn btn-success'>".$pedidos[$i]["stock"]."</button>";

			}

			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Vendedor"){

				$status =  "<h6>Sin Acceso</h6>"; 

		}else{		
			$status= "<button id ='' class='btn_terminadopedidos btn btn-primary' idpedidos='" . $pedidos[$i]["id"];
			$status = $status . "'  codigo='" . $pedidos[$i]["codigo"] . "' tipo='" . $tipo["nombre"] ;
			$status = $status . "'  medida='" . $pedidos[$i]["aumento_cristal"] . "'  lugar='" . $lu["laboratorio"] . "'  descripcion='" . $pedidos[$i]["descripcion"] . "'  stock='" . $pedidos[$i]["stock"];
			$status = $status . "' precio_venta='" . $pedidos[$i]["precio_venta"]  . "'  precio_compra='" . $pedidos[$i]["precio_compra"] . "' fecha='" . $pedidos[$i]["fecha"] . "' ><i>En Proceso</i></button>";       
			
		}
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Vendedor"){

  				$botones =  "<h6>Sin Acceso</h6>"; 

  			}else{

				//  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarlocal' idlocal='".$local[$i]["id"]."' data-toggle='modal' data-target='#modalEditarlocal'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarlocal' idlocal='".$local[$i]["id"]."' codigo='".$local[$i]["codigo"]."' imagen='".$local[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarpedidos' idpedidos='" ;				
				$botones = $botones .  $pedidos[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarpedidos'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarpedidos' idpedidos='" . $pedidos[$i]["id"] . "' codigo='" . $pedidos[$i]["codigo"] . "' imagen='" . $pedidos[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>";

				
			}
			  

			  
			  
		  	$datosJson .='[
				  "'.($i+1).'",
				  "'.$pedidos[$i]["codigo"].'",
				  "'.$tipo["nombre"].'",
				  "'.$pedidos[$i]["aumento_cristal"].'",
				  "'.$pedidos[$i]["descripcion"].'",
				  "'.$lu["laboratorio"].'",
				  "'.$stock.'",
				  "'.$pedidos[$i]["precio_compra"].'",
			      "'.$pedidos[$i]["precio_venta"].'",
				  "'.$pedidos[$i]["fecha"].'",
				  "'.$status.'",
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
$activarpedidos = new Tablapedidos();
$activarpedidos -> mostrarTablapedidos();

