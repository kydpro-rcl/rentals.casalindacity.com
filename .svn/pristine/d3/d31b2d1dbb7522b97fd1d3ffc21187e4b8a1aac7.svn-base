<?php
require_once('inc/session.php');
if ($_SESSION['info']){

  // $_POST['referal_id']=19;

 if ($_POST['referal_id']!=''){

	require_once('init.php');
	 $db= new getQueries ();
	//$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);

  	$bookings_found=$db->bookings_referal($_POST['referal_id']);




    if (empty($bookings_found)){ die('No bookings Found...');}


	class PDF extends FPDF
	{
	//Cabecera de página
		function Header()
		{
		    //Logo
		    $this->Image('images/invoice/simbol.jpg',15,10,40);
		    //Arial bold 15
		    $this->SetFont('Arial','B',15);
		    //Movernos a la derecha
		    $this->Cell(60);
		    //Título
		   // $this->Cell(60,9,'R.C.L. ADMINISTRACCIONES, S.A.',1,0,'C');
		   $this->Cell(60,9,'R.C.L. ADMINISTRACCIONES, SRL.');
		   $this->Image('images/invoice/letters.jpg',95,18,40);
		  $this->Ln(1);
		   $this->SetFont('Times','',8);
		   $this->Cell(87);
		   $this->Cell(87,30,'Sosua, Republica Dominicana');
		   $this->Ln(1);
		   $this->Cell(82);
		   $this->Cell(82,34,'Tel.:809-571-1190 - Fax:809-571-1490');
		   $this->Ln(1);
		   $this->Cell(95);
		   $this->Cell(95,38,'RNC:1-05-04480-3');

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
		    $this->Cell(0,5,'Please, Visit: http://www.CasaLindaCity.com',0,0,'L');
		    $this->Cell(0,5,'Email: Reservations@CasaLindaCity.com',0,0,'R');
		    $this->Ln(1);
		    //Número de página
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}

		function bookings_list($header,$data)
		{
	    //Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(145,142,142);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(56,55,55);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    //Cabecera
	    $w=array(20,30,25,35,15,35,35,25,25);
	     $this->Ln();
	    for($i=0;$i<count($header);$i++)
	        $this->Cell($w[$i],9,$header[$i],1,0,'C',1);
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
		        $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
		        $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
		        $this->Cell($w[4],6,$row[4],'LR',0,'C',$fill);
		        $this->Cell($w[5],6,$row[5],'LR',0,'R',$fill);
		       // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		       $this->Cell($w[6],6,$row[6],'LR',0,'R',$fill);
		       $this->Cell($w[7],6,$row[7],'LR',0,'R',$fill);
		       $this->Cell($w[8],6,$row[8],'LR',0,'R',$fill);
		       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		    }
	    $this->Cell(array_sum($w),0,'','T');
		}

	}


	$pdf=new PDF('L','mm','Letter');
	$pdf->AliasNbPages();
	$pdf->AddPage();
    $pdf->SetAuthor('ing.joseluis@msn.com');
	$pdf->SetTitle('Residencial Casa Linda-report bookings referal');
	$pdf->SetFont('Times','',12);
	$pdf->Ln(10);
	//$pdf->Cell(80);
	$pdf->SetFont('','B');
	$pdf->Cell(10,10,'REPORT OF BOOKINGS PER REFERAL');      //report title
	$pdf->SetFont('Times','',9);

	$pdf->Ln();


     $encabezado=array('BOOKING','STATUS','REFERAL','CLIENT','VILLA','FROM','TO','TOTAL USD','COMMISION');


      $contador=0;
      $bookings_found_referal=array();
      $General_Totals=0;
      foreach($bookings_found as $book){
      		//********************************************************************************************************************
      		     switch ($book['status']){
		       	case 0:
		         	$status_result="Cancelled";
			       	break;
		       	case 1:
		         	$status_result="Checked in - Short";
			       	break;
			    case 2:
		         	$status_result="Confirmed - Short";
			       	break;
			    case 3:
		         	$status_result= "No Confirmed - Short";
			       	break;
				case 4:
		         	$status_result= "Checked out - Short";
			       	break;
			    case 5:
		         	$status_result= "Maintenance";
			       	break;
			   case 6:
		         	$status_result= "Checked in - VIP, Short";
			       	break;
			    case 7:
		         	$status_result= "Checked in - Owner, Short";
			       	break;
			    case 8:
		         	$status_result= "Checked in - Long";
			       	break;
			    case 9:
		         	$status_result= "Confirmed - Long";
			       	break;
			 	case 10:
		         	$status_result= "No Confirmed - Long";
			       	break;
			    case 11:
		         	$status_result= "Checked Out - Long";
			       	break;
			 	case 12:
		         	$status_result= "Confirmed - VIP, Short";
			       	break;
			    case 13:
		         	$status_result= "No Confirmed - VIP, Short";
			       	break;
			 	case 14:
		         	$status_result= "Checked Out - VIP, Short";
			       	break;
			    case 15:
		         	$status_result= "Checked in - VIP, Long";
			       	break;
			 	case 16:
		         	$status_result= "Confirmed - VIP, Long";
			       	break;
			    case 17:
		         	$status_result= "No Confirmed - VIP, Long";
			       	break;
			 	case 18:
		         	$status_result= "Checked Out - VIP, Long";
			       	break;
			    case 19:
		         	$status_result= "Confirmed - Owner, Short";
			       	break;
			 	case 20:
		         	$status_result= "No confirmed - Owner, Short";
			       	break;
			    case 21:
		         	$status_result= "Checked Out - Owner, Short";
			       	break;
			 	case 22:
		         	$status_result= "Checked in - Owner, Long";
			       	break;
			    case 23:
		         	$status_result= "Confirmed - Owner, Long";
			       	break;
			 	case 24:
		         	$status_result= "No confirmed - Owner, Long";
			       	break;
			    case 25:
		         	$status_result= "Checked Out - Owner, Long";
			       	break;
		       	default:
			       $status_result= "Unavailabe";
			       	break;
		       }

	           $referal_d=$db->show_id("commission", $book['id_referal']);

	           $este_agente=$referal_d[0]['name']." ".$referal_d[0]['lastname'];

	           $client_d=$db->show_id("customers", $book['client']);

	           $este_cliente=$client_d[0]['name']." ". $client_d[0]['lastname'];

	           $villa_d=$db->show_id("villas", $book['villa']);

	           $numero_villa=$villa_d[0]['no'];

	           $desde=formatear_fecha($book['start']);
	           $hasta=formatear_fecha($book['end']);
	           $total_usd=$book['subtotal']-$book['itbis'];
	           $commision=$total_usd*$referal_d[0]['percent'];
	           $General_Totals+=$total_usd;
      		//*******************************************************************************************************************	      $este_booking=array($book['ref'],$status_result,$este_agente, $este_cliente,$numero_villa, $desde,$hasta,number_format($total_usd,2), number_format($commision,2));
	      array_push($bookings_found_referal,$este_booking);
	      $contador++;
      }
     $fecha=date('Y-m-d G:i:s');
	 $pdf->Cell(80,10,'Total bookings found: '.$contador);      //total bookings
     $pdf->Cell(80,10,'Printed Date: '.$fecha);
     $pdf->bookings_list($encabezado,$bookings_found_referal);
     $pdf->Ln();
     $pdf->SetFont('','B');

    // $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(185,0,'','T');
     $pdf->Ln();
     $pdf->Cell(195,10,'General Total =','',0,'R');   $pdf->Cell(25,10,'USD '.number_format($General_Totals,2),'',0,'R');
      $pdf->Ln(5);
     $pdf->Cell(195,10,'Total commision '.($referal_d[0]['percent']*100).' % of '.number_format($General_Totals,2).' =','',0,'R');   $pdf->Cell(25,10,'USD '.number_format($General_Totals*$referal_d[0]['percent'],2),'',0,'R');
     //$pdf->Cell(80,10,'Printed Date: '.$fecha);


	$pdf->Output();
 }else{
	header('Location:invoices.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>