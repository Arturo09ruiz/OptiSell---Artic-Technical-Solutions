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
      Administrar Pedidos Entregados
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Entregados</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaentregados" width="100%">

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
              <th>Fecha Entregado</th>
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



<?php

$eliminarterminados = new Controladorterminados();
$eliminarterminados->ctrEliminarterminados();

?>