      <div class="container">
      		<div class="panel panel-info">
      		<div class="panel-heading">
      		    <div class="btn-group pull-right">
      				<button type='button' class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" ></span> Nuevo Usuario</button>
      			</div>
      			<h4><i class='glyphicon glyphicon-search'></i> Buscar Usuarios</h4>
      		</div>
      			<div class="panel-body">
      			<form class="form-horizontal" role="form" id="datos_cotizacion">

      						<div class="form-group row">
      							<label for="q" class="col-md-2 control-label">Nombres:</label>
      							<div class="col-md-5">
      								<input type="text" class="form-control" id="q" placeholder="Nombre" onkeyup='load(1);'>
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
                       <th>ID</th>
                       <th>Nombres</th>
                       <th>Usuario</th>
                       <th>Email</th>
                       <th>Agregado</th>
                       <th><span class="pull-right">Acciones</span></th>
                      </tr>
                      <?php
                        if($usuarios != null)
                        {
                          foreach ($usuarios->result() as $fila) {

                      ?>

                      <input type="hidden" value="<?= $fila->firstname ?>" id="nombres<?= $fila->user_id;?>">
					            <input type="hidden" value="<?= $fila->lastname ?>" id="apellidos<?= $fila->user_id;?>">
					            <input type="hidden" value="<?= $fila->user_name;?>" id="usuario<?= $fila->user_id;?>">
					            <input type="hidden" value="<?= $fila->user_email;?>" id="email<?= $fila->user_id;?>">

                      <tr>
                        <td><?= $fila->user_id ?></td>
                        <td><?= $fila->firstname . " " . $fila->lastname; ?></td>
                        <td><?= $fila->user_name ?></td>
                        <td><?= $fila->user_email ?></td>
                        <td><?= $fila->date_added;?></td>

            					   <td >
                           <span class="pull-right">
                             <a href="#" class='btn btn-default' title='Editar usuario' onclick="obtener_datos('<?= $fila->user_id;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
                             <a href="#" class='btn btn-default' title='Cambiar contraseña' onclick="get_user_id('<?= $fila->user_id;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-cog"></i></a>
                             <a href="#" class='btn btn-default' title='Borrar usuario' onclick="eliminar('<?= $fila->user_id; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
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
