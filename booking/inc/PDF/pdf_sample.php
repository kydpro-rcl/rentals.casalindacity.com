<?
	//require_once('../../init.php');
	require('fpdf.php');
	$PDF = new FPDF();
	$PDF->AddPage();
	$PDF->SetFont('Arial', 'B', 16);
	$PDF->Cell(100, 10, 'Hello World-joseluis!');
	$PDF->Cell(60, 10, 'Hecho para RCL!');
	$PDF->Output('invoice_sample.pdf', 'F');
	
	$PDF->Output();
?>