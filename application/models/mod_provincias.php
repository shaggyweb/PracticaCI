<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Modelo Provincias
 * Contiene toda la funcionalidad de la lista de provincias
 * @author Mario Vilches Nieves
 */
class mod_provincias extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Método para obtener todos los datos de la tabla provincias
	 */
	function select_provincias()
	{
		$consulta = $this->db->get('provincias');
		return $consulta->result_array();
	}
	
	/**
	 * Método para utilizarlo en el dropbox del select de provincias
	 * @return multitype:NULL
	 */
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