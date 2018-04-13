    <section>
      <?php
        if($this->session->userdata('sear') == null)
        {
      ?>
      <div class="input-group">
        <input id="busqueda" type="text" class="form-control" placeholder="Busqueda">
        <span class="input-group-addon">
          <i class="glyphicon glyphicon-search"></i>
        </span>
      </div>
      <?php
        }
        else
        {
      ?>
        <br>
        <button id="cancel" class="btn btn-success form-control"><i class='glyphicon glyphicon-arrow-left'></i> Atras</button>
      <?php
        }
      ?>
      <hr>
      <center>
        <span id="te">
          Filtros
        </span>
      </center>
      <br>

      <fieldset id="opciones">
        <label>
            <input type="radio" name="filtro" value="100"<?php
            if($this->session->userdata('search') == '100')
            {
              ?>
              checked
              <?php
            }?>> Menos de $100.00
        </label>
        <br>
        <label>
            <input type="radio" name="filtro" value="500" <?php
            if($this->session->userdata('search') == '500')
            {
              ?>
              checked
              <?php
            }?>> Menos de $500.00
        </label>
        <br>
        <label>
            <input type="radio" name="filtro" value="800" <?php
            if($this->session->userdata('search') == '800')
            {
              ?>
              checked
              <?php
            }?>> Menos de $800.00
        </label>
        <br>
        <label>
            <input type="radio" name="filtro" value="all" <?php
            if($this->session->userdata('search') == 'all')
            {
              ?>
              checked
              <?php
            }?>> Todo
        </label>
        <br>
      </fieldset>

      <hr>
      <center>
        <span id="te">
          Acciones
        </span>
      </center>
      <br>
      <a class="btn btn-success form-control" href="#nuevoProducto" data-toggle = 'modal'>Nuevo Producto</a>

    </section>
    <aside id="tarjetas">
      <?php

        if($productos == null)
        {
          ?>
          <h2>No hay productos registrados</h2>
          <?php
        }
        else
        {
          foreach ($productos->result() as $fila)
          {
          ?>

          <div class="target">

            <div class="imagen">
              <center>
                <img class="img" style="width: 120px; height: 120px;" src="<?= base_url() ?>/resources/img/producto/<?= $fila->img ?>" alt="Logo">
              </center>
            </div>

            <div class="desc">
              <a class="nom_pro" data-backdrop="static" data-keyboard="false"
              value="<?= $fila->id_producto ?>" href="#detales" data-toggle="modal"><?= $fila->nombre_producto  ?></a>
              <br>
              <span class="price" >Precio: $<?= $fila->precio_producto ?></span>
              <br>
            </div>

          </div>

          <?php
            }
          ?>
          <br>

          <div class="pagination">
            <center>
              <?= $pagination ?>
            </center>
          </div>

        <?php
        }
      ?>
    </aside>

    <script type="text/javascript">

      $(document).ready(function() {

        $("input[name=filtro]").click(function () {

          var opcion = $(this).val();

          $.ajax({
            url: '<?= base_url() ?>/Product/Option',
            type: 'post',
            data: 'opcion=' + opcion,
            success: function(response) {
              location.href = response;
            }
          });

        });

        $('#busqueda').change(function() {

          var texto = $(this).val();

          $.ajax({
            url: '<?= base_url() ?>/Product/Search',
            type: 'post',
            data: 'text=' + texto,
            success: function(response) {
              location.href = response;
            }
          });

        });

        $('#cancel').click(function(event) {

          $.ajax({
            url: '<?= base_url() ?>/Product/Off',
            type: 'post',
            success: function(response) {
              location.href = response;
            }
          });

        });

        $('.nom_pro').on('click', function(event) {
          event.preventDefault();

          var id = $(this).attr('value');

          $.ajax({
            url: '<?= base_url() ?>Product/Search_Id',
            type: 'post',
            data: 'id=' + id,
            success: function(response)
            {
              var datos = JSON.parse(response)
              console.log(datos);
              $('#image_prod').attr('src', datos['imagen']);
              $('#id').attr('value', id);
              $('#estado option[value="'+ datos['estado'] +'"]').attr("selected", true);
              $('#codigo').val(datos['codigo']);
              $('#precio').val(datos['precio']);
              $('#nombre').val(datos['nombre']);

            }
          });

        });

      });

    </script>
