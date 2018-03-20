<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Client_model');
  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      header("Location: ".base_url('Client/Home'));
    }
  }

  function Home()
  {
    $data = array('title' => 'Configuración', 'login' => false, 'config' => false, 'fact' => false,
    'cliente' => true, 'product' => false, 'user' => false);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    $config['base_url'] = base_url() . 'Client/Home';
    $config['total_rows'] = $this->Client_model->Num_Clients();
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
    $result = $this->Client_model->GetPaginacion($config['per_page']);

    $data['clientes'] = $result;
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('cliente/body', $data);

    //modales
    $this->load->view('cliente/modals/registro_clientes');
    $this->load->view('cliente/modals/editar_clientes');

    $this->load->view('footer');
  }

}
