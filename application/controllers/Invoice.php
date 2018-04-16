<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Invoice_model');
    $this->load->model('User_model');
    $this->load->model('Client_model');
    $this->load->model('Settings_model');
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

    //modales
    $this->load->view('cliente/modals/registro_clientes');
    $this->load->view('factura/modals/products');

    $this->load->view('footer');
  }

  function Imprimir($id)
  {

    $id_factura = intval($id);
    $bool = $this->Invoice_model->SelectCount($id_factura);
    if($bool)
    {
      echo "<script>alert('Factura no encontrada')</script>";
    	echo "<script>window.close();</script>";
    }
    else
    {
      $datos = $this->Invoice_model->SelectRow($id_factura);
      $datos_empresa = $this->Settings_model->Select();
      $cliente = $this->Client_model->GetClientsID($datos->id_cliente);
      $vendedor = $this->User_model->Person($datos->id_vendedor);
      $url = "D:/xampp/htdocs/dinosaurio/resources/HTML2PDF/html2pdf.class.php";
      require_once($url);

      ob_start();
      $this->load->view('factura/pdf/encabezado1', $datos_empresa);
      $this->load->view('factura/pdf/encabezado2', $datos);
      $this->load->view('factura/pdf/cliente', $cliente);
      $this->load->view('factura/pdf/vendedor', $vendedor);
      $this->load->view('factura/pdf/pago', $datos);
      $this->load->view('factura/pdf/productos', $datos_empresa);
      $content = ob_get_clean();

      try
      {
          $html2pdf = new HTML2PDF('P', 'LETTER', 'es', true, 'UTF-8', array(0, 0, 0, 0));
          $html2pdf->pdf->SetDisplayMode('fullpage');
          $html2pdf->writeHTML($content);
          $html2pdf->Output('Factura.pdf');
      }
      catch(HTML2PDF_exception $e) {
          echo $e;
          exit;
      }

    }

  }

  function Insert()
  {

  }

  function Update()
  {

  }

  function Delete()
  {
    $post = $this->input->post();
    $fac = $post['id'];
    $bool = $this->Invoice_model->Delete($fac);
    if($bool)
      echo "Factura eliminada";
    else
      echo "Error al eliminar la factura";

  }

  function SearchClient()
  {
    $post = $this->input->post();

    $datos = $this->Client_model->GetClientsID($post['id']);
    if($datos != null)
    {
      echo $datos->telefono_cliente . ";" . $datos->email_cliente;
    }
    else
      echo "Error, intente más tarde";
  }

}
