<div class="container">
		<div class="panel panel-info">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<a  href="<?= base_url() ?>Invoice/Nuevo" class="btn btn-info"><span class="glyphicon glyphicon-plus" ></span> Nueva Factura</a>
			</div>
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Facturas</h4>
		</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">

						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Cliente o # de factura</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del cliente o # de factura">
							</div>

							<div class="col-md-3">
								<button type="button" class="btn btn-default">
									<span class="glyphicon glyphicon-search" ></span> Buscar</button>
								<span id="loader"></span>
							</div>

						</div>

			</form>
				<div class='outer_div'>

          <div class="table-responsive">
            <table class="table">
              <tr  class="info">
                <th>#</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Estado</th>
                <th>Total</th>
                <th class='text-right'>Acciones</th>
              </tr>
              <?php
                if($factura != null)
                {
                  foreach ($factura->result() as $fila)
                  {

                    if ($fila->estado_factura == 1)
                    {
                      $text_estado="Pagada";
                      $label_class='label-success';
                    }
						        else
                    {
                      $text_estado="Pendiente";
                      $label_class='label-warning';
                    }
              ?>
              <tr>
                <td><?= $fila->numero_factura ?></td>
                <td><?= date("d/m/Y", strtotime($fila->fecha_factura)) ?></td>
                <td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i>
                  <?php echo $fila->telefono_cliente;?><br><i class='glyphicon glyphicon-envelope'></i>
                  <?php echo $fila->email_cliente;?>" ><?= $fila->nombre_cliente ?></a></td>
                <td><?= $fila->firstname . " " . $fila->lastname ?></td>
                <td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
                <td><?= number_format($fila->total_venta,2); ?></td>

                 <td >
                   <span class="pull-right">
                     <a href="<?=base_url() ?>Invoice/Editar/<?= $fila->id_factura ?>" class='btn btn-default' title='Editar factura' ><i class="glyphicon glyphicon-edit"></i></a>
          						<a href="#" class='btn btn-default' title='Descargar factura' onclick="imprimir_factura('<?php echo $fila->id_factura;?>');"><i class="glyphicon glyphicon-download"></i></a>
          						<a href="#" class='btn btn-default' title='Borrar factura' onclick="eliminar('<?php echo $fila->numero_factura; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
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

        </div>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="<?= base_url() ?>resources/js/invoice.js"></script>
