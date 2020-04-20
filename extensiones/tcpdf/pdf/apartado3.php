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

















$tasa = ($respuestaVenta["tasadeldia"]);
	// $prueba= $respuestaVenta[$tasa];
    $prueba = number_format($tasa*$total, 2);
    $falta = number_format($respuestaVenta["falta"],2);
$faltabs = number_format($tasa*$falta,2);



$abono = number_format($total-$falta);
$abonobs = number_format($tasa*$abono,2);


$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:215px">

				Nombre: $respuestaCliente[nombre]

            </td>
            
            <td style="border: 1px solid #666; background-color:white; width:95px; text-align:left">
			
            C.I: $respuestaCliente[documento]

        </td>

			<td style="border: 1px solid #666; background-color:white; width:110px; text-align:left">
			
				Fecha: $fecha

            </td>
            <td style="border: 1px solid #666; background-color:white; width:120px; text-align:left">
			
            Telf: $respuestaCliente[telefono]

        </td>

		</tr>

		<tr>
		
            <td style="border: 1px solid #666; background-color:white; width:215px">
            
            La suma de : $total $
            
            </td>
            <td style="border: 1px solid #666; background-color:white; width:325px">
            
Por concepto de: Compra de Productos            
            </td>


		</tr>

        <tr>
		
        <td style="border: 1px solid #666; background-color:white; width:215px">
        Abono:  $abono $

        </td>
        <td style="border: 1px solid #666; background-color:white; width:325px">
        
            Resta: $falta $      
        </td>


    </tr>

    

	</table>
    <br>
    <br>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');









$bloque3 = <<<EOF


	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:white; width:540px; text-align:center">Productos</td>
		

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');





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
                
                <td style="border: 1px solid #666; color:#333; background-color:white; width:540px; text-align:center">
                    $item[descripcion]&nbsp; (Cantidad: $item[cantidad])
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
                    
                    <td style="border: 1px solid #666; color:#333; background-color:white; width:540px; text-align:center">
                        $item[descripcion] &nbsp; (Cantidad: $item[cantidad])
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

    
    



    $fechaActual = date('d-m-Y');

    $bloque6 = <<<EOF
<br>
<br>
	<table>
		
		<tr>
			

			<td style="background-color:white; width:540px;text-align:center ">

           <b><u> CONDICIONES PARA REALIZAR LOS LENTES</u></b>
			</td>

			
		</tr>


        <tr>
			

        <td style="background-color:white; width:540px;text-align:left ">
        1° La Entrega de Los Lentes es de 20 a 30 días hábiles posterior al 50% del abono(No incluye sábado, domingo, feriados y problemas inherente a transportes o de fuerza mayor).

        </td>
        </tr>
<tr>

        <td style="background-color:white; width:540px;text-align:left ">
        2° No nos Hacemos responsables por lentes dejados más de 45 días sin retirar.

        </td>

        
        </tr>




        <tr>

        <td style="background-color:white; width:540px;text-align:left ">
        3° No se Entregan Lentes sin el recibo.

        </td>

        
        </tr>




        <tr>

        <td style="background-color:white; width:540px;text-align:left ">
        4° Pasado más de 7 días no hay reclamo ni garantías en la fórmula de los lentes (Revisar su agudeza visual al momento de entrega de los lentes); Fecha de entrega:<u>$fechaActual</u>


        </td>

        
        </tr>







        <tr>

        <td style="background-color:white; width:540px;text-align:left ">
        5° Debe revisar la integridad de la Montura y los cristales al momento de la entrega para cubrir la garantía. Recibí Conforme: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>; Nombre: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u> C.I: <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>

        </td>

        
        </tr>




        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        6° Los Lentes entregados a Tercero no cubren ninguna garantía.

        </td>

        
        </tr>



        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        7° Los reintegros serán en la misma forma en la que se realizó el pago.

        </td>

        
        </tr>






        


        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        8° Solicite su factura al momento de la entrega del lente (No hay reclamos sin factura).

        </td>

        
        </tr>







        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        9° Al modificar los cristales (altura, tamaño, patrón, de una montura a otra) No cubre garantía.

        </td>

        
        </tr>


        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        10° Para información llamar al 0285-634-1614 (De lunes a viernes de 8:00 am a 12 pm y de 2:00 pm a 3:30 pm)

        </td>

        
        </tr>




        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        11° No nos hacemos responsables por trabajos realizados en monturas nuevas, usadas o deterioradas, de origen propias o compradas en otras ópticas

        </td>

        
        </tr>




        
        <tr>

        <td style="background-color:white; width:540px;text-align:left ">

        11° No nos hacemos responsables por trabajos realizados en monturas nuevas, usadas o deterioradas, de origen propias o compradas en otras ópticas

        </td>

        
        </tr>




          
        <tr>

        <td style="background-color:white; width:540px;text-align:left ">
        12° No nos hacemos responsables por formulas ajenas a nuestra óptica.


        </td>

        
        </tr>



        <br>
        <br>





   
       




		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:380px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:center">
<br>
<br>
<br>
<br>
<br>
<br>

<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
           <h6>FIRMA CONFORME EN SEÑAL DE ACEPTACIÓN DE LAS CONDICIONES</h6>
            </td>

            
			
		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');





















//MULTICELDA TEST READY
//$pdf->MultiCell(180, 5, '[Prueaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa] ', 0, 'C', 0, 10, '', '', true);


























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