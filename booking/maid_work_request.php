<?php
require_once('inc/session.php');
if ($_SESSION['info']){

 if ($_GET['ref']!=''){

	require_once('init.php');
	$db= new getQueries ();
	$_GET['ref']=str_pad($_GET['ref'], 9, "0", STR_PAD_LEFT);
  	$busy=$db->see_occupancy_ref($_GET['ref']);
   $o=$busy[0];
	$villa_re=$db->villa($o['villa']);
	$owner=$db->show_id('owners',$villa_re[0]['id_owner']);
	if($_GET['d']!=''){
		$hoy=date('Y-m-d',$_GET['d']);
	}else{
		$hoy=date('Y-m-d');
	}
	if(($o['start']<=$hoy)&&($o['end']>=$hoy)){
	 //hacer calculos
		if($o['start']==$hoy){
			$solicitado="Check in";
		}elseif($o['end']==$hoy){
			$solicitado="Check Out";
		}else{
			$solicitado="In House";
		}
		
	}else{
		echo "Error: booking out of range";
		die();
	}

	/*print_r($o);
	die();*/
	
	class PDF extends FPDF
	{
	//private $propiet='Mr. blum';	
	//Cabecera de página
		function Header()
		{
		
	  
		    //Logo
		    $this->Image('images/invoice/simbol.jpg',15,10,40);
		    //Arial bold 15
		   $this->SetFont('Arial','B',15);
		   $this->Cell(60);
		   $this->Cell(60,9,'R.C.L. ADMINISTRACCIONES, SRL.');
		  $this->Cell(60,9,$propiet);
		   $this->Image('images/invoice/letters.jpg',95,18,40);
		   //$this->Ln(1);
		   //$this->Cell(60);
		   //$this->Cell(70,20,'Villa No. '.$villa_re[0]['no']);
		 // $this->Ln(1);
		   $this->SetFont('Times','',8);
		  
		   
		   //$this->Ln(1);
		  // $this->Cell(95);
		   //$this->Cell(95,30,'RNC:'); 
		 $this->Ln(1);
		   $this->Cell(87);
			$this->Cell(87,33,'Cabarete, Republica Dominicana');
		   $this->Ln(20);
		  // $this->Cell(82);
		   //$this->Cell(82,34,'Tel.:809-571-1190 - Fax:809-571-1490');
		    //Salto de línea
		   
		}

	//Pie de página
		function Footer()
		{
			/*
		    //Posición: a 1,5 cm del final
		    $this->SetY(-15);
		    //Arial italic 8
		    $this->SetFont('Arial','I',8);
		    $this->Cell(0,5,'Please, Visit: http://www.CasaLindaCity.com',0,0,'L');
		    $this->Cell(0,5,'Email: Reservations@CasaLindaCity.com',0,0,'R');
		    $this->Ln(1);
		    //Número de página
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');*/

		}

		function FacturaTable($header,$data)
		{
	    //Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(145,142,142);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(56,55,55);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    //Cabecera
	    $w=array(110,35,40);
	     $this->Ln();
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
	    $this->Ln();
	    //Restauración de colores y fuentes
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    //Datos
	    $fill=0;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,$row[0],'LR',0,'C',$fill);
		        $this->Cell($w[1],6,$row[1],'LR',0,'R',$fill);
		       // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		       $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
		       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		    }
	    $this->Cell(array_sum($w),0,'','T');
		}
	}


	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
    $pdf->SetAuthor('ing.joseluis@msn.com');
	$pdf->SetTitle('Residencial Casa Linda-Invoice');
	$pdf->SetFont('Times','',16);
	
	$pdf->Ln(10);
	$pdf->Cell(65);
	
	$pdf->SetFont('Times','',12);$pdf->SetFont('','B');
	$pdf->Cell(60,10,'CLEANING SERVICE WORK ORDER');      //invoice title
	
	$pdf->Ln(20);

	$fecha=date('Y-m-d G:i:s');

	 $pdf->SetFont('Times','',8);
	 $pdf->Cell(110,14,'',0,0);$pdf->Cell(30,14,'Booking no: '.$_GET['ref'],0,0); $pdf->Cell(10,14,'Date: '.$fecha,0,0); 
	 $pdf->Ln(10);
	 $pdf->SetFont('Times','',12);
	 $pdf->Cell(10,14,'Nombre:___________________________________________ ',0,0);
	
	 $pdf->Ln(10);
	 $pdf->Cell(30,14,'Villa: '.$villa_re[0]['no'],'',0,'L',0);
	 $pdf->Cell(30,14,'No. Habitaciones: '.$villa_re[0]['bed'],'',0,'R',0);
	 $pdf->Cell(40,14,'Inicio:___________','',0,'R',0);
	 $pdf->Cell(50,14,'Termino:_______________','',0,'R',0);
	 $pdf->Ln(10);
	 $pdf->SetFont('Times','',8);
	 $pdf->Cell(30,14,'Primer piso:________','',0,'L',0);
	 $pdf->Cell(30,14,'Segundo piso:__________','',0,'L',0);
	 $pdf->Cell(25,14,'Sacudir:___________','',0,'L',0);
	 $pdf->Cell(20,14,'Barrer:_________','',0,'L',0);
	 $pdf->Ln(5);
	 
	 $pdf->Cell(30,14,'Trapear:________','',0,'L',0);
	 $pdf->Cell(30,14,'Banos:__________','',0,'L',0);
	 $pdf->Cell(30,14,'Organizar:_________','',0,'L',0);
	  $pdf->Cell(30,14,'Area/Especifica:_________________________________','',0,'L',0);
	 $pdf->Ln(5);
	 $pdf->Cell(30,14,'Trabajo Solicitado: '.$solicitado,'',0,'L',0);
	 $pdf->Ln(5);
	 $pdf->SetFont('Times','',12);
	 
	 
	 $pdf->Ln(5);
	 $pdf->SetFont('');	
	 $pdf->Ln(5);
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('','U');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(120,6,'Descripcion del trabajo','L',0,'R',0);
	 $pdf->Cell(65,6,'','R',0,'R',0);
	 $pdf->Ln();
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
	 $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->SetFont('');
	 $pdf->Ln();
     $pdf->Cell(185,0,'','T');
	 
	 
	 
	 
	 $pdf->SetFont('');	
	 $pdf->Ln(5);
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('','U');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(120,6,'Instucciones adicionales','L',0,'R',0);
	 $pdf->Cell(65,6,'','R',0,'R',0);
	 $pdf->Ln();
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
	 $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->SetFont('');
	 $pdf->Ln();
     $pdf->Cell(185,0,'','T');
	 
	 
	 
	 $pdf->SetFont('');	
	 $pdf->Ln(5);
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('','U');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(105,6,'Terminos','L',0,'R',0);
	 $pdf->Cell(80,6,'','R',0,'R',0);
	 $pdf->Ln();
	 $pdf->Cell(185,0,'','T');
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
	 $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->SetFont('');
	 $pdf->Ln();
     $pdf->Cell(185,0,'','T');
	 /*NOTE OF ELECTRICITY ONLY IF MID TERM RENTAL*/
	 $time2stamp=time();
     //signature invoice
     $pdf->Ln(10);
     $pdf->Cell(93,6,'Firma:______________________________________',0,0,'L',0);
     $pdf->Cell(93,6,'Fecha:________________________',0,0,'L',0);
     $pdf->Ln(10);
     $pdf->Cell(93,6,'Supervisor:__________________________________',0,0,'L',0);
     $pdf->Cell(93,6,'Fecha:________________________',0,0,'L',0);
     $pdf->Ln(30);
	 $pdf->SetFont('Times','',8);
	 $pdf->Cell(50,6,'Valid for:'.$hoy,0,0,'L',0);
	 $pdf->Cell(135,6,'Number:'.$time2stamp,0,0,'R',0);
	 
	 
     $pdf->Ln();
	$id_adm=$_SESSION['info']['id'];
	$pdf->Output('documents/workorder/'.$time2stamp.'-'.$id_adm.'.pdf', 'F');

	//$ref=$_POST['ref'];
	$src='documents/invoices/'.$invoice_number.'.pdf';
	
	//$link= new subDB();
	//$link->insert_invoice($ref, $src, $id_adm, $invoice_number, $_POST['payable_to']);//insert invoice in db

	$pdf->Output();
 }else{
	//header('Location:invoices.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>