<style>
    .gh{
        transform: translate(550px);
      }
    .hg{
        transform: translate(270px);
        width: 750px;
      }
      .as{
        transform: translate(30px);
      }
      .cout{
        transform: translate(275px);
      }
</style> 


<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>



<div class="content-wrapper">

  <section class="content-header">
    
    <h1 class="gh">
      
      Editar venta
    
    </h1>
  <br>
    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Editar venta</li>
    
    </ol>

  </section>

  <section >

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="hg">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    // $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];


                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" readonly required>

                    <option  value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option  value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                <?php
                 
                $listaProducto = json_decode($venta["productos"], true);
                if($listaProducto){

                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";

                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
            
                        <div class="col-xs-6" style="padding-right:0px">
                      
                          <div class="input-group">
                
                            <span class="input-group-addon"><button type="button" class="btn btn-success btn-xs "><i class="fa fa-check"></i></button></span>

                            <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>

                          </div>

                        </div>

                        <div class="col-xs-3">
              
                          <input type="number"  readonly class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                        </div>

                        <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                   
                            <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
   
                          </div>
               
                        </div>

                      </div>';
                }
              }else{
                
              }

                ?>

                </div>


                <div class="form-group row nuevoCristal">

<?php
 
$listaCristal = json_decode($venta["cristales"], true);
if($listaCristal){

foreach ($listaCristal as $key => $value) {

  $item = "id";
  $valor = $value["id"];
  $orden = "id";

  $respuesta = ControladorCristales::ctrMostrarCristales($item, $valor, $orden);

  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
  
  echo '<div class="row" style="padding:5px 15px">

        <div class="col-xs-6" style="padding-right:0px">

          <div class="input-group">

            <span class="input-group-addon"><button type="button" class="btn btn-success btn-xs "><i class="fa fa-check"></i></button></span>

            <input type="text" class="form-control nuevaDescripcionCristal" idCristal ="'.$value["id"].'" name="agregarCristal" value="'.$value["descripcion"].'" readonly required>

          </div>

        </div>

        <div class="col-xs-3">

          <input type="number"  readonly class="form-control nuevaCantidadCristal" name="nuevaCantidadCristal" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

        </div>

        <div class="col-xs-3 ingresoPrecioCristal" style="padding-left:0px">

          <div class="input-group">

            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
   
            <input type="text" class="form-control nuevoPrecioCristal" precioRealCristal="'.$respuesta["precio_venta"].'" name="nuevoPrecioCristal" value="'.$value["total"].'" readonly required>

          </div>

        </div>

      </div>';
}
}else{

}

?>

</div>


                <input type="hidden" id="listaProductos" name="listaProductos">
                <input type="hidden" id="listaCristales" name="listaCristales">


                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button class="btn btn-primary" id="link">Tasa del Dia </button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-md-10 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Tasa del Día</th>
                          <th>Impuesto</th>
                          <th>Total En $</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                        <td style="width: 30%">
                            
                            <div class="input-group">
                              
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="tasadeldiaeditar" name="tasadeldiaeditar" total="" placeholder="00000" >

                              <input type="hidden" name="tasadiae" id="tasadiae">
                              
            
                            </div>
                          </td>

                        <td style="width: 30%">
                            
                            <div class="input-group">
                           
                              <input type="number"  value="16" class="form-control input-lg" min="0" id="impuesto" readonly name="impuesto" placeholder="0" required>


                              <input type="hidden" name="precioimpuesto" id="precioimpuesto" required>


                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>


                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta"   value="<?php echo $venta["totaldolar"]; ?>" readonly required>

                              <input type="hidden" name="totalVenta" value="<?php echo $venta["totaldolar"]; ?>" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <div class="col-md-8 pull-right">
                    
                    <table class="table">

                      <thead>
                      <th>Falta por Pagar En Bs</th>  
                      <th>Total En Bolivares</th>  
                          

                       

                      </thead>

                      <tbody>
                      
                        
                    <tr>
                    <td style="width: 50%">

<div class="input-group">

  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

  <input type="text" class="form-control input-lg" id="falta_por_pagar_b" name="falta_por_pagar_b" total="" placeholder="00000" readonly required>

  <input type="hidden" name="faltab" id="faltab">



</div>
</td>
                    <td style="width: 50%">

                      <div class="input-group">
    
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                        <input type="text" class="form-control input-lg" id="resultadobolivareditar" name="resultadobolivareditar" total="" placeholder="00000" readonly required>

                        <input type="hidden" name="resultadoeditarb" id="resultadoeditarb">
      


                      </div>
                    </td>
                    
                    </tr>
                       
                      </tbody>

                    </table>

                  </div>



                  <div class="as col-md-4">
                    
                    <table class="table">

                      <thead>
                        
                      <th>Falta Por Pagar en $</th>  
                                                

                      </thead>
                      <tbody>
                                             
                    <tr>                   
                    <td style="width: 50%">

                      <div class="input-group">
    
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                        <input type="text" class="form-control input-lg" id="falta_por_dolares_2" name="falta_por_dolares_2" value="<?php echo $venta["falta"]; ?>"  total="" placeholder="00000" readonly required>

                        <input type="hidden" name="falta_por_dol_2" id="falta_por_dol_2">
      


                      </div>
                    </td>                   
                    </tr>
                       
                      </tbody>

                    </table>

                  </div>



                </div>

                <hr>



<div>




</div>


                    

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->
<br>

                <div id="mostrarOcultar">
                <h3 class="cout">Agregar 2 Pago </h3>

				 	  <div class="form-group row">

<div class="col-xs-6" style="padding-right:0px">
         
<div class="input-group">

 <select class="form-control" id="nuevoMetodoPago2" name="nuevoMetodoPago2" >
 <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Divisas">Divisas</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>    
                        <option value="TRANS">Transferencia</option>     
                        <option value="PM">Pago Movil</option>     
 </select>

 </div>

</div>

<div class="cajasMetodoPago2"></div>
<input type="hidden" id="listaMetodoPago2" name="listaMetodoPago2">

</div>
</div>

                
     
<br>
          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

          </div>

        </form>

<div>
<?php


          $editarVenta = new ControladorVentas();
          $editarVenta -> ctrEditarVenta();
          
?>
</div>
        

        </div>
            
      </div>


    </div>
   
  </section>

</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>




<div id="myModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h3 style="text-align:center">Precio Del Dolar</h3>
            </div>
            <div class="modal-body">
                <iframe width="575" height="450" frameborder="0" allowfullscreen=""></iframe>
            </div>
            <div class="modal-footer">

            <strong>Copyright &copy; 2020 <a href="#" target="_blank">Artic Solutions</a>.</strong>
            Todos los derechos reservados.
            <strong>Version 1.0</strong>

            </div>
        </div>
    </div>
</div>




<script>
    $('#link').click(function () {
        var src = 'https://monitordolarvenezuela.com/';
        $('#myModal').modal('show');
        $('#myModal iframe').attr('src', src);
    });

    $('#myModal button').click(function () {
        $('#myModal iframe').removeAttr('src');
    });
</script>