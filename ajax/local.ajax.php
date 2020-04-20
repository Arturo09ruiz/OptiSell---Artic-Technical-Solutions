<?php

require_once "../controladores/local.controlador.php";
require_once "../modelos/local.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";


class Ajaxlocal{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idlista;

  public function ajaxCrearCodigolocal(){

  	$item = "id_local";
  	$valor = $this->idlista;
    $orden = "id";

  	$respuesta = Controladorlocal::ctrMostrarlocal($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PEDIDOS
  =============================================*/ 

  public $idlocal;
  public $traerlocal;
  public $nombrelocal;

  public function ajaxEditarlocal(){

    if($this->traerlocal == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = Controladorlocal::ctrMostrarlocal($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombrelocal != ""){

      $item = "descripcion";
      $valor = $this->nombrelocal;
      $orden = "id";

      $respuesta = Controladorlocal::ctrMostrarlocal($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idlocal;
      $orden = "id";

      $respuesta = Controladorlocal::ctrMostrarlocal($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idlocal"])){

  $editarlocal = new Ajaxlocal();
  $editarlocal -> idlocal = $_POST["idlocal"];
  $editarlocal -> ajaxEditarlocal();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerlocal"])){

  $traerlocal = new Ajaxlocal();
  $traerlocal -> traerlocal = $_POST["traerlocal"];
  $traerlocal -> ajaxEditarlocal();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombrelocal"])){

  $traerlocal = new Ajaxlocal();
  $traerlocal -> nombrelocal = $_POST["nombrelocal"];
  $traerlocal -> ajaxEditarlocal();

}






