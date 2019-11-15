<?php 
/**
 * 
 */
class Mlogin extends CI_Model
{
	
	

	public function registrarUsu($usu,$pass){
		$sql="SELECT INT_USER_ID,INT_USER_NOMBRE,INT_USER_CLAVE FROM INT_USER WHERE INT_USER_NOMBRE=? AND INT_USER_CLAVE=?";
		$resultado=$this->db->query($sql,array($usu,$pass));

		if ($resultado->num_rows()==1) 
		{
			$r=$resultado->row();

			$s_usuario=array(
				'INT_USER_ID'=>$r->INT_USER_ID,
				'INT_USER_NOMBRE'=>$r->INT_USER_NOMBRE
			);
			$this->session->set_userdata($s_usuario);

			return 1;
		}else{
			return 0;
		}
		
	}
}
?>