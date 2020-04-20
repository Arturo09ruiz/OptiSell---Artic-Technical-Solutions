<?php
require_once "../controladores/llegados.controlador.php";
require_once "../modelos/llegados.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";




 $idllegados= $_POST['idllegados'];
 $tabla ="llegados";
 $datos = $idllegados;

// $codigo=$_POST['codigo'];
// $tipo=$_POST['tipo'];


 print($datos); 

 $respuesta = Modelollegados::mdlEliminarllegados($tabla, $datos);

// print($codigo);
// print($tipo);




