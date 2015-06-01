<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class controlador extends CI_Controller {
	
	/**
	 * Carga la plantilla con la apariencia (cabecera, cuerpo y pie).
	 * @param unknown $cuerpo
	 */
	function Plantilla($cuerpo)
	{
		//Seleccion de todas las categorías para mostrarlas como enlace en la cabecera
		$categoria['categoria'] = $this->mod_productos->listar_categorias();
		
		//Comprobacion de si el usuario está dentro o no, cargará una cabecera distinta
		
		if(!$this->session->userdata('user'))
		{
			$cabecera= $this->load->view("cabecera",$categoria, true); //Carga de cabecera por defecto
		}
		else
		{ 
			$cabecera= $this->load->view("usuario_dentro",$categoria, true); //Carga de cabecera que muestra las opciones del usuario
		}
	
		
	
		$pie= $this->load->view("pie", 0, true);
	
		//Creo la plantilla las distintas partes a mostrar
		$this->load->view('plantilla', array(
				'cabecera' => $cabecera,
				'cuerpo' => $cuerpo,
				'pie' => $pie
		));
	}
	
	/**
	 * Funcion para paginar los productos
	 * @param type $url  url del paginador que se corresponde con el controlador donde nos encontramos
	 * @param type $total_pagina numero de elementos por página
	 * @param type $total_filas numero total de filas
	 * @return type devuelve el paginador
	 */
	function paginador($url,$total_pagina,$total_filas,$segm=4){
	
		$config['uri_segment'] = $segm;
		$config['base_url']= $url;
		$config['total_rows']= $total_filas;
		$config['per_page'] = $total_pagina;
		$config['num_links'] = 2;
		$config['first_link'] = 'Primero';
		$config['last_link'] = 'Último';
		$config['full_tag_open'] = '<div id="paginacion">';
		$config['full_tag_close'] = '</div>';
	
		$this->pagination->initialize($config);
		 
		 
		return $this->pagination->create_links();
	
	}
}