<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function GetPaginacion($numero_por_pagina)
  {
    $SQL = "SELECT products.*, perfil.moneda from products, perfil where perfil.id_perfil = 1";
    return $this->db->query($SQL,$numero_por_pagina,$this->uri->segment(3));
  }

  public function Num_Clients()
  {
      $numero = $this->db->query("SELECT count(*) as numero FROM products")->row()->numero;
      return intval($numero);
  }

}
