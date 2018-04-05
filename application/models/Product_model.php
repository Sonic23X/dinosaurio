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

}
