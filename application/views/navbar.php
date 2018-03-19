
    <nav class="navbar navbar-default ">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?= $title ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if($fact) { ?> class="active" <?php  }?>><a href="<?= base_url() ?>"><i class='glyphicon glyphicon-list-alt'></i> Facturas <span class="sr-only">(current)</span></a></li>
            <li <?php if($product) { ?> class="active" <?php  }?>><a href="<?= base_url('Product') ?>"><i class='glyphicon glyphicon-barcode'></i> Productos</a></li>
            <li <?php if($cliente) { ?> class="active" <?php  }?>><a href="<?= base_url('Client') ?>"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>
            <li <?php if($user) { ?> class="active" <?php  }?>><a href="<?= base_url('User') ?>"><i  class='glyphicon glyphicon-lock'></i> Usuarios</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li <?php if($config) { ?> class="active" <?php  }?>><a href="<?= base_url('Settings') ?>">
              <i  class='glyphicon glyphicon-cog'></i> Configuración</a></li>
            <li><a href="<?= base_url('Home/Logout') ?>"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>
