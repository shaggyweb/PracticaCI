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
            $this->Image('./Assets/img/fondo.jpg',10,8,22);
            //$this->SetFont('Arial','B',13);
            //$this->Cell(30);
            //$this->Cell(120,10,'ESCUELA X',0,0,'C');
            $this->Ln('5');
            $this->SetFont('Arial','B',8);
            $this->Cell(30);
            $this->Cell(120,10,'TECNONUBA',0,0,'C');
            $this->Ln(20);
            
            $this->SetFont('Arial', 'I', 8);
            $this->SetY(38);
            $this->SetX(15);
            //$this->Cell(80, 7, "Vendedor:", 0, 1, 'L', 0);
            //$this->SetY(38);
            //$this->SetX(-95);
            //Cell(20, 7, "Subtotal", '', 0, 'R', '1');
            $this->Cell(90,10,"Cliente: {$this->pedido[0]['nombre_cliente']} {$this->pedido[0]['apellidos_cliente']} DNI: {$this->pedido[0]['dni']}",1,'C');
            //$this->Cell(80, 7, "Cliente:", 0, 1, 'L', 0);
            //$this->SetFont('Arial', 'I', 10);
           
           	//$this->SetX(15);
           //	$this->SetY(45);
           	
           	//$this->Cell(20,10,"DNI: {$this->pedido[0]['nombre_cliente']}",0,0,'C');
            //$this->MultiCell(80, 7, "Tienda Virtual \nCIF A28120368", 'TBLR', 'C', '1');
           // $this->SetY(45);
           // $this->SetX(-95);
            //$this->SetFont('Arial', 'I', 8);
            //$this->SetFont('Arial', 'I', 10);
            //$this->Cell(80, 7, "{$this->pedido[0]['nombre_cliente']}",1,1,'C');
            //$this->MultiCell(80, 7, "{$this->pedido[0]['nombre_cliente']} {$this->pedido[0]['apellidos_cliente']} \nDNI {$this->pedido[0]['dni']}", 'TBLR', 'C', '1');
            $this->Ln(14);
            
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(15, 7, "Factura N- {$this->pedido[0]['cod_pedido']}", '', 0, 'L', 0);
            $this->SetX(-115);
            $this->Cell(100, 7, "Fecha Pedido: ".$fecha_pedido->format("d-m-Y"),'', 1, 'R', 0);
           // $this->Ln(10);
           $this->Cell(25, 7, utf8_decode('N-Producto'), '', 0, 'C', '0');
        $this->Cell(80, 7, 'Producto', '', 0, 'C', '0');
        $this->Cell(15, 7, 'Precio', '', 0, 'C', '0');
        //$this->Cell(20, 7, 'IVA', '', 0, 'C', '0');
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
			//$this->Cell(120,10,'TECNONUBA',0,0,'C');
			$this->Cell(170,10,"Tecnonuba - CIF 23456789-A - Avenida Italia N2 - Huelva",0,0,'C');
           	$this->SetY(-15);
           	$this->SetFont('Arial','I',8);
           	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }
    }
?>
