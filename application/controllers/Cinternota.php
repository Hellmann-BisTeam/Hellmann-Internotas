<?php 
/**
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Cinternota extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Minternota');
	}

	public function index(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$data['PISOS']=$this->Minternota->getPiso();
	    $data['TIPOS']=$this->Minternota->getTipo();
	    $data['INTERNOTAS']=$this->Minternota->getInternota();
	    $INT_CONCEPTO=0;
	    $INTERNOTA=1;
	    $INT_WP_CODE=2;

	     $data['INT_CONCEPTO']=$INT_CONCEPTO;
	    $data['INTERNOTA']=$INTERNOTA;
	    $data['INT_WP_CODE']=$INT_WP_CODE;

	    $INT_SHOP="Dano";
     	$INT_PISO=6;
    	$INT_TIPO=15;
	    $data['INT_SHOP']=$INT_SHOP;
    	$data['INT_PISO']=$INT_PISO;
    	$data['INT_TIPO']=$INT_TIPO;
    	$id=" ";
    	$s=" ";
    	$data['id']=$id;
    	$data['s']=$s;
		$this->load->view('vinternota',$data); 
		//$this->load->view('internota/vdinamico');
		$this->load->view('layout/footer');


	}

	public function update_internota(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		
		$INT_PISO=$this->input->post('Piso');
	    $INT_TIPO=$this->input->post('Tipo');
	    $INT_NOTA=$this->input->post('txtInternota');
	    $res = $this->Minternota->UpdateInternota($INT_PISO,$INT_TIPO,$INT_NOTA);
	    if ($res==1) {
	    	$data['INT_PISO']=$INT_PISO;
	    	$data['INT_TIPO']=$INT_TIPO;
	    	$data['INT_NOTA']=$INT_NOTA;
	    	$ver=$this->Minternota->getDataInternota($INT_NOTA);
	    	$data['INT_LPCS']=$ver->INT_LPCS;
	    	$data['PISOS']=$this->Minternota->getPiso();
	    	$data['TIPOS']=$this->Minternota->getTipo();
	    	$data['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
	    	
	    	$ver=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    	$data['INT_TIPO_DESCRIP']=$ver->INT_TIPO_DESCRIP;
	    	
	    	$this->load->view('vdinamico',$data);
	    	
	    }
	   
		$this->load->view('layout/footer');
	    
    }

	public function go_internota2(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
 		$data['PISOS']=$this->Minternota->getPiso();
	    $data['TIPOS']=$this->Minternota->getTipo();
		$this->load->view('internota/vdinamico',$data);
		$this->load->view('layout/footer');
	}


	public function llegue(){
		$this->load->view('llegue');

	}
	/*public function go_internota(){
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		
		$data['PISOS']=$this->Minternota->getPiso();
	    $data['TIPOS']=$this->Minternota->getTipo();
	    $data['INTERNOTAS']=$this->Minternota->getInternota();
	    $INT_CONCEPTO=0;
	    $INTERNOTA=1;
	    $INT_WP_CODE=2;

	    $data['INT_CONCEPTO']=$INT_CONCEPTO;
	    $data['INTERNOTA']=$INTERNOTA;
	    $data['INT_WP_CODE']=$INT_WP_CODE;

	    $INT_SHOP="Dano";
     	$INT_PISO=6;
    	$INT_TIPO=15;
	    $data['INT_SHOP']=$INT_SHOP;
    	$data['INT_PISO']=$INT_PISO;
    	$data['INT_TIPO']=$INT_TIPO;
		$this->load->view('internota/vinternota',$data); 
		//$this->load->view('internota/vdinamico');
		$this->load->view('layout/footer');
	}*/

	


	//funcion menos a 400

    public function go_insert(){
    	$this->load->view('layout/header');
		$this->load->view('layout/menu');

		$INT_PISO=$this->input->post('Piso');
	    $INT_TIPO=$this->input->post('Tipo');
	    $INT_NOTA=$this->input->post('txtInternota');
		$INT_ID=$this->input->post('INT_ID');
		$INT_LPCS=$this->input->post('Total');
		$INT_CONCEPTO=$this->input->post('Concepto');
		$INT_WP_CODE=$this->input->post('Wp');


		$esta=$this->Minternota->buscarWp($INT_WP_CODE);

		if($esta->CANTIDAD > 0){
			$mensaje='UTILIZADO FAVOR CAMBIAR';
			$data['mensaje']=$mensaje;
			$data['INT_PISO']=$INT_PISO;
	    	$data['INT_TIPO']=$INT_TIPO;
	    	$data['INT_NOTA']=$INT_NOTA;

	    	//PASAR EN ARRAY ANTES DE MANDAR SON ROW
	    	$ver=$this->Minternota->getDataInternota($INT_NOTA);

	    	$data['INT_LPCS']=$ver->INT_LPCS;
	    	$data['INT_SHOP']=$ver->INT_SHOP;
	    	$data['INT_ID']=$ver->INT_ID;
	    	$ver2=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    	$data['INT_TIPO_DESCRIP']=$ver2->INT_TIPO_DESCRIP;

	    	//ARRAY completos se pasan directo son result()
			$data['PISOS']=$this->Minternota->getPiso();
		    $data['TIPOS']=$this->Minternota->getTipo();
		    $data['INTERNOTAS']=$this->Minternota->getInternota();
		    $data['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
		    
		    $data['INTERNOTA']=$INT_NOTA;
		    $data['INT_CONCEPTO']=$INT_CONCEPTO;
		    $data['INT_WP_CODE']=$INT_WP_CODE;

			$this->load->view('welcome_message',$data);
			$this->load->view('layout/footer');
		}else{ //se realiza update de data a internota con cantidad menor a 400
			   //aca se ingresa solamente si el WP es unico en toda la BD
			$INT_ESTADO='En Espera';
			$INT_DIVISION='No';
			$INT_PADRE=0;
			$FECHA_SET= date('Y-m-d H:i:s');
			$res=$this->Minternota->SetInternota($INT_NOTA,$INT_CONCEPTO,$INT_WP_CODE,$INT_PISO,$INT_TIPO,$INT_ESTADO,$INT_DIVISION,$INT_PADRE,$FECHA_SET,$INT_ID);
			if ($res==1) {

				$data['PISOS']=$this->Minternota->getPiso();
		    	$data['TIPOS']=$this->Minternota->getTipo();
		    	$data['INTERNOTAS']=$this->Minternota->getInternota();
		    	$ver=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    		$data['INT_TIPO_DESCRIP']=$ver->INT_TIPO_DESCRIP;
		    	$data['INTERNOTA']=$INT_NOTA;
		    	$data['INT_CONCEPTO']=$INT_CONCEPTO;
		    	$data['INT_WP_CODE']=$INT_WP_CODE;
				$this->load->view('vinternota',$data);
				$this->load->view('layout/footer');
			}
		}

    }

    public function go_insert2(){
    	$this->load->view('layout/header');
		$this->load->view('layout/menu');
		//Recibo por URL los datos de la vista
		$INT_NOTA=$this->uri->segment(3);
		$INT_SHOP=$this->uri->segment(4);
		$INT_LPCS=$this->uri->segment(5);
		$INT_PISO=$this->uri->segment(6);
		$INT_TIPO=$this->uri->segment(7);
		$INT_ID=$this->uri->segment(8);
		$data['INT_NOTA']=$INT_NOTA;
		$data['INT_SHOP']=$INT_SHOP;
		$data['INT_LPCS']=$INT_LPCS;
		$data['INT_PISO']=$INT_PISO;
		$INT_WP_CODE=0;
		$data['INT_WP_CODE']=$INT_WP_CODE;
		$data['INT_TIPO']=$INT_TIPO;
		$data['INT_ID']=$INT_ID;
		//MENSAJERIA CON RESTRICCION
		$mensaje=" ";
		$data['mensaje']=$mensaje;
		//FUNCIONES PARA LISTAR 
		$data['PISOS']=$this->Minternota->getPiso();
		$data['TIPOS']=$this->Minternota->getTipo();
		$data['INTERNOTAS']=$this->Minternota->getInternota();
		$data['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
		$ver2=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    $data['INT_TIPO_DESCRIP']=$ver2->INT_TIPO_DESCRIP;
		$this->load->view('welcome_message',$data);
		/*$INT_PISO=$this->input->post('Piso');
	    $INT_TIPO=$this->input->post('Tipo');
	    $INT_NOTA=$this->input->post('txtInternota');
		//$INTERNOTA=$this->input->post('Internota');
		$INT_LPCS=$this->input->post('Total');
		$INT_CONCEPTO=$this->input->post('Concepto');
		$INT_WP_CODE=$this->input->post('Wp');


		$esta=$this->Minternota->buscarWp($INT_WP_CODE);

		if($esta->CANTIDAD > 0){
			$mensaje='UTILIZADO FAVOR CAMBIAR';
			$data['mensaje']=$mensaje;
			$data['INT_PISO']=$INT_PISO;
	    	$data['INT_TIPO']=$INT_TIPO;
	    	$data['INT_NOTA']=$INT_NOTA;

	    	//PASAR EN ARRAY ANTES DE MANDAR SON ROW
	    	$ver=$this->Minternota->getDataInternota($INT_NOTA);

	    	$data['INT_LPCS']=$ver->INT_LPCS;
	    	$data['INT_SHOP']=$ver->INT_SHOP;

	    	$ver2=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    	$data['INT_TIPO_DESCRIP']=$ver2->INT_TIPO_DESCRIP;

	    	//ARRAY completos se pasan directo son result()
			$data['PISOS']=$this->Minternota->getPiso();
		    $data['TIPOS']=$this->Minternota->getTipo();
		    $data['INTERNOTAS']=$this->Minternota->getInternota();
		    $data['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
		    
		    $data['INTERNOTA']=$INT_NOTA;
		    $data['INT_CONCEPTO']=$INT_CONCEPTO;
		    $data['INT_WP_CODE']=$INT_WP_CODE;

			$this->load->view('welcome_message',$data);
			$this->load->view('layout/footer');
		}else{ //se realiza update de data a internota con cantidad menor a 400
			   //aca se ingresa solamente si el WP es unico en toda la BD
			$INT_ESTADO='En Espera';
			$INT_DIVISION='No';
			$INT_PADRE=0;
			$FECHA_SET= date('Y-m-d H:i:s');
			$res=$this->Minternota->SetInternota($INT_NOTA,$INT_CONCEPTO,$INT_WP_CODE,$INT_PISO,$INT_TIPO,$INT_ESTADO,$INT_DIVISION,$INT_PADRE,$FECHA_SET);
			if ($res==1) {

				$data['PISOS']=$this->Minternota->getPiso();
		    	$data['TIPOS']=$this->Minternota->getTipo();
		    	$data['INTERNOTAS']=$this->Minternota->getInternota();
		    	$ver=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    		$data['INT_TIPO_DESCRIP']=$ver->INT_TIPO_DESCRIP;
		    	$data['INTERNOTA']=$INT_NOTA;
		    	$data['INT_CONCEPTO']=$INT_CONCEPTO;
		    	$data['INT_WP_CODE']=$INT_WP_CODE;
				$this->load->view('vinternota',$data);
				$this->load->view('layout/footer');
			}
		}*/
		$this->load->view('layout/footer');
    }


    public function go_masive_insert(){
    	$this->load->view('layout/header');
		$this->load->view('layout/menu');

    	$INTERNOTA_V=$this->input->post('Internota_v');
    	$TOTAL_V=$this->input->post('Total_v');
    	$CONCEPTO_V=$this->input->post('Concepto_v');
    	$WP_V=$this->input->post('Wp_v');
    	$LARGO_V=$this->input->post('largo_v');

    	$data['PISOS']=$this->Minternota->getPiso();
	    $data['TIPOS']=$this->Minternota->getTipo();
	    $data['INTERNOTAS']=$this->Minternota->getInternota();
    	//$this->load->view('internota/vinternota',$data);
	    //$INT_SHOP=$ver->INT_SHOP;
     	//$INT_PISO=$ver->INT_PISO;
    	//$INT_TIPO=$ver->INT_TIPO;


    	//for($j=0; $j<$LARGO_V;$j++){
    		$ver=$this->Minternota->dataInternota($INTERNOTA_V[1]);
    		$INT_SHOP=$ver->INT_SHOP;
    		$INT_PISO=$ver->INT_PISO;
    		$INT_TIPO=$ver->INT_TIPO;
    		$data['INT_SHOP']=$INT_SHOP;
    		$data['INT_PISO']=$INT_PISO;
    		$data['INT_TIPO']=$INT_TIPO;
    		//$res=$this->Minternota->insert_Internota($INT_SHOP,$INTERNOTA_V[$j],$TOTAL_V[$j],$INT_PISO,$INT_TIPO,$CONCEPTO_V[$j],$WP_V[$j]);

    	//}

    	$this->load->view('internota/vinternota',$data);
    }

    public function list_single(){
    	$d=$this->input->post('d');
    	$resultado=$this->Minternota->list_single();
    	$var='llegamos';
    	echo json_encode($resultado);
    }

    public function getNInternota(){
    	$INTERNOTA_N=$this->input->post('INTERNOTA_N');
    	$resultado=$this->getNInternota($INTERNOTA_N);
    	//$resultado=$INTERNOTA_N;
    	echo json_encode($resultado);
    }




	
}
?>

