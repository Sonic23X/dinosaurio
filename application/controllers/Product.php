<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Product_model');
  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      header("Location: ".base_url('Product/Home'));
    }
  }

  function Home()
  {
    $data = array('title' => 'Productos', 'login' => false, 'config' => false, 'fact' => false,
    'cliente' => false, 'product' => true, 'user' => false);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    if($this->session->userdata('sear') != null)
    {
      $this->session->unset_userdata('search');
      $this->session->set_userdata('search', 'all');

      $config['base_url'] = base_url() . 'Product/Home';
      $config['total_rows'] = $this->Product_model->Num_Sproducts($this->session->userdata('sear'));
      $config['per_page'] = 9;
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
      $result = $this->Product_model->Search($config['per_page'], $this->session->userdata('sear'));
    }
    else
    {
      if($this->session->userdata('search') == 'all')
      {
        $config['base_url'] = base_url() . 'Product/Home';
        $config['total_rows'] = $this->Product_model->Num_Products();
        $config['per_page'] = 9;
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
        $result = $this->Product_model->GetPaginacion($config['per_page']);
      }
      else
      {
        $config['base_url'] = base_url() . 'Product/Home';
        $config['total_rows'] = $this->Product_model->Num_Oproducts($this->session->userdata('search'));
        $config['per_page'] = 9;
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
        $result = $this->Product_model->Get_Paginacion($config['per_page'], $this->session->userdata('search'));
      }
    }

    $data['productos'] = $result;
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('producto/body', $data);

    //modales
    $this->load->view('producto/modals/details_modal');
    $this->load->view('producto/modals/registro_productos');

    $this->load->view('footer');
  }

  function Search()
  {
    $post = $this->input->post();

    $busqueda = $post['text'];

    if($busqueda == "")
    {
      $this->session->unset_userdata('search');
      $this->session->unset_userdata('sear');
      $this->session->set_userdata('search', 'all');
      $this->session->set_userdata('sear', null);
    }
    else
    {
      $this->session->unset_userdata('search');
      $this->session->unset_userdata('sear');
      $this->session->set_userdata('search', 'all');
      $this->session->set_userdata('sear', $busqueda);
    }

    echo base_url() . "Product/Home";
  }

  function Option()
  {
    $post = $this->input->post();

    $valor = $post['opcion'];

    $this->session->unset_userdata('search');
    $this->session->set_userdata('search', $valor);

    echo base_url() . "Product/Home";

  }

  function Off()
  {
    $this->session->unset_userdata('search');
    $this->session->unset_userdata('sear');
    $this->session->set_userdata('search', 'all');
    $this->session->set_userdata('sear', null);

    echo base_url() . "Product/Home";
  }

  function UpdateImage()
  {
    $config['upload_path']  = './resources/img/producto/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 1000;

    $this->load->library('upload', $config);

    if($this->upload->do_upload('imagefile'))
    {
      $data = array('upload_data' => $this->upload->data());
      $datos['nombre'] =  $data['upload_data']['file_name'];
      $datos['id'] = $this->input->post('id');

      $bool = $this->Product_model->UpdateImage($datos);

      if($bool)
      {
          echo base_url() . "resources/img/producto/" . $datos['nombre'];
      }
    }
    else
    {
      echo "Error al subir la imagen";
    }
  }

  function Insert()
  {
    $post = $this->input->post();

    $data['codigo'] = $post['codigo'];
    $data['nombre'] = $post['nombre'];
    $data['estado'] = $post['estado'];
    $data['precio'] = $post['precio'];

    $bool = $this->Product_model->Insert($data);

    if($bool)
        echo "Registro insertado con exito!";
    else
      echo "Error al registrar, intente mas tarde";

  }

  function Search_Id()
  {
    $post = $this->input->post();

    $id = $post['id'];

    $info = $this->Product_model->Search_Id($id);

    if($info != null)
    {
      $data = array('imagen' => base_url() . "resources/img/producto/" . $info->img,
                             'estado' => $info->status_producto,
                             'codigo' => $info->codigo_producto,
                             'precio' => $info->precio_producto,
                             'nombre' => $info->nombre_producto

                           );

      $json = json_encode($data);

      echo $json;
    }
  }

  function Update()
  {
    $data['id'] = $this->input->post('id');
    $data['codigo'] = $this->input->post('codigo');
    $data['nombre'] = $this->input->post('nombre');
    $data['estado'] = $this->input->post('estado');
    $data['precio'] = $this->input->post('precio');

    $bool = $this->Product_model->Update($data);

    if($bool)
      echo "true";
    else
      echo "false";
  }

  function Delete()
  {
    $data['id'] = $this->input->post('id');

    $bool = $this->Product_model->Delete($data);

    if($bool)
      echo "true";
    else
      echo "false";
  }

}
