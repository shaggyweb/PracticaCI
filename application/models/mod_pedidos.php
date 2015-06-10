<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo Pedidos
 * Contiene toda la funcionalidad de los pedidos
 * @author Mario Vilches Nieves
 */
class mod_pedidos extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método para insertar un pedido
	 * @param array $datos Datos del pedido a insertar
	 */
	function crear_pedido($datos)
	{
		$this->db->insert('pedido',$datos);
	}
	
	/**
	 * Método que devuelve el último id de pedido
	 */
	function ultimo_id()
	{
		return $this->db->insert_id();
	}
	
	/**
	 * Método para crear una línea de pedido
	 * @param array $datos Array con los datos que componen la línea de pedido
	 */
	function crear_linea_pedido($datos)
	{
		$this->db->insert('linea_pedido',$datos);
	}
	
	/**
	 * Método que busca un pedido en concreto
	 * @param integer $cod_pedido Código del pedido a buscar
	 */
	function buscar_pedido($cod_pedido)
	{
		$this->db->where('cod_pedido', $cod_pedido);
		$query = $this->db->get('pedido');
		return $query->result_array();
		
	}
	
	/**
	 * Método para buscar la línea de pedido de un pedido en concreto
	 * @param integer $cod_pedido Código de pedido buscado
	 */
	function buscar_linea_pedidos($cod_pedido)
	{
		$this->db->where('cod_pedido', $cod_pedido);
		$query = $this->db->get('linea_pedido');
		return $query->result_array();
	}
	
	/**
	 * Método para buscar los pedidos de un usuario en concreto
	 * @param integer $usuario Código del usuario a buscar
	 */
	function pedidos_usuario($usuario)
	{
		$this->db->where('cod_usuario',$usuario);
		$query = $this->db->get('pedido');
		return $query->result_array();
	}
	
	/**
	 * Método para anular un pedido
	 * @param integer $id_pedido ID del pedido a anular
	 * @param string $estado Estado al que pasará el pedido
	 */
	function anular_pedidos($id_pedido,$estado)
	{
		$this->db->where('cod_pedido', $id_pedido);
		$data = array(
				'estado' => $estado);
		
		$this->db->update('pedido', $data);
	}
	
	/**
	 * Método que devuelve una línea de pedido para crear la factura
	 * @param array $datos
	 */
	function linea_pedidos_factura($datos){
		$this->db->where($datos);
		$query = $this->db->get('linea_pedido');
		return $query->result_array();
	}
}
