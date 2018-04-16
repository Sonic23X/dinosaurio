<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Nueva Factura</h4>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="datos_factura">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
				  <div class="col-md-3">
					  <select class="form-control input-sm" id="cliente">
							<option value="" style="Display: none"></option>
              <?php
              if($clientes != null)
              {
                foreach ($clientes->result() as $fila)
                {
                  ?>
                <option value="<?= $fila->id_cliente ?>"><?= $fila->nombre_cliente ?></option>
                  <?php
                }
                ?>
                <?php
              }
              ?>
            </select>
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
				 </div>
						<div class="form-group row">
							<label for="empresa" class="col-md-1 control-label">Vendedor</label>
							<div class="col-md-3">
								<select class="form-control input-sm" id="id_vendedor">
                  <?php
                  if($usuarios != null)
                  {
                    foreach ($usuarios->result() as $fila)
                    {
                      ?>
                    <option value="<?= $fila->user_id ?>"><?= $fila->firstname . " " . $fila->lastname ?></option>
                      <?php
                    }
                    ?>
                    <?php
                  }
                  ?>
								</select>
							</div>
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>
							</div>
						</div>


				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
						 <span class="glyphicon glyphicon-user"></span> Nuevo cliente
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>
				</div>
			</form>

		</div>
	</div>

  <div class="row-fluid">
		<div class="col-md-12">

			</div>
		</div>

	</div>

	<script type="text/javascript">

		$(document).ready(function() {

			$('#cliente').change(function(event) {

				var id = $('#cliente').val();

				$.ajax({
					url: '<?= base_url() ?>Invoice/SearchClient',
					type: 'POST',
					data: {id: id},
					success: function(response)
					{
						var datos = response.split(';');
						$('#tel1').val(datos[0]);
						$('#mail').val(datos[1]);
					}
				});

			});

			$('#guardar_cliente').submit(function(event) {

		    event.preventDefault();

		    var nombre =$('#nombre').val();
		    var telefono =$('#telefono').val();
		    var email =$('#email').val();
		    var direccion =$('#direccion').val();
		    var estado =$('#estado').val();

		    $.ajax({
		      url: 'http://localhost/dinosaurio/Client/Insert',
		      type: 'post',
		      data: 'nombre=' + nombre + '&telefono=' + telefono + '&email=' + email + '&direccion=' + direccion + '&estado=' + estado,
		      success: function(response)
		      {
		        if(response == "true")
		        {
		          alert("registro completado!");
		          $('#nuevoCliente').modal('toggle');
		          location.reload();
		        }
		        else
		        {
		          alert("Error, intente de nuevo mas tarde");
		          $('#nuevoCliente').modal('toggle');
		        }
		      }
		    });

		  });

		});

	</script>
