<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();

  }

  public function Num_Fac()
  {
    $numero = $this->db->query("SELECT count(*) as numero FROM facturas")->row()->numero;
    return intval($numero);
  }

  public function GetPaginacion($numero_por_pagina)
  {
    $this->db->where("facturas.id_cliente=clientes.id_cliente and facturas.id_vendedor=users.user_id");
    return $this->db->get("facturas, clientes, users",$numero_por_pagina,$this->uri->segment(3));
  }

  public function SelectCount($id = null)
  {
    $SQL = "select * from facturas where id_factura='".$id."'";
    $result = $this->db->query($SQL);
    if($result->num_rows > 0)
    {
      return true;
    }
    return false;
  }

  public function SelectRow($id = null)
  {
    $SQL = "select * from facturas where id_factura=".$id."";
    $result = $this->db->query($SQL);
    if($result->num_rows() > 0)
      return $result->row();
    else
      null;
  }

  public function Delete($datos = null)
  {
    $SQL = "DELETE FROM detalle_factura WHERE numero_factura = " . $datos . "";
    if($this->db->query($SQL))
    {
      $SQL = "DELETE FROM facturas WHERE numero_factura = " . $datos . "";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

}
