<?php 
/**
 * 
 */
class Minternota extends CI_Model
{
	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function UpdateInternota($INT_PISO,$INT_TIPO,$INT_NOTA){
		$query="UPDATE INT_INTERNOTA SET INT_PISO='$INT_PISO', INT_TIPO='$INT_TIPO' WHERE INT_NOTA='$INT_NOTA'";
		$this->db->query($query);
		//return 1;
	}

	public function getDataInternota($INT_NOTA){
		$query="SELECT INT_LPCS,INT_CONCEPTO,INT_WP_CODE,INT_SHOP, INT_ID FROM INT_INTERNOTA WHERE INT_NOTA='$INT_NOTA'";
		$resultado = $this->db->query($query);
	 	return $resultado->row();
	}

	public function getPiso(){
		$query="SELECT INT_PISO_ID FROM INT_PISO";
		$resultado = $this->db->query($query);
		return $resultado->result();
	}
	public function getTipo(){
		$query="SELECT INT_TIPO_ID,INT_TIPO_DESCRIP FROM INT_TIPO";
		$resultado= $this->db->query($query);
		return $resultado->result();
	}

	public function getInternota(){
		$query="SELECT INT_NOTA FROM INT_INTERNOTA";
		$resultado= $this->db->query($query);
		return $resultado->result();
	
	}

	public function get_Tipo_Descrip($INT_TIPO){
		$query="SELECT INT_TIPO_DESCRIP FROM INT_TIPO WHERE INT_TIPO_ID='$INT_TIPO'";
		$resultado= $this->db->query($query);
		return $resultado->row();
	}

	public function getConcepto($INT_PISO){
		$query="SELECT INT_CONCEPTO_ID FROM INT_PISO_X_CONCEPTO WHERE INT_PISO_ID='$INT_PISO'";
		$resultado= $this->db->query($query);
		return $resultado->result();
	}

	public function SetInternota($INTERNOTA,$INT_CONCEPTO,$INT_WP_CODE,$INT_PISO,$INT_TIPO,$INT_ESTADO,$INT_DIVISION,$INT_PADRE,$FECHA_SET,$INT_ID){
		$query=" UPDATE INT_INTERNOTA SET INT_CONCEPTO='$INT_CONCEPTO',INT_WP_CODE='$INT_WP_CODE',INT_PISO= '$INT_PISO',INT_TIPO='$INT_TIPO', INT_ESTADO='$INT_ESTADO', INT_DIVISION='$INT_DIVISION',INT_PADRE='$INT_PADRE', INT_FECHA_SET='$FECHA_SET' WHERE  INT_NOTA='$INTERNOTA' AND INT_ID = '$INT_ID' ";
		$resultado= $this->db->query($query);
		return 1;
	}

	public function dataInternota($INTERNOTA){
		$query="SELECT INT_SHOP,INT_PISO,INT_TIPO FROM INT_INTERNOTA  WHERE INT_NOTA='$INTERNOTA_V'";
		$resultado = $this->db->query($query);
	 	return $resultado->row();

	}



	public function buscarWp($INT_WP_CODE){
		$query="SELECT COUNT(*) AS CANTIDAD FROM INT_INTERNOTA WHERE INT_WP_CODE='$INT_WP_CODE'";
		$resultado = $this->db->query($query);
	 	return $resultado->row();

	}

	public function getIdPadre($Internota){
		$query="SELECT INT_ID FROM INT_INTERNOTA WHERE INT_NOTA='$Internota'";
		$resultado = $this->db->query($query);
	 	return $resultado->row();

	} 

	public function setPadre($IdPadre,$INT_DIVISION,$INT_PADRE){
		$query="UPDATE INT_INTERNOTA SET INT_DIVISION='$INT_DIVISION',INT_PADRE='$INT_PADRE' WHERE INT_ID='$IdPadre'";
		$resultado= $this->db->query($query);
		return 1;
	}

	public function insertar($INTERNOTA,$TOTAL,$CONCEPTO,$WP,$TIENDA,$INT_ESTADO,$INT_DIVISION,$IdPadre,$Piso,$Tipo,$FECHA_ACT){
		$query="  INSERT INTO INT_INTERNOTA(INT_NOTA,INT_LPCS,INT_CONCEPTO,INT_WP_CODE,INT_SHOP,INT_ESTADO, INT_DIVISION,INT_PADRE,INT_PISO,INT_TIPO, INT_FECHA_SET ) VALUES ('$INTERNOTA','$TOTAL','$CONCEPTO','$WP','$TIENDA','$INT_ESTADO','$INT_DIVISION','$IdPadre','$Piso','$Tipo','$FECHA_ACT') ";
		$resultado = $this->db->query($query);
		return 1;

	}

	public function list_single(){
		$query="SELECT TOP 10 INT_SHOP,INT_NOTA,INT_LPCS,INT_PISO,INT_TIPO,INT_CONCEPTO,INT_WP_CODE,INT_FECHA_SET FROM INT_INTERNOTA WHERE INT_LPCS<400 AND INT_DIVISION='No' ORDER BY INT_FECHA_SET DESC";
		$resultado= $this->db->query($query);
		return $resultado->result();

	}

	public function getNTienda($INT_NOTA){
		$query="SELECT COUNT(INT_SHOP) CANTIDAD FROM INT_INTERNOTA WHERE INT_NOTA='$INT_NOTA'";
		$resultado = $this->db->query($query);
	 	return $resultado->row();
	}

	public function getNInternota($INTERNOTA_N){
		$query="SELECT INT_SHOP, INT_NOTA,INT_LPCS, INT_ID FROM INT_INTERNOTA WHERE INT_DIVISION IS NULL AND INT_NOTA='$INTERNOTA_N'";
		$resultado= $this->db->query($query);
		return $resultado->result();

	}
}

?>