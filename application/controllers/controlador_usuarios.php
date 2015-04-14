<?php
class controlador_usuarios extends CI_Controller 
{

	public function alta()
	{
		//Obtencion de todas las provincias para crear el select
		$provincias['provincias'] = $this->mod_provincias->lista_provincias();
		
		$categoria['categoria'] = $this->mod_productos->listar_categorias();
	
		$cabecera= $this->load->view("cabecera",$categoria, true);
	
		$pie= $this->load->view("pie", 0, true);
		
		$cuerpo=$this->load->view('alta_usuario',$provincias,true);
	
		//Creo la plantilla las distintas partes a mostrar
		$this->load->view('plantilla', array(
				'cabecera' => $cabecera,
				'cuerpo' => $cuerpo,
				'pie' => $pie
		));
		
		//$this->load->view('alta_usuario',$provincias,true);
	}
}