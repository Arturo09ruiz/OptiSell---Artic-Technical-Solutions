<?php
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";





 $idpedidos= $_POST['idpedidos'];
 $tabla ="pedidos";
 $datos = $idpedidos;

// $codigo=$_POST['codigo'];
// $tipo=$_POST['tipo'];


 print($datos); 

 $respuesta = Modelopedidos::mdlEliminarpe($tabla, $datos);

// print($codigo);
// print($tipo);




