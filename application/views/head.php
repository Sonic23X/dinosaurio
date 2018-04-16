<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>resources/css/custom.css" rel="stylesheet">
    <link href="<?=base_url()?>resources/css/dino.css" rel="stylesheet">
    <link rel=icon href='<?=base_url()?>resources/img/logo-icon.png' sizes="32x32" type="image/png">

    <script type="text/javascript" src="<?= base_url() ?>vendor/components/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>vendor/twbs/bootstrap/dist/js/bootstrap-filestyle.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>resources/js/VentanaCentrada.js"></script>
    <?php
      if($login)
      {
    ?>
    <link href="<?=base_url()?>resources/css/style.css" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() ?>resources/js/login.js"></script>
    <?php
      }
      if($config)
      {
    ?>
    <script type="text/javascript" src="<?= base_url() ?>resources/js/settings.js"></script>
    <?php
      }
      if($user)
      {
    ?>
    <script type="text/javascript" src="<?= base_url() ?>resources/js/user.js"></script>
    <?php
      }
      if($product)
      {
        ?>
      <link href="<?=base_url()?>resources/css/target.css" rel="stylesheet">
      <link href="<?=base_url()?>resources/css/product.css" rel="stylesheet">
        <?php
      }
      if($cliente)
      {
        ?>
      <script type="text/javascript" src="<?= base_url() ?>resources/js/client.js"></script>
        <?php
      }
    ?>
    <title><?= $title ?></title>
  </head>
  <body>
