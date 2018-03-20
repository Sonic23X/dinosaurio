<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('encryption');
    $this->load->model('User_model');
  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      header("Location: ".base_url('Invoice'));
    }
  }

  function Logout ()
  {
    $this->session->sess_destroy();
    header("Location: ".base_url('Home/Login'));
  }

  function Login()
  {
    if($this->session->userdata('login'))
      header("Location: ".base_url());
    else
    {
      $data = array('title' => 'Configuración', 'login' => true, 'config' => true, 'fact' => false,
      'cliente' => false, 'product' => false, 'user' => false);
      $this->load->view('head', $data);
      $this->load->view('login');
      $this->load->view('footer');
    }
  }

  function Insert()
  {

    $pass = $this->encryption->encrypt("1234");
    $SQL = "INSERT INTO users (firstname, lastname, user_name, user_password_hash, user_email, date_added)".
    " VALUES ('Alfredo', 'Ortega', 'admin', '". $pass ."', 'omar.alfredo49@gmail.com', curdate() )";

    $this->db->query($SQL);
  }

  function Log()
  {
    $nick = $this->input->post('usuario');
    $contrasenia = $this->input->post('contrasena');

    $info = $this->User_model->Search($nick);

    if($info != null)
    {
      $contra = $this->encryption->decrypt($info->user_password_hash  );
      if($contra == $contrasenia)
      {
        $data = array(
          'id' => $info->user_id,
          'user' => $info->user_name,
          'login' => true
        );

        $this->session->set_userdata($data);

        echo base_url('');
      }
      else
        echo "Las contraseñas no coinciden, intentelo de nuevo";
    }
    else
        echo "El usuario no existe, intentelo de nuevo";

  }

}
