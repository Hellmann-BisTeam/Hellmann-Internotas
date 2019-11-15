<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('Minternota');
	}
	public function index()
	{	
		//Lo que recibimos en el index 
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$INT_PISO=$this->input->post('Piso');
	    $INT_TIPO=$this->input->post('Tipo');
	    $INT_NOTA=$this->input->post('txtInternota');
	    //$this->Minternota->UpdateInternota($INT_PISO,$INT_TIPO,$INT_NOTA);
	    $data['INT_PISO']=$INT_PISO;
	    $data['INT_TIPO']=$INT_TIPO;
	    $data['INT_NOTA']=$INT_NOTA;
	    //Get cantidad de tiendas por internota
	    $ver0=$this->Minternota->getNTienda($INT_NOTA);
	    $CANTIDAD_TIENDA=$ver0->CANTIDAD;
	    //$INTERNOTA_N=$ver0->INT_NOTA;
	    
	    if($CANTIDAD_TIENDA>1){
	    	$data2['INT_PISO']=$INT_PISO;
	    	$data2['INT_TIPO']=$INT_TIPO;
	    	$data2['INT_NOTA']=$INT_NOTA;
	    	//Data de internotas 
	    	$data2['SHOPS']=$this->Minternota->getNInternota($INT_NOTA); 
	    	//

	    	$ver42=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    	$data2['INT_TIPO_DESCRIP']=$ver42->INT_TIPO_DESCRIP;
	    	$data2['PISOS']=$this->Minternota->getPiso();
	    	$data2['TIPOS']=$this->Minternota->getTipo();
	    	$data2['INTERNOTAS']=$this->Minternota->getInternota();
	    	$data2['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
	    
	    	
	    	$this->load->view('vdinamico',$data2);
	    	//$this->load->view('welcome_message2',$data2);
	    	
	    	$this->load->view('layout/footer');

		
	    }
	   else{
	    //PASAR EN ARRAY ANTES DE MANDAR 
	    $ver=$this->Minternota->getDataInternota($INT_NOTA);
	    
	    $data['INT_LPCS']=$ver->INT_LPCS;
	    $data['INT_CONCEPTO']=$ver->INT_CONCEPTO;
	    $data['INT_WP_CODE']=$ver->INT_WP_CODE;
	    $data['INT_SHOP']=$ver->INT_SHOP;
	    $data['INT_ID']=$ver->INT_ID;

	    $ver2=$this->Minternota->get_Tipo_Descrip($INT_TIPO);
	    $data['INT_TIPO_DESCRIP']=$ver2->INT_TIPO_DESCRIP;

	    //ARRAY completos se pasan directo 
	    $data['PISOS']=$this->Minternota->getPiso();
	    $data['TIPOS']=$this->Minternota->getTipo();
	    $data['INTERNOTAS']=$this->Minternota->getInternota();
	    $data['CONCEPTOS']=$this->Minternota->getConcepto($INT_PISO);
	    
	    //Mensaje vacio por error de WP
		$mensaje=' ';
		//Error multi wp
		
		$data['mensaje']=$mensaje;
		
		$this->load->view('welcome_message',$data);
		$this->load->view('layout/footer');
		}
		}

		
		

	public function llegue(){
		//$this->load->view('llegue');
		$Tienda_M=$this->input->post('Tienda_M'); 
    	$Total_M=$this->input->post('Total_M');
    	$Concepto_M=$this->input->post('Concepto_M');
    	$Wp_M=$this->input->post('Wp_M');
    	$Largo_M=$this->input->post('largo');
    	$Piso=$this->input->post('Piso');
    	$Tipo=$this->input->post('Tipo');
    	$TotalPadre=$this->input->post('TotalPadre');
    	$Internota=$this->input->post('HInternota');

    	//Saco la id del padre
    	$res1=$this->Minternota->getIdPadre($Internota);
    	$IdPadre=$res1->INT_ID;
    	//Seteo columnas de control
    	$INT_ESTADO='En Espera';
		$INT_DIVISION='Si';
		$INT_PADRE=-1;
		$FECHA_ACT= date('Y-m-d H:i:s');
    	

    	//Seteo al padre para deshabilitar el registro
    	$res2=$this->Minternota->setPadre($IdPadre,$INT_DIVISION,$INT_PADRE);
    	//Comienzo de validaciones 
    	$salida=0;
    	$flag=0;
    	$suma=0;


		
		for($i=0;$i<$Largo_M;$i++){
			if($Wp_M[$i]!=null){
				$largoWP=strlen($Wp_M[$i]);
				if($largoWP!=9){
					$flag=1;
					$mensajelargo='El WP ['.$Wp_M[$i].'] No cumple con el largo de 9 caracteres';
					echo json_encode($mensajelargo);
				}
			}
		}

    	for($i=0;$i<$Largo_M;$i++){
    		if($Wp_M[$i]!=null){
    			for($j=$i+1;$j<$Largo_M;$j++){
    				if($Wp_M[$j]!=null){
    					if($Wp_M[$i]==$Wp_M[$j]){
    						$flag=1;
    						$mensajelist='El WP '.$Wp_M[$j].' viene un Wp repetido en la lista de ingreso';
    						echo json_encode($mensajelist);
    					
    					}
    				}
    			
    			}
    		}
    	}

    	for($j=0; $j<$Largo_M;$j++){
    			
    			if($Total_M[$j]!=null && $Concepto_M[$j]!=null && $Concepto_M[$j]!=null && $Tienda_M[$j]!="")
    			{
	    			$valida=$this->Minternota->buscarWp($Wp_M[$j]);
	    			if($valida->CANTIDAD>0){
	    				$flag=1;
	    				//$mostrar=1;
	    				$c = $Total_M[$j];
	    				$a = $Wp_M[$j];
						$b = "El WP ".$a." de la cantidad ".$c." existe en la BD";
	    				
	    				//echo json_encode($b);
					}
					/*if ($bandera==0){
    					
						$this->Minternota->insertar($Internota,$Total_M[$j],$Concepto_M[$j],$Wp_M[$j],$Tienda_M[$j],$INT_ESTADO,$INT_DIVISION,$IdPadre,$Piso,$Tipo,$FECHA_ACT);
					} */
				}   
    		}


    	for($j=0; $j<$Largo_M;$j++){
    		if($Total_M[$j]!=null ){
    			$suma=$suma+$Total_M[$j];
    		}
    	}

    	//Validacion de Cantidades ingresadas 
    	$ver=$this->Minternota->getDataInternota($Internota);
	    $total_total=$ver->INT_LPCS;
    	
    	 	
    	if($suma>$total_total) {
    		$flag=1;
    		
    		$msg="La Suma de la Internota es mayor a las cantidades ingresadas ";
    		echo json_encode($msg);
    	//	echo json_encode($suma);
    	//	echo json_encode($total_total);
    		
    	} 

        if($suma<$total_total){ 
        	$flag=1;
        	//echo json_encode($total_total);
        	$msg="La Suma de la Internota es menor a las cantidades ingresadas";
    		echo json_encode($msg);
    			
        }

       /* if($suma==$total_total){ 
        	$flag=0;
        	//echo json_encode($total_total);
        	$msg="La Suma de la Internota igual a las cantidades ingresadas". "\n";
    			
        }*/
        //validacion de WP

    	if($flag==0){
    		//con Flag y banedera en 0 quiere decir que todos los valores son válidos
    		//En este punto validaciones realizadas en suma en wp
    		$salida=1;	
    			for($j=0; $j<$Largo_M;$j++){
    				if($Total_M[$j]!=null && $Concepto_M[$j]!=null && $Concepto_M[$j]!=null && $Tienda_M[$j]!=""){
    					$this->Minternota->insertar($Internota,$Total_M[$j],$Concepto_M[$j],$Wp_M[$j],$Tienda_M[$j],$INT_ESTADO,$INT_DIVISION,$IdPadre,$Piso,$Tipo,$FECHA_ACT);
						    					
	    			}
    			}
    		//$salida=1;



    	}
    	if($salida==1){
    		$mensaje_fin='los Datos registrados correctamente';
    		echo json_encode($mensaje_fin);
    	}
	}


}
