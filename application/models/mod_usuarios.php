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
		$sql = "select * from usuarios where usuario = '".$usuario."' AND clave = '".$clave."' and activo=1;";
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
	
	function buscar_usuario($usuario){
		$sql=$this->db->query("select * from usuarios
				where usuario = \"$usuario\"
				");
		
		return $sql->result_array();
	}
	
	function modificar_usuario($cod_usuario, $datos){
		$this->db->where('cod_usuario', $cod_usuario);
	
		if($this->db->update('usuarios', $datos)){
			return true;
	
		}  else {
	
			return false;
		}
	}
	
	function existe_nombre_user($nombre)
	{
	
		$sql="select * from usuarios where usuario = '$nombre'";
		
			$resultado = $this->db->query($sql);
		
			return $resultado->result_array();
		
	}
	
	function baja_user($cod)
	{
		$usuario = array(
				'activo' => false
		);
		
		$this->db->where('cod_usuario', $cod);
		$this->db->update('usuarios', $usuario);
		
	}
}