<?php

require_once "../controladores/cristales.controlador.php";
require_once "../modelos/cristales.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";

class AjaxCristales{

  /*=============================================
  GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
  =============================================*/
  public $tipo_cristal;

  public function ajaxCrearCodigoCristal(){

  	$item = "tipo_cristal";
  	$valor = $this->tipo_cristal;
    $orden = "id";

  	$respuesta = ControladorCristales::ctrMostrarCristales($item, $valor, $orden);

  	echo json_encode($respuesta);

  }


  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idCristal;
  public $traerCristales;
  public $nombreCristal;

  public function ajaxEditarCristal(){

    if($this->traerCristales == "ok"){

      $item = null;
      $valor = null;
      $orden = "id";

      $respuesta = ControladorCristales::ctrMostrarCristales($item, $valor,
        $orden);

      echo json_encode($respuesta);


    }else if($this->nombreCristal != ""){

      $item = "descripcion";
      $valor = $this->nombreCristal;
      $orden = "id";

      $respuesta = ControladorCristales::ctrMostrarCristales($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idCristal;
      $orden = "id";

      $respuesta = ControladorCristales::ctrMostrarCristales($item, $valor,
        $orden);

      echo json_encode($respuesta);

    }

  }

}


/*=============================================
GENERAR CÓDIGO A PARTIR DE ID CATEGORIA
=============================================*/	

if(isset($_POST["tipo_cristal"])){

	$codigoCristal = new AjaxCristales();
	$codigoCristal -> tipo_cristal = $_POST["tipo_cristal"];
	$codigoCristal -> ajaxCrearCodigoCristal();

}
/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idCristal"])){

  $editarCristal = new AjaxCristales();
  $editarCristal -> idCristal = $_POST["idCristal"];
  $editarCristal -> ajaxEditarCristal();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerCristales"])){

  $traerCristales = new AjaxCristales();
  $traerCristales -> traerCristales = $_POST["traerCristales"];
  $traerCristales -> ajaxEditarCristal();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["nombreCristal"])){

  $traerCristales = new AjaxCristales();
  $traerCristales -> nombreCristal = $_POST["nombreCristal"];
  $traerCristales -> ajaxEditarCristal();

}






