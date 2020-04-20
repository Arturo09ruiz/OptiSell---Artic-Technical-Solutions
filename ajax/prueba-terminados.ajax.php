<?php
require_once "../controladores/terminados.controlador.php";
require_once "../modelos/terminados.modelo.php";

require_once "../controladores/tipo.controlador.php";
require_once "../modelos/tipo.modelo.php";





 $idterminado= $_POST['idterminado'];
 $tabla ="terminados";
 $datos = $idterminado;

// $codigo=$_POST['codigo'];
// $tipo=$_POST['tipo'];


 print($datos); 

 $respuesta = Modeloterminados::mdlEliminarterminados($tabla, $datos);

// print($codigo);
// print($tipo);




