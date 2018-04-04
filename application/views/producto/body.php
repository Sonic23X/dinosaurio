    <section>



    </section>

    <aside>
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
              <img class="img" style="width: 150px; height: 150px;" src="<?= base_url() ?>/resources/img/producto/<?= $fila->img ?>" alt="Logo">
            </center>
          </div>

          <div class="desc">
            <a class="nom_pro" href="#"><?= $fila->nombre_producto  ?></a>
            <br>
            <span class="price">Precio: $<?= $fila->precio_producto ?></span>
            <br>
            <a class="details" href="#">Ver detalles</a>
          </div>

        </div>

        <?php
          }
        ?>

        <div class="pagination">
          <?= $pagination ?>
        </div>

      </aside>
      <?php
      }
    ?>
