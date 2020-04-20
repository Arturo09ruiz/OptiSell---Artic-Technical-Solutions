<?php

require_once "../controladores/local.controlador.php";
require_once "../modelos/local.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

require_once "../controladores/aumento.controlador.php";
require_once "../modelos/aumento.modelo.php";

require_once "../controladores/laboratorios.controlador.php";
require_once "../modelos/laboratorios.modelo.php";


class Tablalocal{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PEDIDOS
  	=============================================*/ 

	public function mostrarTablalocal(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$local = Controladorlocal::ctrMostrarlocal($item, $valor, $orden);	

  		if(count($local) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($local); $i++){

			
		  	/*=============================================
 	 		TRAEMOS LA CATEGORÍA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $local[$i]["tipo_cristal"];

		  	$tipo = ControladorTipo::ctrMostrarTipo($item, $valor);

			/*=============================================
 	 		TRAEMOS LA MEDIDA DEL CRISTAL
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $local[$i]["aumento_cristal"];

		  	$medida = ControladorAumento::ctrMostrarAumento($item, $valor);


		  	/*=============================================
 	 		STOCK
  			=============================================*/ 

	
  			if($local[$i]["stock"] <= 10){

				$stock = "<button class='btn btn-danger'>".$local[$i]["stock"]."</button>";

			}else if($local[$i]["stock"] > 11 && $local[$i]["stock"] <= 15){

				$stock = "<button class='btn btn-warning'>".$local[$i]["stock"]."</button>";

			}else{

				$stock = "<button class='btn btn-success'>".$local[$i]["stock"]."</button>";

			}

			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Vendedor"){
				$status =  "<h6>Sin Acceso</h6>"; 


			}else{
				$status= "<button id ='' class='btn_terminado btn btn-primary' idlocal='" . $local[$i]["id"];
				$status = $status . "'  codigo='" . $local[$i]["codigo"] . "' tipo='" . $tipo["nombre"] ;
				$status = $status  . "'  medida='" . $local[$i]["aumento_cristal"] . "'  descripcion='" . $local[$i]["descripcion"] . "'  stock='" . $local[$i]["stock"];
				$status = $status . "' precio_venta='" . $local[$i]["precio_venta"]  . "'  precio_compra='" . $local[$i]["precio_compra"] . "' fecha='" . $local[$i]["fecha"] . "' ><i>En Proceso</i></button>";       
			  
			}
			
			 
                 
		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Vendedor"){

				$botones =  "<h6>Sin Acceso</h6>"; 

  			}else{

				//  $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarlocal' idlocal='".$local[$i]["id"]."' data-toggle='modal' data-target='#modalEditarlocal'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarlocal' idlocal='".$local[$i]["id"]."' codigo='".$local[$i]["codigo"]."' imagen='".$local[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 
				$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarlocal' idlocal='" ;
				$botones = $botones .  $local[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarlocal'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarlocal' idlocal='" . $local[$i]["id"] . "' codigo='" . $local[$i]["codigo"] . "' imagen='" . $local[$i]["imagen"] . "'><i class='fa fa-times'></i></button></div>"; 
			  }
			  

			  
			  
		  	$datosJson .='[
				  "'.($i+1).'",
				  "'.$local[$i]["codigo"].'",
				  "'.$tipo["nombre"].'",
				  "'.$local[$i]["aumento_cristal"].'",
				  "'.$local[$i]["descripcion"].'",
				  "'.$stock.'",
				  "'.$local[$i]["precio_compra"].'",
			      "'.$local[$i]["precio_venta"].'",
				  "'.$local[$i]["fecha"].'",
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
$activarlocal = new Tablalocal();
$activarlocal -> mostrarTablalocal();

