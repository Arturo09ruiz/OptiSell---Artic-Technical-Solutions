<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";
require_once "../../../controladores/cristales.controlador.php";
require_once "../../../modelos/cristales.modelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"],0,-8);
$productos = json_decode($respuestaVenta["productos"], true);
$cristales = json_decode($respuestaVenta["cristales"], true);
$impuesto = number_format($respuestaVenta["impuesto"],2);
$total = number_format($respuestaVenta["totaldolar"],2);
$falta = number_format($respuestaVenta["falta"],2);
$codigo = number_format($respuestaVenta["codigo"]);


//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

    <h1 style="text-align:center" >Apartado N° $codigo </h1>

    <h3 style="text-align:center">
    Cliente: $respuestaCliente[nombre].
    </h3>
    <br>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF
<h3 style="text-align:center">Productos:</h3>
EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

//MOSTRAR CRISTALES 

if($cristales){ 
foreach ($cristales as $key => $item) {

$itemCristal = "descripcion";
$valorCristal = $item["descripcion"];
$orden = null;

$respuestaCristal = ControladorCristales::ctrMostrarCristales($itemCristal, $valorCristal, $orden);

$valorUnitario = number_format($respuestaCristal["precio_venta"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque4 = <<<EOF

<h3 style="text-align:center">$item[descripcion]; Cantidad : 	$item[cantidad].</h3>				
	
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

}else{

	$bloque4 = <<<EOF



EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


}

//MOSTRAR PRODUCTOS (MONTURAS)

if($productos){
foreach ($productos as $key => $item) {

	$itemProducto = "descripcion";
	$valorProducto = $item["descripcion"];
	$orden = null;
	
	$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
	
	$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);
	
	$precioTotal = number_format($item["total"], 2);
	
	$bloque5 = <<<EOF
		<h3 style="text-align:center">$item[descripcion]; Cantidad : 	$item[cantidad].</h3>				
	EOF;
	
	$pdf->writeHTML($bloque5, false, false, false, false, '');
	
	}
}else{
	$bloque4 = <<<EOF



EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

	
}

// ---------------------------------------------------------

$bloque6 = <<<EOF
<br>    						
	<h3 style="text-align:center">Total: $$total</h3> 	
	<h3 style="text-align:center">Falta por pagar: $falta</h3>   						
EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

//Muchas Gracias¡ Footer:
$bloque7 = <<<EOF
<br>  
	<hr>
		<h5 style="text-align:center">*Info del Apartado*</h5>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');






// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

// $pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>