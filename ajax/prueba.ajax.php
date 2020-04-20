<?php
require_once "../controladores/local.controlador.php";
require_once "../modelos/local.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";




 $idlocal= $_POST['idlocal'];
 $tabla ="local";
 $datos = $idlocal;

// $codigo=$_POST['codigo'];
// $tipo=$_POST['tipo'];


 print($datos); 

 $respuesta = Modelolocal::mdlEliminarlo($tabla, $datos);

// print($codigo);
// print($tipo);




