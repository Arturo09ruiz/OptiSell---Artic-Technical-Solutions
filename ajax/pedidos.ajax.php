<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

class Ajaxpedidos{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idlista;

  public function ajaxCrearCodigopedidos(){

  	$item = "id_pedidos";
  	$valor = $this->idlista;
    $orden = "id";

  	$respuesta = Controladorpedidos::ctrMostrarpedidos($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PEDIDOS
  =============================================*/ 

  public $idpedidos;
  public $traerpedidos;
  public $nombrepedidos;

  public function ajaxEditarpedidos(){

    if($this->traerpedidos == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = Controladorpedidos::ctrMostrarpedidos($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombrepedidos != ""){

      $item = "descripcion";
      $valor = $this->nombrepedidos;
      $orden = "id";

      $respuesta = Controladorpedidos::ctrMostrarpedidos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idpedidos;
      $orden = "id";

      $respuesta = Controladorpedidos::ctrMostrarpedidos($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idpedidos"])){

  $editarpedidos = new Ajaxpedidos();
  $editarpedidos -> idpedidos = $_POST["idpedidos"];
  $editarpedidos -> ajaxEditarpedidos();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerpedidos"])){

  $traerpedidos = new Ajaxpedidos();
  $traerpedidos -> traerpedidos = $_POST["traerpedidos"];
  $traerpedidos -> ajaxEditarpedidos();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombrepedidos"])){

  $traerpedidos = new Ajaxpedidos();
  $traerpedidos -> nombrepedidos = $_POST["nombrepedidos"];
  $traerpedidos -> ajaxEditarpedidos();

}






