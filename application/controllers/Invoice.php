<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Invoice_model');
    $this->load->model('User_model');
    $this->load->model('Client_model');
  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      header("Location: ".base_url('Invoice/Home'));
    }
  }

  public function Home()
  {
    $data = array('title' => 'Facturas', 'login' => false, 'config' => false, 'fact' => true,
    'cliente' => false, 'product' => false, 'user' => false);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    $config['base_url'] = base_url() . 'Invoice/Home';
    $config['total_rows'] = $this->Invoice_model->Num_Fac();
    $config['per_page'] = 5;
    $config['uri_segment'] = 3;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $result = $this->Invoice_model->GetPaginacion($config['per_page']);

    $data['factura'] = $result;
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('factura/body', $data);

    $this->load->view('footer');
  }

  function Editar()
  {
    $data = array('title' => 'Editar Factura', 'login' => false, 'config' => false, 'fact' => true,
    'cliente' => false, 'product' => false, 'user' => false);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    $this->load->view('factura/editar');

    $this->load->view('footer');
  }

  function Nuevo()
  {
    $data = array('title' => 'Nueva Factura', 'login' => false, 'config' => false, 'fact' => true,
    'cliente' => false, 'product' => false, 'user' => false);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    $info['clientes'] = $this->Client_model->GetClients();
    $info['usuarios'] = $this->User_model->GetUsers();

    $this->load->view('factura/nueva', $info);

    $this->load->view('footer');
  }

  function Imprimir()
  {

  }

  function Insert()
  {

  }

  function Update()
  {
    # code...
  }

  function Delete()
  {
    # code...
  }

}
