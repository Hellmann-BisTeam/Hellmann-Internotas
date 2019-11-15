<?php 
/**
 * 
 */
class Clogin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mlogin');
	}
	public function index(){
		$data['mensaje']=' ';
		$this->load->view('vlogin',$data);
	}

	public function ingresar(){
		$usu=$this->input->post('txtUsuario');
		$pass=$this->input->post('txtClave');

		$res=$this->Mlogin->registrarUsu($usu,$pass);

		if($res==1){
			/*$this->load->view('layout/header');
			$this->load->view('layout/menu');
			$this->load->view('Cinternota/go_internota');
			$this->load->view('layout/footer');*/
			redirect('Cinternota');
		}else{
			$data['mensaje']='error al iniciar sesion';
			$this->load->view('vlogin',$data);
		}

	}

	public function vista_reg(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('usuario/vregistrarusu');
		$this->load->view('layout/footer');
	}
}
?>