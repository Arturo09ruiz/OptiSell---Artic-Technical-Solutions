<?php
if($_SESSION["perfil"] == "Laboratorio")
'<!DOCTYPE html>
<html>
  <head>
  <META HTTP-EQUIV="REFRESH" CONTENT="5;URL=">
  </head>
</html>'
?>

<script>
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>


<style>
 .gh{
        transform: translate(400px);
      }
      .test{
    top: -7.5px;
    transform: translate(-100px);

  }
</style>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1 class="gh">
      
      Administrar Pedidos A Laboratorios Externos
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Pedidos A Laboratorios Externos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarpedidos">
          
          Agregar Pedido

        </button>

      </div>


      <div>
        
<form id="pruebapedidos" role="form" method="post" enctype="multipart/form-data">

<input type="hidden"  id="medida_terminado" name="medida_terminado" type="text">
<input type="hidden" id="tipo_terminado" name="tipo_terminado" type="text">
<input type="hidden" id="codigo_terminado" name="codigo_terminado" type="text">
<input type="hidden" id="lugar_terminado" name="lugar_terminado" type="text">
<input type="hidden" id="descripcion_terminado" name="descripcion_terminado" type="text">
<input type="hidden" id="stock_terminado" name="stock_terminado" type="text">
<input type="hidden" id="precio_de_compra_terminado" name="precio_de_compra_terminado" type="text">
<input type="hidden" id="precio_de_venta_terminado" name="precio_de_venta_terminado" type="text">
<input type="hidden" id="fecha_terminado" name="fecha_terminado" type="text">
<input  type="hidden" id="fecha_de_terminado" name="fecha_de_terminado" type="text">


</form>

<?php
  $crearllegados = new Controladorllegados();
  $crearllegados -> ctrCrearllegados();
?>  

</div>



      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablapedidos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Tipo</th>
           <th>Fórmula</th>
           <th>Descripción</th>
           <th>Laboratorio</th>
           <th>Stock</th>
           <th>Precio de Compra</th>
           <th>Precio de venta</th>
           <th>Agregado</th>
           <th>Estado</th>
           <th>Acciones</th>
           <!--<th>Status</th>
           <th>Imprimir</th>-->

           
         </tr> 

        </thead>      

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>




<!--=====================================
MODAL AGREGAR PEDIDO AL LABORATORIO LOCAL
======================================-->

<div id="modalAgregarpedidos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pedido</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <div class="form-group">

<div class="input-group">

  <span class="input-group-addon"><i class="fa fa-th"></i></span> 

  <select class=" form-control input-lg" id="nuevoTipo" name="nuevoTipo" required>

    <option value="">Tipo De Cristal</option>

    <?php

    $item = null;
    $valor = null;

    $tipo = ControladorTipo::ctrMostrarTipo($item, $valor);

    foreach ($tipo as $key => $value) {
  
      echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
    } 

    ?>

  </select>
</div>
</div>







<!-- ENTRADA PARA AUMENTO DEL CRISTAL  -->

<div class="form-group">

<div class="input-group">

<span class="input-group-addon"><i class="fa fa-th"></i></span> 


<input type="text" class="form-control input-lg" name="nuevoMedida" placeholder="Ingresar Fórmula" required>

</div>

</div>


            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 


                <select class="form-control input-lg" id="nuevoLugar" name="nuevoLugar" required>
                  
                  <option value="">Selecionar Laboratorio</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $laboratorios = Controladorlaboratorios::ctrMostrarlaboratorios($item, $valor);

                  foreach ($laboratorios as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["laboratorio"].'</option>';
                  }

                  ?>
  
                </select>
  



              </div>


            </div>
             <!-- ENTRADA PARA TIPO DE CRISTAL -->
         
            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>
              
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>

              </div>

            </div>
            
             <!-- ENTRADA PARA PRECIO COMPRA -->
             <div class="form-group row">

<div class="col-xs-6">

  <div class="input-group">
  
    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>

  </div>

</div>

<!-- ENTRADA PARA PRECIO VENTA -->

<div class="col-xs-6">

  <div class="input-group">
  
    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

  </div>

  <br>

  <!-- CHECKBOX PARA PORCENTAJE -->

  <div class="col-xs-6">
    
    <div class="form-group">
      
      <label>
        
        <input type="checkbox" class="minimal porcentaje" checked>
        Utilizar procentaje
      </label>

    </div>

  </div>

  <!-- ENTRADA PARA PORCENTAJE -->

  <div class="col-xs-6" style="padding:0">
    
    <div class="input-group">
      
      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

    </div>

  </div>

</div>

            
            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Pedido</button>

        </div>

      </form>

        <?php

          $crearpedidos = new Controladorpedidos();
          $crearpedidos -> ctrCrearpedidos();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PEDIDO AL LABORATORIO LOCAL
======================================-->

<div id="modalEditarpedidos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Pedido</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

      
        <div class="modal-body">

          <div class="box-body">
          
        

            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>
         

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

        <?php

          $editarpedidos = new Controladorpedidos();
          $editarpedidos -> ctrEditarpedidos();

        ?>      

    </div>

  </div>

</div>

<?php

  $eliminarpedidos = new Controladorpedidos();
  $eliminarpedidos -> ctrEliminarpedidos();

?>      



</html>