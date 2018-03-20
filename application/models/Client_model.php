<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function GetPaginacion($numero_por_pagina)
  {
    return $this->db->get("clientes",$numero_por_pagina,$this->uri->segment(3));
  }

  public function Num_Clients()
  {
      $numero = $this->db->query("SELECT count(*) as numero FROM clientes")->row()->numero;
      return intval($numero);
  }

}
