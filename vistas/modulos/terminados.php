<?php

$ctrCrearterminados = new Controladorterminados();
$ctrCrearterminados->ctrCrearterminados();

?>


<script>
  // In your Javascript (external .js resource or <script> tag)
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>

<style>
 .gh{
        transform: translate(480px);
      }
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1 class="gh">
      Administrar Pedidos Terminados
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Terminados</li>

    </ol>


    <div>
        
        <form id="prueba-entregados" role="form" method="post" enctype="multipart/form-data">
        
        <input type="hidden"  id="medida_entregado" name="medida_entregado" type="text">
        <input type="hidden" id="tipo_entregado" name="tipo_entregado" type="text">
        <input type="hidden" id="codigo_entregado" name="codigo_entregado" type="text">
        <input type="hidden" id="descripcion_entregado" name="descripcion_entregado" type="text">       
        <input type="hidden" id="stock_entregado" name="stock_entregado" type="text">        
        <input type="hidden" id="precio_de_compra_entregado" name="precio_de_compra_entregado" type="text">
        <input type="hidden" id="precio_de_venta_entregado" name="precio_de_venta_entregado" type="text">
        <input type="hidden" id="fecha_entregado" name="fecha_entregado" type="text">
        <input type="hidden" id="fecha_pedido_entregado" name="fecha_pedido_entregado" type="text">

        
        
        </form>
        
        <?php
          $crearentregados = new Controladorentregados();
          $crearentregados -> ctrCrearentregados();
        ?>  
        
        </div>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaterminados" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Tipo</th>
              <th>Fórmula</th>
              <th>Descripción</th>
              <th>Stock</th>
              <th>Precio de compra</th>
              <th>Precio de venta</th>
              <th>Fecha de Pedido</th>
              <th>Fecha Terminado</th>
              <th>Status</th>

              <!--<th>Acciones</th>
           <th>Status</th>
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
MODAL AGREGAR PEDIDO
======================================-->


        <!--=====================================
        PIE DEL MODAL
        ======================================-->




<?php

$eliminarterminados = new Controladorterminados();
$eliminarterminados->ctrEliminarterminados();

?>