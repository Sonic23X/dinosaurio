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

  public function Insert($datos = null)
  {
    if($datos != null)
    {
      $SQL = "INSERT INTO clientes(nombre_cliente, telefono_cliente, email_cliente, direccion_cliente, status_cliente, date_added)".
      " VALUES('".$datos['nombre']."', '".$datos['telefono']."', '".$datos['email']."', '".$datos['direccion']."', '".$datos['estado']."', curdate())";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Update($value = null)
  {
    if($value != null)
    {
      $SQL = "UPDATE clientes SET nombre_cliente='".$value['nombre']."', telefono_cliente='".$value['telefono']."', email_cliente='".
      $value['email']."', direccion_cliente='".$value['direccion']."', status_cliente=".$value['estado']." WHERE id_cliente=" . $value['id'] ."";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Delete($datos = null)
  {
    if($datos != null)
    {
      $SQL = "DELETE FROM clientes WHERE id_cliente=" . $datos['id'] ."";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

}
