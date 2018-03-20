      <div class="container">
      	<div class="panel panel-info">
      		<div class="panel-heading">
      		    <div class="btn-group pull-right">
      				      <button type='button' class="btn btn-info" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Cliente</button>
      			  </div>
              <h4><i class='glyphicon glyphicon-search'></i> Buscar Clientes</h4>
          </div>

      		<div class="panel-body">
      			<form class="form-horizontal" role="form" id="datos_cotizacion">
              <div class="form-group row">
                <label for="q" class="col-md-2 control-label">Cliente</label>
                <div class="col-md-5">
                  <input type="text" class="form-control" id="q" placeholder="Nombre del cliente" onkeyup='load(1);'>
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn btn-default" onclick='load(1);'>
                    <span class="glyphicon glyphicon-search" ></span> Buscar</button>
      							<span id="loader"></span>
      					</div>
      				</div>
      			</form>
    				<div id="resultados"></div>
    				<div class='outer_div'>

              <div class="table-responsive">
        			  <table class="table">
          				<tr  class="info">
          					<th>Nombre</th>
          					<th>Teléfono</th>
          					<th>Email</th>
          					<th>Dirección</th>
          					<th>Estado</th>
          					<th>Agregado</th>
          					<th class='text-right'>Acciones</th>
          				</tr>
                  <?php
                    if($clientes != null)
                    {
                      foreach ($clientes->result() as $fila) {

                        if ($fila->status_cliente==1)
                          $estado="Activo";
			                  else
                          $estado="Inactivo";
                  ?>

                  <input type="hidden" value="<?= $fila->nombre_cliente;?>" id="nombre_cliente<?= $fila->id_cliente;?>">
        					<input type="hidden" value="<?= $fila->telefono_cliente;?>" id="telefono_cliente<?= $fila->id_cliente;?>">
        					<input type="hidden" value="<?= $fila->email_cliente;?>" id="email_cliente<?= $fila->id_cliente;?>">
        					<input type="hidden" value="<?= $fila->direccion_cliente;?>" id="direccion_cliente<?= $fila->id_cliente;?>">
        					<input type="hidden" value="<?= $fila->status_cliente;?>" id="status_cliente<?= $fila->id_cliente;?>">

                  <tr>
                    <td><?= $fila->nombre_cliente ?></td>
        						<td><?= $fila->telefono_cliente ?></td>
        						<td><?= $fila->email_cliente ?></td>
        						<td><?= $fila->direccion_cliente ?></td>
        						<td><?= $estado ?></td>
        						<td><?= $fila->date_added ?></td>

                     <td >
                       <span class="pull-right">
                         <a href="#" class='btn btn-default' title='Editar cliente' onclick="obtener_datos('<?= $fila->id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
					               <a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?= $fila->id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
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
