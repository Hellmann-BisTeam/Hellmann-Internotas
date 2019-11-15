<?php 
/**
 * 
 */
class Musuario extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function guardarUsuario($INT_USER_NOMBRE,$INT_USER_CLAVE){
		/*$campos=array(
			'INT_USER_NOMBRE'=>$param['INT_USER_NOMBRE'],
			'INT_USER_CLAVE'=>$param['INT_USER_CLAVE']
		);

		$this->db->insert('INT_USER',$campos);*/
		$query="INSERT INTO INT_USER (INT_USER_NOMBRE,INT_USER_CLAVE) VALUES ('$INT_USER_NOMBRE','$INT_USER_CLAVE')";
		$this->db->query($query);

	}

	
}

?>