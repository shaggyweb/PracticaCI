<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(__DIR__.'/controlador.php');

class controlador_productos extends controlador {
    function __construct() {
        parent::__construct();
    }
  
    function productos_categoria($categoria, $inicio = 0) 
    {
        //parametros para el paginador
        $url = site_url('controlador_productos/productos_categoria/' . $categoria . '/');
        $total_pagina = 2;
        $total_filas = $this->mod_productos->total_product_categ($categoria);
        $segm = 4;
        //llamada al paginador      
        $datas['paginador'] = $this->paginador($url, $total_pagina, $total_filas, $segm);
        $productos = $this->mod_productos->productos_categoria($categoria, $inicio, $total_pagina);
        $titulo = $this->mod_productos->nombre_categoria($categoria);
        $datas['titulo'] = $titulo;
        $datas['productos'] = $productos;
        $datas['categoria'] = $this->mod_productos->listar_categorias();
        $cuerpo= $this->load->view('lista_productos', $datas, TRUE);
        $this->Plantilla($cuerpo);
    }
    
    function mostrar_detalles($id)
    {
    	$productos=$this->mod_productos->detalle_producto($id);
    	
    	//print_r($productos);
    	
    	$datas['productos']=$productos;
    	
    	$cuerpo=$this->load->view('detalle_producto',$datas,true);
    	
    	$this->Plantilla($cuerpo);
    }
    
}

