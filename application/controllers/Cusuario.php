<?php

/**
 * 
 */
class Cusuario extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Musuario');
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');

		$this->load->view('layout/footer');
	}
	public function vista_reg(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('usuario/vregistrarusu');
		$this->load->view('layout/footer');
	}

	public function guardar_usu(){

	$INT_USER_NOMBRE=$this->input->post('txtUsuario');
    $INT_USER_CLAVE=$this->input->post('txtClave');
    $this->Musuario->guardarUsuario($INT_USER_NOMBRE,$INT_USER_CLAVE);
    redirect('Cinternota');
	}

	
}
?>