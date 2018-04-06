<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model{

  public function GetPaginacion($numero_por_pagina)
  {
    return $this->db->get("products",$numero_por_pagina,$this->uri->segment(3));
  }

  public function Num_Products()
  {
      $numero = $this->db->query("SELECT count(*) as numero FROM products")->row()->numero;
      return intval($numero);
  }

  public function Num_Oproducts($valor)
  {
     $numero = $this->db->query("SELECT count(*) as numero FROM products WHERE precio_producto <= ". $valor ."")->row()->numero;
      return intval($numero);
  }

  public function Get_Paginacion($numero_por_pagina, $valor)
  {
    $this->db->having("precio_producto <= ". $valor ."");
    return $this->db->get("products",$numero_por_pagina,$this->uri->segment(3));
  }

  public function Num_Sproducts($valor)
  {
     $numero = $this->db->query("SELECT count(*) as numero FROM products WHERE nombre_producto LIKE '%". $valor ."%'")->row()->numero;
      return intval($numero);
  }

  public function Search($numero_por_pagina, $valor)
  {
    $this->db->like("nombre_producto", $valor);
    return $this->db->get("products",$numero_por_pagina,$this->uri->segment(3));
  }

  public function Search_Id($value = null)
  {
    if($value != null)
    {
      $SQL = "SELECT * FROM products WHERE id_producto = ". $value ."";
      $return = $this->db->query($SQL);
      if($return->num_rows() > 0)
        return $return->row();
    }
    return null;
  }

  public function Insert($value = null)
  {
    if($value != null)
    {
      $SQL = "INSERT INTO products(codigo_producto, nombre_producto, status_producto, date_added, precio_producto, img) " .
                   "VALUES('". $value['codigo']  ."', '". $value['nombre']  ."', ". $value['estado']  .", curdate(), ". $value['precio']  .", '1.jpg')";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Update($value = null)
  {
    if($value != null)
    {
      $SQL = "UPDATE products SET codigo_producto='". $value['codigo']  ."' , nombre_producto= '". $value['nombre'] . "', "
      . "status_producto=" . $value['estado'] . ", precio_producto=" . $value['precio']
      ." WHERE id_producto = ". $value['id'] ."";

      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function UpdateImage($value = null)
  {
    if($value != null)
    {
      $SQL = "UPDATE products SET img='". $value['nombre']  ."' WHERE id_producto = " . $value['id'] ."";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

  public function Delete($value = null)
  {
    if($value != null)
    {
      $SQL = "DELETE FROM products WHERE id_producto = " . $value['id'] ."";
      if($this->db->query($SQL))
        return true;
    }
    return false;
  }

}
