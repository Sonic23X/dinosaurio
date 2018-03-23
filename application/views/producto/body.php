<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">
        <div class="btn-group pull-right">
        <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoProducto"><span class="glyphicon glyphicon-plus" ></span> Nuevo Producto</button>
      </div>
      <h4><i class='glyphicon glyphicon-search'></i> Buscar Productos</h4>
    </div>
    <div class="panel-body">
      <form class="form-horizontal" role="form" id="datos_cotizacion">

            <div class="form-group row">
              <label for="q" class="col-md-2 control-label">Código o nombre</label>
              <div class="col-md-5">
                <input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
              </div>
              <div class="col-md-3">
                <button type="button" class="btn btn-default" onclick='load(1);'>
                  <span class="glyphicon glyphicon-search" ></span> Buscar</button>
                <span id="loader"></span>
              </div>

            </div>
      </form>
        <div id="resultados"></div><!-- Carga los datos ajax -->
        <div class='outer_div'>
          <div class="table-responsive">
			  <table class="table">
  				<tr  class="info">
  					<th>Código</th>
  					<th>Producto</th>
  					<th>Estado</th>
  					<th>Agregado</th>
  					<th class='text-right'>Precio</th>
  					<th class='text-right'>Acciones</th>
          </tr>
          <?php
            if($productos != null)
            {
              foreach ($productos->result() as $fila)
              {
                if ($fila->status_producto == "1")
                  {
                    $estado="Activo";
                  }
						    else
                {
                  $estado="Inactivo";
                }

          ?>

          <input type="hidden" value="<?php echo $fila->codigo_producto;?>" id="codigo_producto<?php echo $fila->id_producto;?>">
					<input type="hidden" value="<?php echo $fila->nombre_producto;?>" id="nombre_producto<?php echo $fila->id_producto;?>">
					<input type="hidden" value="<?php echo $fila->status_producto;?>" id="estado<?php echo $fila->id_producto;?>">
					<input type="hidden" value="<?php echo number_format($fila->precio_producto,2,'.','');?>" id="precio_producto<?php echo $fila->id_producto;?>">

            <tr>
              <td><?= $fila->codigo_producto ?></td>
              <td><?= $fila->nombre_producto ?></td>
              <td><?= $estado ?></td>
              <td><?= $fila->date_added ?></td>
              <td><?= $fila->moneda;?><span class='pull-right'><?php echo number_format($fila->precio_producto,2);?></span></td>

             <td >
               <span class="pull-right">
                 <a href="#" class='btn btn-default' title='Editar producto' onclick="obtener_datos('<?php echo $fila->id_producto;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
					       <a href="#" class='btn btn-default' title='Borrar producto' onclick="eliminar('<?php echo $fila->id_producto; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
               </span>
             </td>
          </tr>
          <?php
              }
            ?>
          <tr>
            <td colspan=9>
              <span class="pull-right">
            <?php

              echo $pagination;

            ?>
              </span>
            </td>
          </tr>
          <?php
            }
          ?>

        </div><!-- Carga los datos ajax -->

  </div>
  </div>

</div>
