<?php
class mod_provincias extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * obtener todos las categorias de la tienda
	 * @return type
	 */
	function select_provincias()
	{
		$consulta = $this->db->get('provincias');
		return $consulta->result_array();
	}
	
	function lista_provincias()
	{
		$consulta = $this->db->get('provincias');
		$rs=$consulta->result();
		
		$provincias=array();
		foreach($rs as $reg)
		{
		   $provincias[$reg->cod_provincia]=$reg->nombre;
		}
		return $provincias;
	}

}