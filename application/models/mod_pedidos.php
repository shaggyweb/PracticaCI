<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_pedidos extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	function crear_pedido($datos)
	{
		$this->db->insert('pedido',$datos);
	}
	
	function ultimo_id()
	{
		return $this->db->insert_id();
	}
	
	function crear_linea_pedido($datos)
	{
		$this->db->insert('linea_pedido',$datos);
	}
	
	function buscar_pedido($cod_pedido)
	{
		$this->db->where('cod_pedido', $cod_pedido);
		$query = $this->db->get('pedido');
		return $query->result_array();
		
	}
	
	function buscar_linea_pedidos($cod_pedido)
	{
		$this->db->where('cod_pedido', $cod_pedido);
		$query = $this->db->get('linea_pedido');
		return $query->result_array();
	}
	
	function pedidos_usuario($usuario)
	{
		$this->db->where('cod_usuario',$usuario);
		$query = $this->db->get('pedido');
		return $query->result_array();
	}
	
	function anular_pedidos($id_pedido,$estado)
	{
		$this->db->where('cod_pedido', $id_pedido);
		$data = array(
				'estado' => $estado);
		//var_dump($estado);
		$this->db->update('pedido', $data);
	}
	
	function linea_pedidos_factura($datos){
		$this->db->where($datos);
		$query = $this->db->get('linea_pedido');
		return $query->result_array();
	}
}
