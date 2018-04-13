      <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 toppad" >

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title"><i class='glyphicon glyphicon-cog'></i> Configuración</h3>
                </div>
                <div class="panel-body">
                <div class="row">

                  <div class="col-xs-9 col-sm-9 col-md-3 col-lg-3  " align="center">
                    <div id="load_img">
                      <img id="imagen_logo" class="img-responsive" src="<?= base_url() ?>resources/img/<?= $logo_url ?>" alt="Logo">
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <?php
                          $partes = array ('id' => 'changeimg');
                           echo form_open_multipart('Settings/UpdateImage', $partes) ?>
                          <input class='filestyle' data-buttonText="Logo" type="file" id="imagefile" name="imagefile">
                          <?= form_close() ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <form id="perfil" action="<?= base_url('Settings/Update') ?>">
                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-condensed">
                      <tbody>
                        <tr>
                          <td class='col-md-3'>Nombre de la empresa:</td>
                          <td><input type="text" class="form-control input-sm" id="nombre_empresa" value="<?= $nombre_empresa ?>" required></td>
                        </tr>
                        <tr>
                          <td>Teléfono:</td>
                          <td><input type="text" class="form-control input-sm" id="telefono" value="<?= $telefono ?>" required></td>
                        </tr>
                        <tr>
                          <td>Correo electrónico:</td>
                          <td><input type="email" class="form-control input-sm" id="email" value="<?= $email ?>" ></td>
                        </tr>
                        <tr>
                          <td>IVA (%):</td>
                          <td>
                            <select class="form-control input-sm" id="impuesto">
                              <option value="15">15%</option>
                              <option value="16">16%</option>
                              <option value="18">18%</option>
                              <option value="21">21%</option>
                              <option value="31">31%</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Simbolo de moneda:</td>
                          <td>
