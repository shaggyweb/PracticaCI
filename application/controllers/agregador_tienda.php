<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . '/libraries/json_webserver_controller.php');
class agregador_tienda extends json_webserver_controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->RegisterFunction('Total()', 'Devuelve el número de elementos que tenemos en la tienda');
		$this->RegisterFunction('Lista(offset, limit)', 'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
	}
	public function Total() 
	{
		return $this->mod_productos->prod_destacados_total();
	}
	public function Lista($offset, $limit) 
	{
		$destacados = $this->mod_productos->prod_destacados($offset, $limit);

		foreach ($destacados as $clave => $valor) 
		{
			$lista[] = [
					'nombre' => $valor["nombre"],
					'descripcion' =>$valor["descripcion"],
					'precio' => $valor["precio"],
					'img' => base_url('/Assets/img/'.$valor['imagen']),
					'url' => site_url('/controlador_productos/mostrar_detalles/'.$valor['id_prod'])
			];
		}
		
		return $lista;
	}
}