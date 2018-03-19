<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Settings_model');
  }

  function Index()
  {
    if(!$this->session->userdata('login'))
      header("Location: ".base_url('Home/Login'));
    else
    {
      $info = $this->Settings_model->Select();
      $sym =  $this->Settings_model->Symbols();

      $sel['info'] = $info;
      $sel['sym'] = $sym;

      $data = array('title' => 'Configuración', 'login' => true, 'config' => true, 'fact' => false,
      'cliente' => false, 'product' => false, 'user' => false);
      $this->load->view('head', $data);
      $this->load->view('navbar', $data);

      $this->load->view('configuracion/info', $info);
      $this->load->view('configuracion/symbol', $sel);
      $this->load->view('configuracion/ubication', $info);

      $this->load->view('footer');
    }
  }

  function Update()
  {
    $post = $this->input->post();

  	if (empty($post['nombre_empresa']))
    {
      $errors[] = "Nombre de empresa esta vacío";
    }
    else if (empty($post['telefono']))
    {
      $errors[] = "Teléfono esta vacío";
    }
    else if (empty($post['email']))
    {
      $errors[] = "E-mail esta vacío";
    }
    else if (empty($post['impuesto']))
    {
      $errors[] = "IVA esta vacío";
    }
    else if (empty($post['moneda']))
    {
      $errors[] = "Moneda esta vacío";
    }
    else if (empty($post['direccion']))
    {
      $errors[] = "Dirección esta vacío";
    }
    else if (empty($post['ciudad']))
    {
      $errors[] = "Dirección esta vacío";
    }
    else
    {

      $data['nombre_empresa'] = $post["nombre_empresa"];
  		$data['telefono'] = $post["telefono"];
  		$data['email'] = $post["email"];
  		$data['impuesto'] = $post["impuesto"];
  		$data['moneda'] = $post["moneda"];
  		$data['direccion'] = $post["direccion"];
  		$data['ciudad'] = $post["ciudad"];
  		$data['estado'] = $post["estado"];
  		$data['codigo_postal'] = $post["codigo_postal"];

      $bool = $this->Settings_model->Update($data);

      if($bool)
      {
        $messages[] = "Datos han sido actualizados satisfactoriamente.";
      }
      else
      {
        $errors []= "Lo siento algo ha salido mal intenta nuevamente.";
      }

      if (isset($errors))
      {
        $html = '<div class="alert alert-danger" role="alert">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
					   <strong>Error!&nbsp;</strong>';
				foreach ($errors as $error)
          $html.= $error;

        $html .= '</div>';

        echo $html;
      }
      else
      {
        $html = '<div class="alert alert-success" role="alert">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
					   <strong>¡Bien hecho!&nbsp;</strong>';
				foreach ($messages as $message)
          $html.= $message;

        $html .= '</div>';

        echo $html;
      }
    }
  }

  function UpdateImage()
  {
    $config['upload_path']  = './resources/img';
    $config['allowed_types'] = 'gif|jpg|png|jpeg';
    $config['max_size'] = 100;

    $this->load->library('upload', $config);

    if($this->upload->do_upload('imagefile'))
    {
      $data = array('upload_data' => $this->upload->data());

      $bool = $this->Settings_model->UpdateImage($data['upload_data']['file_name']);
      if($bool)
      {
        echo base_url()."resources/img/".$data['upload_data']['file_name'];
      }
    }
    else
    {
      echo $this->upload->display_errors();
    }
  }

}
