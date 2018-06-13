<?php
//require_once('inc/session.php');
require_once('init.php');

class PDF extends FPDF
{
//Cabecera de página
	function Header()
	{
	    //Logo
	    $this->Image('images/logo.jpg',15,10,40);
	    //Arial bold 15
	    $this->SetFont('Arial','B',15);
	    //Movernos a la derecha
	    $this->Cell(80);
	    //Título
	    $this->Cell(60,9,'Residencial Casa Linda',1,0,'C');
	    //Salto de línea
	    $this->Ln(20);
	}

//Pie de página
	function Footer()
	{
	    //Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    //Arial italic 8
	    $this->SetFont('Arial','I',8);
	    //Número de página
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo línea número '.$i,0,1);
$pdf->Output();


?>