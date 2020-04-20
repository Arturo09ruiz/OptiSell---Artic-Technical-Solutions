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
</style> 


<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1 class="gh">
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>
<br>
  <section class="">

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

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  

                    }else{

                      foreach ($ventas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="js-example-basic-single form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

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

                

                </div>
                <div class="form-group row nuevoCristal">

                

                </div>
                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default lg btnAgregarProducto">Agregar Montura</button>
                <button type="button" class="btn btn-default lg btnAgregarCristal">Agregar Cristal</button>
                <button type="button" class="btn btn-default lg btnLaboratorioExterno">Laboratorio Externo</button>                
                <button type="button" class="btn btn-default lg btnLaboratorioLocal">Laboratorio Local</button>
                <button class="btn btn-primary" id="link">Tasa del Dia </button>





                



               

                <input type="hidden" id="listaCristales" name="listaCristales">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->


                <hr>







                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-md-10 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Tasa del Dia</th>
                          <th>Impuesto</th>
                          <th>Total En $</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                           
                        <td style="width: 30%">
                            
                            <div class="input-group">
                              
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="tasadeldia" name="tasadeldia" total="" placeholder="00000" >

                              <input type="hidden" name="tasadia" id="tasadia">
                              
            
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

                              <input type="text" class="form-control input-lg" id="resultadoventa" name="resultadoventa" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="resultado" id="resultado">
                              
            
                        
                            </div>
                          </td>

                            <div class="input-group">
                              
                              <input type="hidden" class="form-control input-lg" id="impuestototal" name="resultadoventa" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="impuestoo" id="impuestoo">          
                        
                            </div>


                   

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           

                              <input type="hidden" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                        
                            
                            <div class="input-group">
                           

                              <input type="hidden" class="form-control input-lg" id="nuevoTotalVentaCristal" name="nuevoTotalVentaCristal" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVentaCristal" id="totalVentaCristal">
                              
                        
                            </div>

                        
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

  <input type="text" class="form-control input-lg" id="falta_por_pagar" name="falta_por_pagar" total="" placeholder="00000" readonly required>

  <input type="hidden" name="falta" id="falta">



</div>
</td>
                    <td style="width: 50%">

                      <div class="input-group">
    
                        <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                        <input type="text" class="form-control input-lg" id="resultadobolivar" name="resultadobolivar" total="" placeholder="00000" readonly required>

                        <input type="hidden" name="resultadobo" id="resultadobo">
      


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

                        <input type="text" class="form-control input-lg" id="falta_por_dolares" name="falta_por_dolares" total="" placeholder="00000" readonly required>

                        <input type="hidden" name="falta_por_dol" id="falta_por_dol">
      


                      </div>
                    </td>                   
                    </tr>
                       
                      </tbody>

                    </table>

                  </div>


                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
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

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

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