<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
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

}
