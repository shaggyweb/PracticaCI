<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    require_once APPPATH."/third_party/fpdf/fpdf.php";
 
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Pdf extends FPDF {
        public function __construct($datosPedido = NULL) {
            parent::__construct();
            $this->pedido = $datosPedido;
        }
        // El encabezado del PDF
        public function Header()
        {
        	
        	$fecha_pedido = new DateTime($this->pedido[0]['fecha']);
            $this->Image('./Assets/img/imagen_factura.jpg',10,8,60);
           
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(120,10,'TECNONUBA',0,0,'C');
            $this->Ln(20);
            
            $this->SetFont('Arial', 'I', 8);
            $this->SetY(38);
            $this->SetX(15);
            
            $this->Cell(90,10,"Cliente: {$this->pedido[0]['nombre_cliente']} {$this->pedido[0]['apellidos_cliente']} DNI: {$this->pedido[0]['dni']}",1,'C');
            
            $this->Ln(14);
            
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(15, 7, "Factura N- {$this->pedido[0]['cod_pedido']}", '', 0, 'L', 0);
            $this->SetX(-115);
            $this->Cell(100, 7, "Fecha Pedido: ".$fecha_pedido->format("d-m-Y"),'', 1, 'R', 0);
          
           $this->Cell(25, 7, utf8_decode('N-Producto'), '', 0, 'C', '0');
        $this->Cell(80, 7, 'Producto', '', 0, 'C', '0');
        $this->Cell(15, 7, 'Precio', '', 0, 'C', '0');
        
        $this->Cell(20, 7, 'Cantidad', '', 0, 'C', '0');
        $this->Cell(20, 7, 'Descuento', '', 0, 'C', '0');
        $this->Cell(20, 7, 'Total', '', 0, 'C', '0');
        $this->Ln(7);
       }
       // El pie del pdf
       public function Footer()
       {
       		$this->SetY (-10);
			$this->SetFont('Arial', 'I', 8);
			$this->Cell(170,10,"Tecnonuba - CIF 23456789-A - Avenida Italia N2 - Huelva",0,0,'C');
           	$this->SetY(-15);
           	$this->SetFont('Arial','I',8);
           	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>
