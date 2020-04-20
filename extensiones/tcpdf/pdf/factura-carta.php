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
$tasa = number_format($respuestaVenta["tasadeldia"],2);


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

	<table>
		
		<tr>
			<br>
			<td style="width:150px"><img src="images/optica.png"></td>

			<td style="background-color:white; width:190px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					RIF: J-41037235-4

					<br>
					Dirección:Avenida Siegert, Casa N°19,Sector Siegert,Ciudad Bolívar

				</div>

			</td>

			<td style="background-color:white; width:70px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 0285-6341614
					<br>

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA N.<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:300px">

				Cliente: $respuestaCliente[nombre]

			</td>
			<td style="border: 1px solid #666; background-color:white; width:90px">

			C.I: $respuestaCliente[documento]

		</td>
			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

	

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">Dirección: $respuestaCliente[direccion]</td>
			<td style="border: 1px solid #666; background-color:white; width:150px">Telf: $respuestaCliente[telefono]</td>

		</tr>
		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

	</tr>
		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>
		
	</table>












EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:340px; text-align:center">Producto</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

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

$tasa = ($respuestaVenta["tasadeldia"]);

// $prueba= $respuestaVenta[$tasa];
$prueba = number_format($tasa*$precioTotal, 2);

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center">
				$item[descripcion]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Bs.S
				$prueba
			</td>


		</tr>

	</table>


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

	$tasa = ($respuestaVenta["tasadeldia"]);

	// $prueba= $respuestaVenta[$tasa];
	$prueba = number_format($tasa*$precioTotal, 2);

	$bloque5 = <<<EOF
	
		<table style="font-size:10px; padding:5px 10px;">
	
			<tr>
				
				<td style="border: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center">
					$item[descripcion]
				</td>
	
				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
					$item[cantidad]
				</td>
				<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">Bs.S
					$prueba
				</td>
	
	
			</tr>
	
		</table>
	
	
	EOF;
	
	$pdf->writeHTML($bloque5, false, false, false, false, '');
	
	}
}else{
	$bloque4 = <<<EOF



EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

	
}

// ---------------------------------------------------------
$tasa = ($respuestaVenta["tasadeldia"]);
// $prueba= $respuestaVenta[$tasa];
$prueba = number_format($tasa*$total, 2);
$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				%16
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				Bs.S $prueba
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

//Muchas Gracias¡ Footer:
$bloque7 = <<<EOF
<br>  
	<hr>
		<h1 style="text-align:center" >Muchas Gracias Por Su Compra¡</h1>

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