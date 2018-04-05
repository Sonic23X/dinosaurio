
			<div class="modal fade" id="detales">
				<div class="modal-dialog  modal-lg">
					<div class="modal-content">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                  $partes = array ('id' => 'changeimg');
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
                <br>
                <br>
                <div class="form-group">
									<label for="codigo" class="col-sm-3 control-label">Código</label>
									<div class="col-sm-8">
										 <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
									</div>
								</div>
                <br>
                <br>
                <br>
								<div class="form-group">
									<label for="nombre" class="col-sm-3 control-label">Nombre</label>
									<div class="col-sm-8">
										<textarea class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required maxlength="255" ></textarea>
									</div>
								</div>
                <br>
                <br>
                <br>
								<div class="form-group">
									<label for="estado" class="col-sm-3 control-label">Estado</label>
									<div class="col-sm-8">
										<select class="form-control" id="estado" name="estado" required>
											<option value="">-- Selecciona estado --</option>
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
										<input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de venta del producto" required pattern="^[0-9]{1,5}(\.[0-9]{0,2})?$" title="Ingresa sólo números con 0 ó 2 decimales" maxlength="8">
									</div>
								</div>

              </div>

            </div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
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

      });

      </script>
