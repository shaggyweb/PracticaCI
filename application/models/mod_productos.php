<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modelo Productos
 * Contiene toda la funcionalidad de los productos
 * @author Mario Vilches Nieves
 */
class mod_productos extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * Método para obtener todas las categorias de la tienda
	 * @return type
	 */
	function listar_categorias()
	{
		$consulta = $this->db->get('categorias');
		// Produce: SELECT * FROM categorias
		return $consulta->result_array();
	}
	
	
	/**
	 * Método para listar todos los productos
	 */
	function listar_productos()
	{
		$consulta = $this->db->get('productos');
		return $consulta->result_array();
	}
	
	/**
	 * Método para mostrar los productos destacados
	 * @param unknown $inicio
	 * @param unknown $limit
	 */
	function prod_destacados($inicio,$limit) 
	{
		$this->db->limit($limit, $inicio);
		$this->db->from('productos');
		$this->db->where('destacado like 1');
		$resultado = $this->db->get();
		return $resultado->result_array();
	}
	
	
	/**
	 * Método para calcular el total de productos destacados
	 */
	function prod_destacados_total() {
		$this->db->from('productos');
		$this->db->where('destacado like 1');
		$resultado = $this->db->get();
		return $resultado->num_rows();
	}
	
	//calculo del total de productos de una categoría
	/**
	 * Método para calcular el total de productos de una categoría
	 * @param string $datos ID de la categoría
	 */
	function total_product_categ($datos) {
		$this->db->from('productos');
		$this->db->where('id_cat', $datos);
		$resultado = $this->db->get();
		return $resultado->num_rows();
	}
	
	/**
	 * Método para buscas productos por categorias
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
	
	/**
	 * Método que devuelve el nombre de una categoría
	 * @param integer $id ID de la categoría
	 * @return string Nombre de la categoría
	 */
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
	
	/**
	 * Método que devuelve los detalles de un producto
	 * @param integer $id ID del producto
	 */
	function detalle_producto($id)
	{
		$this->db->from('productos');
		$this->db->where('id_prod', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/**
	 * Método que devuelve los datos de un producto
	 * @param integer $id ID del producto
	 */
	function obtener_producto_id($id) {
        $this->db->where(array('id_prod' => $id));
        $query = $this->db->get('productos');
        return $query->row_array();
    }
    
    /**
     * Método que devuelve el stock de un producto
     * @param integer $id ID del producto
     */
    function hay_existencias($id)
    {
    	$this->db->select('stock');
    	$this->db->where('id_prod', $id);
    	return $this->db->get('productos')->row_array()['stock'];
    }
    
    /**
     * Método que actualiza el stock de un producto
     * @param integer $cod_prod Código del producto
     * @param integer $actual_stock Nuevo stock del producto tras venta
     */
    function actualizacion_stock($cod_prod, $actual_stock)
    {
    	$this->db->where('id_prod', $cod_prod);
    	$this->db->update('productos', array(
    			'stock' => $actual_stock
    	));
    }

}