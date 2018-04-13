<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('encryption');
  }

  function Search($person = null)
  {
    if($person != null)
    {
      $SQL = 'Select * from users where user_name = "' . $person .'"';
      $result = $this->db->query($SQL);
      if($result->num_rows() > 0)
        return $result->row();

    }
    return null;
  }

  public function GetPaginacion($numero_por_pagina)
  {
    return $this->db->get("users",$numero_por_pagina,$this->uri->segment(3));
  }

  public function Num_Users()
  {
      $numero = $this->db->query("SELECT count(*) as numero FROM users")->row()->numero;
      return intval($numero);
  }

  public function Insert($datos = null)
  {
    if($datos != null)
    {
      $pass = $this->encryption->encrypt($datos['pass']);
      $SQL = "INSERT INTO users(firstname, lastname, user_name, user_password_hash, user_email, date_added) VALUES " .
       "('".$datos['nombre']."', '".$datos['apellido']."', '".$datos['usuario']."', '".$pass."', '".$datos['email']."', curdate())";
       if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Update($datos = null)
  {
    if($datos != null)
    {
      $id = $datos['id'];
      $nombre = $datos['nombre'];
      $apellidos = $datos['apellido'];
      $usuario = $datos['usuario'];
      $email = $datos['email'];

      $SQL =  "UPDATE users SET firstname='".$nombre."', lastname='".$apellidos."', user_name='".$usuario.
      "', user_email='".$email."' WHERE user_id=".$id."";

      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function ChagePass($datos = null)
  {
    if($datos != null)
    {
      $pass = $datos['pass'];
      $id = $datos['id'];

      $SQL = "UPDATE users SET user_password_hash= '". $pass ."' WHERE user_id = ". $id ."";

      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Delete($id = null)
  {
    if($id != null)
    {
      $SQL = "DELETE FROM users WHERE user_id = $id";

      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Search_User()
  {

  }

}
