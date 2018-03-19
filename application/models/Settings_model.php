<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function Select()
  {
    $SQL = "select * from perfil where id_perfil=1";
    $result = $this->db->query($SQL);

    if($result->num_rows() > 0)
      return $result->row();
    else
      return null;
  }

  function Symbols()
  {
    $SQL = "select name, symbol from currencies group by symbol order by name ";
    $result = $this->db->query($SQL);

    if($result->num_rows() > 0)
      return $result->result_array();
    else
      return null;
  }

  function Update($info = null)
  {
    if($info != null)
    {
      $nombre_empresa = $info['nombre_empresa'];
      $telefono = $info['telefono'];
      $email = $info['email'];
      $impuesto = $info['impuesto'];
      $moneda = $info['moneda'];
      $direccion = $info['direccion'];
      $ciudad = $info['ciudad'];
      $estado = $info['estado'];
      $codigo_postal = $info['codigo_postal'];

      $sql = "UPDATE perfil SET nombre_empresa='".$nombre_empresa."', telefono='".$telefono."', email='".$email
      ."', impuesto='".$impuesto."', moneda='".$moneda."', direccion='".$direccion."', ciudad='".$ciudad."', estado='".$estado
      ."', codigo_postal='$codigo_postal' WHERE id_perfil='1'";

      if($this->db->query($sql))
        return true;
    }
    return false;
  }

  function UpdateImage($data = null)
  {
    if($data != null)
    {
      $SQL = "UPDATE perfil SET logo_url='$data' WHERE id_perfil='1'";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

}
