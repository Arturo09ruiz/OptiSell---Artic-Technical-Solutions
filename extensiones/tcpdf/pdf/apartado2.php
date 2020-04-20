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

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>Apartado N°<br>$valorVenta</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');









$bloque2 = <<<EOF




<table>
		
		<tr>
			
			<hr>
<br>
			<td style="background-color:white; width:5000px">
				
				<div style="font-size:12px; line-height:15px;">
					
                <br>
				Nombre:&nbsp;$respuestaCliente[nombre]&nbsp;
				C.I: $respuestaCliente[documento]&nbsp;
				Fecha: $fecha
				Telf: $respuestaCliente[telefono]&nbsp;
                

               
                </div>
        </td>
            
		</tr>

	</table>	



EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');




//BLOQUE 3
$pdf->SetXY(0, 50);

	$tasa = ($respuestaVenta["tasadeldia"]);
	// $prueba= $respuestaVenta[$tasa];
	$prueba = number_format($tasa*$total, 2);
	$bloque3 = <<<EOF


<table>
		
		<tr>
			<br>

			<td style="background-color:white; width:500000px">
				
				<div style="font-size:12px;  line-height:15px;">
					
                
                La Suma de: $prueba Bs.S 
				&nbsp;
				Por concepto de: Compra de

                

               
                </div>
        </td>
            
		</tr>

	</table>	

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



















//BLOQUE 4

if($productos){
	$pdf->SetXY(140, 55.3);

	foreach ($productos as $key => $item) {

		$itemProducto = "descripcion";
		$valorProducto = $item["descripcion"];
		$orden = null;
		
		$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);
		
	

$bloque4 = <<<EOF




		<u>	$item[descripcion]($item[cantidad])	&nbsp;</u>

			

		   
	

EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

}

}
else{
		
	
		




};











if($cristales){









	$pdf->SetXY(10, 67);

	foreach ($cristales as $key => $item) {

		$itemCristal = "descripcion";
		$valorCristal = $item["descripcion"];
		$orden = null;
		
		$respuestaCristal = ControladorCristales::ctrMostrarCristales($itemCristal, $valorCristal, $orden);
		
		
$bloque5 = <<<EOF




	$item[descripcion]($item[cantidad]);&nbsp;

			

		   
	

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


	}
}
else{

};










$pdf->SetXY(130, 80);
$total = number_format($respuestaVenta["totaldolar"],2);
$falta = number_format($respuestaVenta["falta"],2);

$abono = number_format($total-$falta,2);
$bloque6 = <<<EOF


<table>
	
	<tr>

		<td style="background-color:white; width:5000px">
			
			<div style="font-size:12px; text-align:left; line-height:15px;">
				
			
		Abono:$abono&nbsp; Resta:$falta&nbsp;Total:$total
			

		   
			</div>
	</td>
		
	</tr>

</table>	

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');











$bloque7 = <<<EOF

<br>
<hr>
EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');












$pdf->SetXY(56, 92);

$bloque8 = <<<EOF





<b><u>CONDICIONES PARA REALIZAR LOS LENTES</u></b>

EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');








$pdf->SetXY(10, 100);

$bloque9 = <<<EOF





1° La Entrega de Los Lentes es de 20 a 30 días hábiles posterior al 50% del abono(No incluye sábado, domingo, feriados y problemas inherente a transportes o de fuerza mayor).

EOF;

$pdf->writeHTML($bloque9, false, false, false, false, '');










$pdf->SetXY(10, 110);

$bloque10 = <<<EOF





2° No nos Hacemos responsables por lentes dejados mas de 45 días sin retirar.

EOF;

$pdf->writeHTML($bloque10, false, false, false, false, '');




$pdf->SetXY(10, 115);

$bloque11 = <<<EOF





3° No se Entregan Lentes Sin Recibo.

EOF;

$pdf->writeHTML($bloque11, false, false, false, false, '');





//CAMPO DE TEXTO BLANCO

// $pdf->SetXY(10, 120);
// $fechaActual = date('d-m-Y');

// $bloque12 = <<<EOF




// 4° Pasado más de 7 días no hay reclamo ni garantías en la fórmula de los lentes (Revisar su agudeza visual al momento de entrega de los lentes); Fecha de entrega:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>

// EOF;

// $pdf->writeHTML($bloque12, false, false, false, false, '');






//TRAER FECHA

$pdf->SetXY(10, 120);
$fechaActual = date('d-m-Y');

$bloque12 = <<<EOF




4° Pasado más de 7 días no hay reclamo ni garantías en la fórmula de los lentes (Revisar su agudeza visual al momento de entrega de los lentes); Fecha de entrega:<u>$fechaActual</u>

EOF;

$pdf->writeHTML($bloque12, false, false, false, false, '');







$pdf->SetXY(10, 130);
$fechaActual = date('d-m-Y');

$bloque13 = <<<EOF




5° Debe revisar la integridad de la Montura y los cristales al momento de la entrega para cubrir la garantía. Recibi Conforme: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>; Nombre: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> C.I: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>

EOF;

$pdf->writeHTML($bloque13, false, false, false, false, '');








$pdf->SetXY(10, 140);
$fechaActual = date('d-m-Y');

$bloque14 = <<<EOF




6° Los Lentes entregados a Tercero no cubren ninguna garantía

EOF;

$pdf->writeHTML($bloque14, false, false, false, false, '');




$pdf->SetXY(10, 145);
$fechaActual = date('d-m-Y');

$bloque15 = <<<EOF




7° Los reintegros serán en la misma forma en la que se realizó el pago

EOF;

$pdf->writeHTML($bloque15, false, false, false, false, '');





$pdf->SetXY(10, 150);
$fechaActual = date('d-m-Y');

$bloque16 = <<<EOF




8° Solicite su factura al momento de la entrega del lente (No hay reclamos sin factura).

EOF;

$pdf->writeHTML($bloque16, false, false, false, false, '');










$pdf->SetXY(10, 155);
$fechaActual = date('d-m-Y');

$bloque17 = <<<EOF




9° Al modificar los cristales (altura, tamaño, patrón, de una montura a otra) No cubre garantía
EOF;

$pdf->writeHTML($bloque17, false, false, false, false, '');






$pdf->SetXY(10, 160);
$fechaActual = date('d-m-Y');

$bloque18 = <<<EOF



10° Para información llamar al 0285-634-1614 (De lunes a viernes de 8:00 am a 12 pm y de 2:00 pm a 3:30 pm)


EOF;

$pdf->writeHTML($bloque18, false, false, false, false, '');







$pdf->SetXY(10, 170);
$fechaActual = date('d-m-Y');

$bloque19 = <<<EOF



11° No nos hacemos responsables por trabajos realizados en monturas nuevas, usadas o deterioradas, de origen propias o compradas en otras ópticas


EOF;

$pdf->writeHTML($bloque19, false, false, false, false, '');












$pdf->SetXY(10, 180);
$fechaActual = date('d-m-Y');

$bloque20 = <<<EOF



12° No nos hacemos responsables por formulas ajenas a nuestra óptica


EOF;

$pdf->writeHTML($bloque20, false, false, false, false, '');














$bloque21 = <<<EOF

<img src="images/firma.jpg">

			

EOF;

$pdf->writeHTML($bloque21, false, false, false, false, '');






































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