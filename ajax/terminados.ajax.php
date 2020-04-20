<?php

require_once "../controladores/terminados.controlador.php";
require_once "../modelos/terminados.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";


class Ajaxterminados{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idlista;

  public function ajaxCrearCodigoterminados(){

  	$item = "id_terminados";
  	$valor = $this->idlista;
    $orden = "id";

  	$respuesta = Controladorterminados::ctrMostrarterminados($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PEDIDOS
  =============================================*/ 

  public $idterminados;
  public $traerterminados;
  public $nombreterminados;

  public function ajaxEditarterminados(){

    if($this->traerterminados == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = Controladorterminados::ctrMostrarterminados($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreterminados != ""){

      $item = "descripcion";
      $valor = $this->nombreterminados;
      $orden = "id";

      $respuesta = Controladorterminados::ctrMostrarterminados($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idterminados;
      $orden = "id";

      $respuesta = Controladorterminados::ctrMostrarterminados($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idterminados"])){

  $editarterminados = new Ajaxterminados();
  $editarterminados -> idterminados = $_POST["idterminados"];
  $editarterminados -> ajaxEditarterminados();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerterminados"])){

  $traerterminados = new Ajaxterminados();
  $traerterminados -> traerterminados = $_POST["traerterminados"];
  $traerterminados -> ajaxEditarterminados();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreterminados"])){

  $traerterminados = new Ajaxterminados();
  $traerterminados -> nombreterminados = $_POST["nombreterminados"];
  $traerterminados -> ajaxEditarterminados();

}






