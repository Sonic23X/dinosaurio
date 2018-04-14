
			<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo producto</h4>
				  	</div>

						<div class="modal-body">
							<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
								<div class="form-group">
									<label for="codigo" class="col-sm-3 control-label">Código</label>
									<div class="col-sm-8">
										 <input type="number" min=1 max=999 class="form-control" id="n_codigo" name="codigo" placeholder="Código del producto" required>
									</div>
								</div>

								<div class="form-group">
									<label for="nombre" class="col-sm-3 control-label">Nombre</label>
									<div class="col-sm-8">
										<textarea class="form-control" id="n_nombre" name="nombre" placeholder="Nombre del producto" required maxlength="20" ></textarea>
									</div>
								</div>

								<div class="form-group">
									<label for="estado" class="col-sm-3 control-label">Estado</label>
									<div class="col-sm-8">
										<select class="form-control" id="n_estado" name="estado" required>
											<option value="">-- Selecciona estado --</option>
											<option value="1" selected>Activo</option>
											<option value="0">Inactivo</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="precio" class="col-sm-3 control-label">Precio</label>
									<div class="col-sm-8">
										<input type="number" min=1 max=99999 class="form-control" id="n_precio" name="precio" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales">
									</div>
								</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<script type="text/javascript">

			$(document).ready(function() {

				$('#guardar_producto').submit(function(event) {

					event.preventDefault();

					var codigo = $('#n_codigo').val();
					var nombre = $('#n_nombre').val();
					var estado = $('#n_estado').val();
					var precio = $('#n_precio').val();

					$.ajax({
						url: '<?= base_url() ?>Product/Insert',
						type: 'POST',
						data: 'codigo=' + codigo + '&nombre=' + nombre + '&estado=' + estado + '&precio=' + precio,
						success: function(response)
						{
							$('#nuevoProducto').modal('toggle');
							alert(response);
							location.reload();
						}
					});

				});

			});

			</script>
