<?php
class mod_usuarios extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 *  Función para insertar clientes
	 * @param type $data array de datos
	 */
	function alta_usuario ($data){
		$this->db->insert('usuarios',$data);
	}
	
	function login($usuario,$clave)
	{
		$sql = "select * from usuarios where usuario = '".$usuario."' AND clave = '".$clave."';";
		//print_r($sql);
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
		
	}
}
