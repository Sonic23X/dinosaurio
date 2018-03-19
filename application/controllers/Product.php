<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      $data = array('title' => 'Configuración', 'login' => false, 'config' => false, 'fact' => false,
      'cliente' => false, 'product' => true, 'user' => false);
      $this->load->view('head', $data);
      $this->load->view('navbar', $data);



      $this->load->view('footer');
    }
  }

}
