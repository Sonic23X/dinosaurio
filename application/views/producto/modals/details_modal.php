
			<div class="modal fade" id="detales">
				<div class="modal-dialog  modal-lg">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Detalles del producto</h4>
				  	</div>

						<div class="modal-body">

              <div id="imagen_product">
                <center>
                  <h4>Imagen del producto</h4>
                </center>
                <hr>
                <center>
                  <img id="image_prod" src="" alt="Producto" style="width: 200px; height: 200px;">
                </center>
                <br>
                <?php
                  $partes = array ('id' => 'changeimg', 'style' => 'Display: none');
                   echo form_open_multipart('Product/UpdateImage', $partes) ?>
                   <input type="text" name="id" id="id" value="" style="display: none">
                  <input class='filestyle' data-buttonText="Logo" type="file" id="imagefile" name="imagefile">
                <?= form_close() ?>
              </div>

              <div id="detalles_product">
                <center>
                  <h4>Detalles</h4>
                </center>

                <br>
                <div class="form-group">
									<label for="codigo" class="col-sm-3 control-label">Código</label>
									<div class="col-sm-8">
										 <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required disabled>
									</div>
								</div>
                <br>
                <br>
                <br>
								<div class="form-group">
									<label for="nombre" class="col-sm-3 control-label">Nombre</label>
									<div class="col-sm-8">
										<textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" disabled ></textarea>
									</div>
								</div>
                <br>
                <br>
                <br>
								<div class="form-group">
									<label for="estado" class="col-sm-3 control-label">Estado</label>
									<div class="col-sm-8">
										<select class="form-control" id="estado" name="estado" required disabled>
											<option value="1" selected>Activo</option>
											<option value="0">Inactivo</option>
										</select>
									</div>
								</div>
                <br>
                <br>
                <br>
								<div class="form-group">
									<label for="precio" class="col-sm-3 control-label">Precio</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta del producto" disabled required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
									</div>
								</div>

              </div>

            </div>

						<div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="edit">Editar</button>
              <button type="submit" class="btn btn-danger" id="delete">Eliminar</button>
              <button type="button" class="btn btn-default" id="cerrar">Cerrar</button>
              <button type="button" class="btn btn-default" id="cancelar" style="Display: none">Cancelar</button>
              <button type="submit" class="btn btn-primary" id="guardar" style="Display: none">Guardar Cambios</button>
						</div>

					</div>
				</div>
			</div>

      <script type="text/javascript">

      $(document).ready(function() {

        $('#imagefile').change(function(event) {

          event.preventDefault();

          var formData = new FormData($('#changeimg')[0]);

          $.ajax({
            url: $('#changeimg').attr('action'),
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response)
            {
              console.log(response);
              if(response.indexOf("http") > -1)
                $('#image_prod').attr('src', response);
              else
                alert("Error al cambiar la imagen");
            }
          });

        });

        $('#edit').click(function(event) {

          $('#estado').removeAttr('disabled');
          $('#codigo').removeAttr('disabled');
          $('#precio').removeAttr('disabled');
          $('#nombre').removeAttr('disabled');
          $('#changeimg').removeAttr('style');

          $('#delete').attr('style', 'Display: none');
          $('#cerrar').attr('style', 'Display: none');
					$('#edit').attr('style', 'Display: none');

					$('#cancelar').removeAttr('style');
					$('#guardar	').removeAttr('style');

        });

				$('#cancelar').click(function(event) {


            $('#estado').attr('disabled', 'disabled');
            $('#codigo').attr('disabled', 'disabled');
            $('#precio').attr('disabled', 'disabled');
            $('#nombre').attr('disabled', 'disabled');
            $('#changeimg').attr('style', 'Display: none');

            $('#delete').removeAttr('style');
            $('#cerrar').removeAttr('style');
						$('#edit').removeAttr('style');

						$('#cancelar').attr('style', 'Display: none');
						$('#guardar').attr('style', 'Display: none');

        });

				$('#delete').click(function(event) {

					var pregunta = confirm("¿Realmete desea eliminar este producto?");

					if(pregunta == true)
					{
						var id = $('#id').val();						
						$.ajax({
							url: '<?= base_url() ?>Product/Delete',
							type: 'post',
							data: "id=" + id,
							success: function(response)
							{
								if(response == "true")
								{
									alert("Producto eliminado con exito");
									$('#detales').modal('toggle');
									location.reload();
								}
								else
								{
									alert("Error al eliminar el registro, intentelo mas tarde");
									$('#detales').modal('toggle');
								}
							}
						});

					}

				});

				$('#guardar').click(function(event) {

					event.preventDefault();

					var id = $('#id').val();
					var codigo = $('#codigo').val();
					var nombre = $('#nombre').val();
					var estado = $('#estado').val();
					var precio = $('#precio').val();

					var cadena = "id=" + id + "&codigo=" + codigo + "&nombre=" + nombre + "&estado=" + estado + "&precio=" + precio;

					$.ajax({
						url: '<?= base_url() ?>Product/Update',
						type: 'post',
						data: cadena,
						success: function(response) {
							if(response = "true")
							{
								alert("Cambios completados con exito");

								$('#estado').attr('disabled', 'disabled');
								$('#codigo').attr('disabled', 'disabled');
								$('#precio').attr('disabled', 'disabled');
								$('#nombre').attr('disabled', 'disabled');
								$('#changeimg').attr('style', 'Display: none');

								$('#delete').removeAttr('style');
								$('#cerrar').removeAttr('style');
								$('#edit').removeAttr('style');

								$('#cancelar').attr('style', 'Display: none');
								$('#guardar').attr('style', 'Display: none');
							}
							else
							{
								alert("Error, intente mas tarde");

								$('#modal').modal(toggle);
								$('#estado').attr('disabled', 'disabled');
								$('#codigo').attr('disabled', 'disabled');
								$('#precio').attr('disabled', 'disabled');
								$('#nombre').attr('disabled', 'disabled');
								$('#changeimg').attr('style', 'Display: none');

								$('#delete').removeAttr('style');
								$('#cerrar').removeAttr('style');
								$('#edit').removeAttr('style');

								$('#cancelar').attr('style', 'Display: none');
								$('#guardar').attr('style', 'Display: none');
							}
						}
					});

				});

				$('#cerrar').click(function(event) {
					$('#detales').modal('toggle');
					location.reload();
				});

      });

      </script>
