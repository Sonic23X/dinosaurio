<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{

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
      header("Location: ".base_url('User/Home'));
      $this->session->unset_userdata('search');
      $this->session->set_userdata('search', 'all');
    }
  }

  public function Home()
  {
    $data = array('title' => 'Usuarios', 'login' => false, 'config' => false, 'fact' => false,
    'cliente' => false, 'product' => false, 'user' => true);
    $this->load->view('head', $data);
    $this->load->view('navbar', $data);

    $config['base_url'] = base_url() . 'User/Home';
    $config['total_rows'] = $this->User_model->Num_Users();
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
    $result = $this->User_model->GetPaginacion($config['per_page']);

    $data['usuarios'] = $result;
    $data['pagination'] = $this->pagination->create_links();

    $this->load->view('usuario/body', $data);

    //modales
    $this->load->view('usuario/modals/registro_usuarios');
    $this->load->view('usuario/modals/editar_usuarios');
    $this->load->view('usuario/modals/cambiar_password');

    $this->load->view('footer');
  }

  function Insert()
  {
    $post = $this->input->post();
    $bool = $this->User_model->Insert($post);

    if($bool)
      echo "true";
    else
      echo "false";
  }

  function Update()
  {
    $post = $this->input->post();
    $bool = $this->User_model->Update($post);

    if($bool)
    {
      $html = '<div class="alert alert-success alert-dismissible" role="alert">';
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$html .= '<strong>Aviso!</strong> Datos actualizados exitosamente.';
			$html .= '</div>';
    }
    else
    {
      $html = '<div class="alert alert-danger alert-dismissible" role="alert">';
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$html .= '<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.';
			$html .= '</div>';
    }

    echo $html;
  }

  function Pass()
  {
    $post = $this->input->post();

    if($post['pass'] == $post['rpass'])
    {
      $data['pass'] = $this->encryption->encrypt($post['pass']);
      $data['id'] = $post['id'];

      $bool = $this->User_model->ChagePass($data);

      if($bool)
      {
        $html = '<div class="alert alert-success alert-dismissible" role="alert">';
  			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
  			$html .= '<strong>Aviso!</strong> Datos eliminados exitosamente.';
  			$html .= '</div>';
      }
    }
    else
    {
      $html = '<div class="alert alert-danger alert-dismissible" role="alert">';
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$html .= '<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.';
			$html .= '</div>';
    }

    echo $html;
  }

  function Delete()
  {
    $post = $this->input->post();
    $bool = $this->User_model->Delete($post['id']);

    if($bool)
    {
      $html = '<div class="alert alert-success alert-dismissible" role="alert">';
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$html .= '<strong>Aviso!</strong> Contraseña actualizada exitosamente.';
			$html .= '</div>';
    }
    else
    {
      $html = '<div class="alert alert-danger alert-dismissible" role="alert">';
			$html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			$html .= '<strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.';
			$html .= '</div>';
    }

    echo $html;

  }

}
