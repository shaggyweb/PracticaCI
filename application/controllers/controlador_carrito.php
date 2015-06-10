<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require(__DIR__.'/controlador.php');

/**
 * Controlador Carrito
 * Contiene toda la funcionalidad del carrito de compra
 * @author Mario Vilches Nieves
 */

class controlador_carrito extends controlador {
    function __construct() {
        parent::__construct();
    }
    
    /**
     * Método añadir a carrito
     * Añade artículos al carrito de la compra
     */
    function anadir()
    {
    	
    
    			$cantidad=1;
    			$id_prod = $this->input->post('id_prod');
    			
    			//Consulta para buscar producto por id
    			$producto = $this->mod_productos->obtener_producto_id($id_prod);
    			
    			//obtenemos el contenido del carrito
    			$carrito = $this->cart->contents();
    			
    			foreach ($carrito as $prod_carro) {
    				//si el id del producto es igual que uno que ya tengamos
    				//en el carrito le sumamos uno a la cantidad ya almacenada en carrito
    				if ($prod_carro['id'] == $id_prod) {
    					$cantidad = 1 + $prod_carro['qty'];
    				}
    			}
    			
    			//precio descuento es igual al precio menos su descuento
    			$precio_descuento=$this->precio_descuento($producto['precio'], $producto['descuento']);
    			//precio total es el que surge de multiplicar el precio con el descuento incluido y la cantidad del producto
    			$precio_total=$this->precio_total_prod($precio_descuento, $cantidad);
    			
    	
    			$datos = array(
    				'id' => $id_prod,
    				'qty' => $cantidad,
    				'price'=>$precio_descuento,
    				'name' => $producto['nombre'],
    				'descuento' => $producto['descuento'],
    				'iva' => $producto['iva'],
    				'precio_no_descuento'=>$producto['precio'],
    				'precio_total'=>$precio_total
    			);
    			$this->cart->insert($datos);
    		
    			redirect('controlador_carrito/ver_carrito');
    	
    		
    }
    
    /**
     * Método ver carrito de la compra
     * Utilizado para mostrar los artículos contenidos en el carro de la compra
     */
    function ver_carrito()
    {
    	$datos['productos'] = $this->cart->contents();
    	
    	$cuerpo = $this->load->view('ver_carro', $datos, true);
    	$this->Plantilla($cuerpo);
    }
    
    /**
     * Método que calcula precio de descuento de un producto
     * @param float $precio Precio del producto
     * @param float $descuento Descuento en € del producto
     * @return float $precio_descuento Precio del producto con el descuento realizado
     */
    function precio_descuento($precio, $descuento=0) 
    {
    	$precio_descuento=$precio-$descuento;
    	return $precio_descuento;
    }
    
    /**
     * Método que calcula el importe total de un producto
     * Multiplica el precio del producto por el número de unidades de dicho producto
     * @param float $precio_descuento Precio del producto con descuento incluido
     * @param integer $cantidad Número de unidades del producto
     * @return float $precio_total Importe total del producto
     */
    function precio_total_prod($precio_descuento,$cantidad)
    {
    	$precio_total=$precio_descuento*$cantidad;
    	return $precio_total;
    }
    
    /**
     * Método para quitar una unidad de un producto en el carrito de compra
     * @param integer $id ID del producto a disminuir en el carrito
     * @param integer $cantidad Número de unidades del producto ya contenidas en el carrito
     */
    function quitar_uni_prod($id,$cantidad)
    {
    	
    	$producto = array(
    			'rowid' => $id,
    			'qty' => $cantidad-1
    			
    	);
    	//después simplemente utilizamos la función update de la librería cart
    	//para actualizar el carrito pasando el array a actualizar
    	$this->cart->update($producto);
       	redirect('controlador_carrito/ver_carrito');
    }
    
    /**
     * Método para sumar una unidad de un producto den el carrito de compra
     * @param integer $id ID del producto a aumentar en el carrito
     * @param integer $cantidad Número de unidades del producto ya contenidas en el carrito
     */
    function sumar_uni_prod($id,$cantidad)
    {
    	 
    	$producto = array(
    			'rowid' => $id,
    			'qty' => $cantidad+1
    			
    	);
    	//después simplemente utilizamos la función update de la librería cart
    	//para actualizar el carrito pasando el array a actualizar
    	$this->cart->update($producto);
    	redirect('controlador_carrito/ver_carrito');
    }
    
    /**
     * Método para eliminar por completo un producto del carrito de compra
     * Se pondrá la canrtidad del producto a 0
     * @param integer $id ID del producto a eliminar del carrito
     */
    function eliminar_prod($id)
    {
    	$producto = array(
    			'rowid' => $id,
    			'qty' => 0
    			 
    	);
    	//después simplemente utilizamos la función update de la librería cart
    	//para actualizar el carrito pasando el array a actualizar
    	$this->cart->update($producto);
    	redirect('controlador_carrito/ver_carrito');
    	
    	
    }
    
    /**
     * Método para finalizar la compra contenida en el carrito de la compra
     * Sólo se podrá terminar la compra si hay sesión iniciada. Se disminuirá el stock de los productos
     * y se avisará de ausencia de stock de productos si fuera necesario. Se creará el pedido y la línea de pedido.
     * Se mandarán los emails con la factura en PDF y con el detalle de la compra.
     */
    function comprar()
    {
    	//obtener numero de productos en carrito
    	$num_productos = $this->cart->total_items();
    	$sin_existencias = $this->comprobar_existencias();
    	
    	
    	if (!$this->session->userdata('logueado'))
    	{
    		$cuerpo = $this->load->view('no_logueado', 0, true);
    		$this->Plantilla($cuerpo);
    	}
    	else
    	{
    		if ($num_productos==0)
    		{
    			$cuerpo = $this->load->view('carrito_vacio', 0, true);
    			$this->Plantilla($cuerpo);
    		}
    		else
    		{
    			if(count($sin_existencias) > 0)
    			{
    				
    				$datos['productos']=$this->comprobar_existencias();
    				$cuerpo = $this->load->view('sin_existencias', $datos, true);
    				$this->Plantilla($cuerpo);
    				
    			}
    			else
    			{
    				//Creación del pedido con los productos y datos del cliente
    				
    				$usuario=$this->session->userdata('user');
    				$cliente=$this->mod_usuarios->buscar_usuario($usuario);
    				
    				$pedido=array('cod_usuario'=>$cliente[0]['cod_usuario'],
    						'fecha' => date('Y-m-d'),
    						'estado'=>'P',
    						'direccion'=>$cliente[0]['direccion'],
    						'nombre_cliente'=>$cliente[0]['nombre'],
    						'apellidos_cliente'=>$cliente[0]['apellidos'],
    						'poblacion'=>$cliente[0]['poblacion'],
    						'cod_provincia'=>$cliente[0]['cod_provincia'],
    						'cod_postal'=>$cliente[0]['cod_postal'],
    						'dni'=>$cliente[0]['dni']
    						
    				);
    				
    				$this->mod_pedidos->crear_pedido($pedido);
    				$ultimo_id_pedido=$this->mod_pedidos->ultimo_id();
    				
    				//Productos del carrito para elaborar la linea de pedido
    				$productos_carrito = $this->cart->contents();
    				
    				foreach ($productos_carrito as $producto) 
    				{
    					$linea_pedido = array(
    							'cod_pedido' => $ultimo_id_pedido,
    							'id_prod' => $producto['id'],
    							'cantidad' => $producto['qty'],
    							'precio' => $producto['price'],
    							'descuento' => $producto['descuento'],
    							'iva' => $producto['iva']
    					);
    					$this->mod_pedidos->crear_linea_pedido($linea_pedido);
    					
    					//actualizacion del stock
    					
    					$stock=$this->mod_productos->hay_existencias($producto['id']);
    					$actual_stock = $stock - $producto['qty'];
    					$this->mod_productos->actualizacion_stock($producto['id'], $actual_stock);
    					
    				}
    				
    				$this->ver_ultimo_pedido($ultimo_id_pedido);
    				$this->envio_detalles($this->crear_mensaje(),$ultimo_id_pedido); //enviamos email con detalles pedido
    				$this->cart->destroy();//destruimos el carrito
    				$modo="crea"; //variable para saber si guardo la factura o la muestro
    				$this->crear_factura($ultimo_id_pedido,$modo); //generamos el pdf de la factura
    				$this->enviar_email($ultimo_id_pedido); //enviamos email con PDF de la factura
    				
    			}	
    		}
    	}
    }
    
    /**
     * Método para comprobar las existencias de los productos
     * @return array $productos_existencias Array que contendrá los productos sin existencias suficientes
     */
    function comprobar_existencias()
    {
    	$productos_existencias=[]; //Array que guardará informacion de productos sin existencia
    	$productos_carrito=$this->cart->contents(); //Array con los productos existentes en el carrito de compra
    	
    	foreach ($productos_carrito as $producto)
    	{
    		if ($producto['qty'] > $this->mod_productos->hay_existencias($producto['id'])) 
    		{ 
    			//No hay stock suficiente
    			
    			$productos_existencias[]= $producto;
    		}
    	}
    	return $productos_existencias;
    }
    
    /**
     * Método para ver los detalles del último pedido realizado
     */
    function ver_ultimo_pedido($pedido)
    {
    	
    	$datos['pedido']=$this->mod_pedidos->buscar_pedido($pedido);
    	$datos['productos']=$this->cart->contents();
    	$datos['total'] = $this->cart->total();
    	$datos['fecha']=$this->transformar_fecha($datos['pedido'][0]['fecha']);
    
    	$cuerpo = $this->load->view('resumen_pedido', $datos, true);
    	$this->Plantilla($cuerpo);
    	
    }
    
    /**
     * Método para transformar una fecha en formato americano a formato europeo
     * @param string $fecha1 Fecha en formato americano (año/mes/día)
     * @return string $fecha2 Fecha en formato europeo (día/mes/año)
     */
    function transformar_fecha($fecha1)
    {
    	//formato fecha americana
    	
    	$fecha2=date("d-m-Y",strtotime($fecha1));
    	return $fecha2;
    }
    
    /**
     * Método para mostrar la lista de pedidos de un cliente
     */
    function mostrar_pedidos()
    {
    	$user=$this->session->userdata('user');
    	$usuario=$this->mod_usuarios->buscar_usuario($user);
    	$id_usuario=$usuario[0]['cod_usuario'];
    	
    	$lista_pedidos=$this->mod_pedidos->pedidos_usuario($id_usuario);
    	
    	$pedidos=[];
    	
    	foreach ($lista_pedidos as $pedido) //bucle para transformar la fecha del pedido a formato dia/mes/año
    	{
    		$fecha_mod=$this->transformar_fecha($pedido['fecha']);
    		$pedido['fecha']=$fecha_mod;
    		$estado_traducido=$this->traducir_estado($pedido['estado']);
    		$pedido['estado']=$estado_traducido;
    		
    		array_push($pedidos,$pedido);
    	}
    	
    	$datos['pedidos']=$pedidos;
    	
    	$cuerpo = $this->load->view('lista_pedidos', $datos, true);
    	$this->Plantilla($cuerpo);
    	
    }
    
    /**
     * Método para mostrar el detalle de un pedido en concreto
     * @param integer $pedido Código del pedido a mostrar
     */
    function detalles_pedido($pedido)
    {
    	
    	$linea_pedido=$this->mod_pedidos->buscar_linea_pedidos($pedido);
    	$productos=[];
    	
    	foreach ($linea_pedido as $valor=>$clave)
    	{
    		$producto=$this->mod_productos->obtener_producto_id($clave['id_prod']);
    		$clave['nombre']=$producto['nombre'];
    		
    		
    		array_push($productos, $clave);
    	}
    	
    	$datos['productos']=$productos;
    	
    	$cuerpo = $this->load->view('detalles_pedido', $datos, true);
    	$this->Plantilla($cuerpo);
    	
    }
   
    /**
     * Método para anular un pedido
     * Sólo se podrá anular si está marcado en la BD como P de pendiente.
     * Si aparece como E, procesado, R, recepcionado, o como A, anulado no podrá anularse el pedido.
     * @param integer $id ID del pedido a anular
     */
   function anular_pedido($id)
   {
   		$pedido=$this->mod_pedidos->buscar_pedido($id);
   		
   		if ($pedido[0]['estado']!='P')
   		{
   			$cuerpo = $this->load->view('error_anular', 0, true);
   			$this->Plantilla($cuerpo);
   		}
   		else
   		{
   			
    		$estado='A'; //estado A de anulado
    		$this->mod_pedidos->anular_pedidos($id,$estado);
    		
    		$this->mostrar_pedidos();
   		}
   }
   
   /**
    * Método para escribir el estado de un pedido
    * Traduce el carácter contenido en la BD
    * @param string $caracter Estado del pedido incluido en la BD
    * @return string Devuelve el estado del pedido
    */
   function traducir_estado($caracter)
   {
   		if ($caracter=="A")
   		{
   			return "Anulado";
   		}
   		if ($caracter=="P")
   		{
   			return "Pendiente";
   		}
   		if ($caracter=="E")
   		{
   			return "Procesado";
   		}
   		if ($caracter=="R")
   		{
   			return "Recepcionado";
   		}
   }
   
   /**
    * Método para crear la factura de un pedido
    * @param integer $id_pedido ID del pedido del que se crea la factura
    * @param string $modo Permite crearnfactura, en un nuevo pedido, o mostrarla en una consulta de pedido
    */
   function crear_factura($id_pedido,$modo)
   {
   	
   		//obtenemos los datos del pedido
   		$pedido = $this->mod_pedidos->buscar_pedido($id_pedido);
   		
   		//obtenemos los productos del pedido
   		$linea_pedido = $this->mod_pedidos->buscar_linea_pedidos($pedido[0]['cod_pedido']);
   	
   		/*
   		 *Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
   		 * heredo todos las variables y metodos de fpdf
   		*/
   		$this->pdf = new pdf($pedido);
   		// Agregamos una página
   		$this->pdf->AddPage();
   		// Define el alias para el número de página que se imprimirá en el pie
   		$this->pdf->AliasNbPages();
   		/* Se define el titulo, margenes, derecho y
   		 * el color de relleno predeterminado
   		*/
   	
   		$this->pdf->SetTitle("Factura " . $pedido[0]['cod_pedido']);
   		$this->pdf->SetLeftMargin(15);
   		$this->pdf->SetRightMargin(15);
   		$this->pdf->SetFillColor(200, 200, 200);
   		$this->pdf->SetFont('Arial', 'B', 8);
   		$x = 1;
   		$subtotal = 0;
   		$iva = 0;
   		$total=0;
   		
   		foreach ($linea_pedido as $l) 
   		{
   			$total_prod=0;
   			$producto = $this->mod_productos->obtener_producto_id($l['id_prod']);
   			$this->pdf->Cell(15, 7, $x++, 'BL', 0, 'C', '0');
   			$this->pdf->Cell(85, 7, utf8_decode($producto['nombre']), 'B', 0, 'C', '0');
   			$this->pdf->Cell(20, 7, $producto['precio'] . " Eur", 'B', 0, 'C', '0');
   			
   			$this->pdf->Cell(20, 7, $l['cantidad'], 'B', 0, 'C', '0');
   			$this->pdf->Cell(20, 7, $l['descuento'] .  " Eur", 'B', 0, 'C', '0');
   			$total_prod = ($l['precio'] * $l['cantidad']);
   			
   			$total+=$total_prod;
   			$this->pdf->Cell(20, 7, round($total_prod, 2) . " Eur", 'BR', 0, 'C', '0');
   			$this->pdf->Ln(7);
   			$iva += $total_prod * ($l['iva'] / 100);
   			
   		}
   		
   		$subtotal+=($total-$iva);
   		
   		
   		$this->pdf->Ln(7);
   		$this->pdf->setX(155);
   		$this->pdf->Cell(20, 7, "Subtotal", '', 0, 'R', '1');
   		$this->pdf->Cell(20, 7, round($subtotal, 2) . " Eur", 'B', 1, 'C', '0');
   		$this->pdf->setX(155);
   		$this->pdf->Cell(20, 7, "IVA 21%", 'T', 0, 'R', '1');
   		$this->pdf->Cell(20, 7, round($iva, 2) . " Eur", 'B', 1, 'C', '0');
   		$this->pdf->setX(155);
   		$this->pdf->Cell(20, 7, "Total", 'TB', 0, 'R', '1');
   		$this->pdf->Cell(20, 7, round($subtotal + $iva, 2) . " Eur", 'B', 1, 'C', '0');
   		
   		if ($modo=="imprime")
   		{
   			$this->pdf->Output(APPPATH . "../pdf/fact_pedido_n" . $pedido[0]['cod_pedido'] . ".pdf", 'I');
   		}
   		else if ($modo=="crea")
   		{
   			$this->pdf->Output(APPPATH . "../pdf/fact_pedido_n" . $pedido[0]['cod_pedido'] . ".pdf", 'F');
   			//$cuerpo = $this->load->view('lista_pedidos', 0, true);
   			//$this->Plantilla($cuerpo);
   		}
   		//Podemos mostrar con I, descargar con D, o guardar con F
   		
   		
   		//$this->pdf->Output(APPPATH . "../pdf/fact_pedido_n" . $pedido[0]['cod_pedido'] . ".pdf", 'D');
   		
   		/*$cuerpo = $this->load->view('lista_pedidos', 0, true);
   		$this->Plantilla($cuerpo);*/
   	
   }

/**
 * Método para enviar email con la factura
 * @param integer $id_pedido ID del pedido del que enviamos factura
 */
function enviar_email($id_pedido)
   {
   	//obtenemos los datos del pedido
   	$pedido = $this->mod_pedidos->buscar_pedido($id_pedido);
   	//obtenemos los datos del usuario
   	$nombre_user=$this->session->userdata('user');
   	$usuario=$this->mod_usuarios->buscar_usuario($nombre_user);
   	
   	$config['protocol'] = 'smtp';
   	$config['smtp_host'] = 'mail.iessansebastian.com';
   	$config['smtp_user'] = 'aula4@iessansebastian.com';
   	$config['smtp_pass'] = 'daw2alumno';
   	$config['mailtype'] = 'html';
   	$this->email->initialize($config);
   	$this->email->from('aula4@iessansebastian.com', 'Tecnonuba');
   	$this->email->to($usuario[0]['correo']);
   	$this->email->subject('Factura Pedido ' . $id_pedido);
   	$this->email->message("<html><body><h2>Gracias por su compra. Le adjuntamos la factura de su pedido</h2></body></html>");
   	$fileName=APPPATH."../pdf/fact_pedido_n".$id_pedido.".pdf";
   	$this->email->attach($fileName);
   	
   	$this->email->send();
   	
   }
   
   /**
    * Método para crear el cuerpo del mensaje del email de detalles del pedido
    * @return string $mensaje HTML que contendrá el email de detalles
    */
   function crear_mensaje()
   {
   		
   		$productos = $this->cart->contents();
   		
   		//Iniciamos parte del emsanje a enviar
   		
   		$mensaje="<html><body><h2>Gracias por su compra. A continuación puede ver un resumen de su compra.</h2>
   				<table border=\"1\">
   						<tr><th>Producto</th><th>Precio Sin Descuento</th><th>Precio Descuento</th><th>Unidades</th><th>Total</th></tr>";
   		
   		foreach ($productos as $producto):
   		
   			$tot=$producto['price']*$producto['qty'];
   			$mensaje=$mensaje."<tr><td>".$producto['name']."</td><td>".$producto['precio_no_descuento']."</td><td>".$producto['price']."</td>
   				<td>".$producto['qty']."</td><td>".$tot."</td></tr>";
   		            	
   		endforeach;
   		            	
   		            	
   		return $mensaje;
   		
   }
   
   /**
    * Método para enviar email con detalles del pedido
    * @param string $texto HTML del email de detalles del pedido
    * @param string $id_pedido ID del pedido del que enviamos los detalles
    */
   function envio_detalles($texto,$id_pedido)
   {
   	
   	//obtenemos los datos del usuario
   	$nombre_user=$this->session->userdata('user');
   	$usuario=$this->mod_usuarios->buscar_usuario($nombre_user);
   	
   	$config['protocol'] = 'smtp';
   	$config['smtp_host'] = 'mail.iessansebastian.com';
   	$config['smtp_user'] = 'aula4@iessansebastian.com';
   	$config['smtp_pass'] = 'daw2alumno';
   	$config['mailtype'] = 'html';
   	$this->email->initialize($config);
   	$this->email->from('aula4@iessansebastian.com', 'Tecnonuba');
   	$this->email->to($usuario[0]['correo']);
   	$this->email->subject('Detalle Pedido '.$id_pedido);
   	$this->email->message($texto);
   	
   	$this->email->send();
   	
   }
}
