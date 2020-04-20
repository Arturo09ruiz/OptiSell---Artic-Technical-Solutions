<?php

require_once "../controladores/llegados.controlador.php";
require_once "../modelos/llegados.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";


class Ajaxllegados{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $idlista;

  public function ajaxCrearCodigollegados(){

  	$item = "id_llegados";
  	$valor = $this->idlista;
    $orden = "id";

  	$respuesta = Controladorllegados::ctrMostrarllegados($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PEDIDOS
  =============================================*/ 

  public $idllegados;
  public $traerllegados;
  public $nombrellegados;

  public function ajaxEditarllegados(){

    if($this->traerllegados == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = Controladorllegados::ctrMostrarllegados($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombrellegados != ""){

      $item = "descripcion";
      $valor = $this->nombrellegados;
      $orden = "id";

      $respuesta = Controladorllegados::ctrMostrarllegados($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idllegados;
      $orden = "id";

      $respuesta = Controladorllegados::ctrMostrarllegados($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idllegados"])){

  $editarllegados = new Ajaxllegados();
  $editarllegados -> idllegados = $_POST["idllegados"];
  $editarllegados -> ajaxEditarllegados();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerllegados"])){

  $traerllegados = new Ajaxllegados();
  $traerllegados -> traerllegados = $_POST["traerllegados"];
  $traerllegados -> ajaxEditarllegados();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombrellegados"])){

  $traerllegados = new Ajaxllegados();
  $traerllegados -> nombrellegados = $_POST["nombrellegados"];
  $traerllegados -> ajaxEditarllegados();

}






