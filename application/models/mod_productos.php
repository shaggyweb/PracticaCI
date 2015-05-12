<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_productos extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * obtener todos las categorias de la tienda
	 * @return type
	 */
	function listar_categorias()
	{
		$consulta = $this->db->get('categorias');
		// Produce: SELECT * FROM categorias
		return $consulta->result_array();
	}
	
	
	//listar todos los productos
	function listar_productos()
	{
		$consulta = $this->db->get('productos');
		return $consulta->result_array();
	}
	
	
	function prod_destacados($inicio,$limit) 
	{
		$this->db->limit($limit, $inicio);
		$this->db->from('productos');
		$this->db->where('destacado like 1');
		$resultado = $this->db->get();
		return $resultado->result_array();
	}
	
	
	//calculo del total de productos destacados
	function prod_destacados_total() {
		$this->db->from('productos');
		$this->db->where('destacado like 1');
		$resultado = $this->db->get();
		return $resultado->num_rows();
	}
	
	//calculo del total de productos de una categoría
	function total_product_categ($datos) {
		$this->db->from('productos');
		$this->db->where('id_cat', $datos);
		$resultado = $this->db->get();
		return $resultado->num_rows();
	}
	
	/**
	 * Busca productos por categorias
	 * recogidos en $datos
	 * @param type $datos
	 * @return type
	 */
	function productos_categoria($datos, $inicio = 0, $limit = 0) {
		$this->db->from('productos');
		$this->db->limit($limit, $inicio);
		$this->db->where('id_cat', $datos);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function nombre_categoria($id){
		$this->db->from('categorias');
		$this->db->where('id_cat', $id);
		$query = $this->db->get();
	
		$reg= $query->row(); // row(): Devuelve el primer registro
		if ($reg){
			return $reg->nombre;
		}else{
			return '';
		}
	}
	
	function detalle_producto($id)
	{
		$this->db->from('productos');
		$this->db->where('id_prod', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

}