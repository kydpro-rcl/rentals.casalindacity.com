<?php
require_once('inc/session.php');
if ($_SESSION['info']){

 if ($_POST['ref']!=''){
    if (($_POST['pagos_totales']=="")||($_POST['numero_de_pago']=="")){
    //$p=$_POST['pagos_totales']; $a=$_POST['numero_de_pago'];
     header("Location:invoices_long.php?error=We sorry, missing arguments");
     die();
    }else{     $pagos_totales=$_POST['pagos_totales']; //tell us total of payments to make
	 $pago_actual=$_POST['numero_de_pago'];//Tell us what payment to print    }
	require_once('init.php');
	 $db= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];
    $servicios_reserva_long=$db->services_reserved_long($o['reserveid']);

    $payments_date=$db->payments_date($o['reserveid']); //get payments date per long rental
    $fecha_de_pago_actual=$payments_date[$pago_actual-1]['fecha_pago'];
    $fecha_de_pago_proxima=$payments_date[$pago_actual]['fecha_pago'];

    switch($_POST['payable_to']){
    case 1: $pagable_para="The Tenant";
    		break;
    case 2: $pagable_para="Neguen, SRL";
    		break;
    case 3: $pagable_para="RCL Administraciones, SRL.";
    		break;
    case 4: $pagable_para="Owner of the Villa";
    		break;
    case 5: $pagable_para="Referal Agent (";
    		$referal_id=$_POST['referal_id'];
    		$referal_info=$db->intermediario($referal_id);
    		$pagable_para.=$referal_info['name']." ".$referal_info['lastname'].")";
    		break;
    default: $pagable_para="The Tenant";
    		break;    }

    if (empty($o)){header('Location:invoices_long.php?error=Unknown reference number in our booking system'); die();}

    if (($o['status']==0)||($o['status']==5)||($o['status']==7)||($o['status']==1)||($o['status']==2)||($o['status']==3)||($o['status']==4)||($o['status']==6)||($o['status']==12)||($o['status']==13)||($o['status']==14)||($o['status']==7)||($o['status']==19)||($o['status']==20)||($o['status']==21)){    	header('Location:invoices_long.php?error=We sorry, this is not a long term rental');
    	die();
    }

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
		    $this->Cell(50);
		    //Título
		   $this->Cell(45,9,'R.C.L. ADMINISTRACCIONES, SRL.');
		   $this->Image('images/invoice/letters.jpg',85,18,40);
		  $this->Ln(1);
		   $this->SetFont('Times','',8);
		   $this->Cell(77);
		   $this->Cell(87,30,'Sosua, Republica Dominicana');
		   $this->Ln(1);
		   $this->Cell(72);
		   $this->Cell(82,34,'Tel.:809-571-1190 - Fax:809-571-1490');
		   $this->Ln(1);
		   $this->Cell(85);
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

		function FacturaTable($header,$data)
		{
	    //Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(145,142,142);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(56,55,55);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B');
	    //Cabecera
	    $w=array(30,85,40,30);
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
               $this->Cell($w[2],6,$row[2],'LR',0,'R',$fill);
		       $this->Cell($w[3],6,$row[3],'LR',0,'R',$fill);
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
	$pdf->Cell(70);
	$pdf->SetFont('','B');
	$pdf->Cell(80,10,'INVOICE PER RENT');      //invoice title
	$pdf->SetFont('Times','',12);

	$pdf->Ln(20);
	$Num=$db->highest_invoice_registered(); $numero=$Num[0]['id']+1;  //get the highest inserted id and sum 1 for next insertion

	$invoice_number=str_pad($numero, 9, "0", STR_PAD_LEFT);   //will output 9 numbers
	$pdf->Cell(10,5,'No.: ',0,0,'L');
    $pdf->SetFont('','U');
	$pdf->Cell(30,5,$invoice_number,0,0,'L');
	$pdf->SetFont('');
	$fecha=date('Y-m-d G:i:s');

	$pdf->Cell(113,5,'Date: ',0,0,'R');
	$pdf->SetFont('','U');
	$pdf->Cell(0,5,$fecha,0,0,'R');
	$pdf->SetFont('');
	//PAYABLE TO
	$pdf->Ln();
	$pdf->SetFont('','B');
	$pdf->Cell(30,10,'PAYABLE TO:');
	$pdf->SetFont('','UB');
	$pdf->Cell(80,10,$pagable_para);
    $pdf->SetFont('');

	$pdf->Ln(5);
	$client=$db->customer($o['client']);

	$pdf->Cell(30,14,'CLIENT: ',0,0);
	$pdf->SetFont('','U');
	$pdf->Cell(100,14,ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),0,0);
	$pdf->SetFont('');

	$pdf->Cell(25,14,'PHONE: ',0,0);
	$pdf->SetFont('','U');
	$pdf->Cell(25,14,$client['phone'],0,0);
	$pdf->SetFont('');

    $pdf->Ln(5);
    $pdf->Cell(30,14,'EMAIL: ',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(100,14,$client['email'],0,0);
    $pdf->SetFont('');

    $pdf->Cell(25,14,'CLIENT NO: ',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(20,14,$client['id'],0,0);
    $pdf->SetFont('');
    $pdf->Ln(5);

    $pdf->Cell(30,14,'ADDRESS: ',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(150,14,$client['address'],0,0);
    $pdf->SetFont('');
	$pdf->Ln(10);

	$villa=$db->villa($o['villa']);
 	$pdf->SetFont('');
	$pdf->Cell(30,14,'VILLA NO.: ',0,0);
	$pdf->SetFont('','UB');
	$pdf->Cell(20,14,$villa[0]['no'],0,0);
 	$pdf->SetFont('');
	$pdf->Cell(15,14,'FROM: ',0,0);
	$pdf->SetFont('','UB');
	$pdf->Cell(45,14,formatear_fecha($o['start']),0,0);
	$pdf->SetFont('');

	$pdf->Cell(10,14,'TO: ',0,0);
	$pdf->SetFont('','UB');
	$pdf->Cell(50,14,formatear_fecha($o['end']),0,0);
	$pdf->SetFont('');
	$pdf->Ln(5);

	$pdf->Cell(30,14,'RESERVE REF.: ',0,0);
	$pdf->SetFont('','U');
	$pdf->Cell(25,14,$o['ref'],0,0);
	$pdf->SetFont('');
    //linea divisora de detalles
    $pdf->Ln();
    $pdf->Cell(185,0,'','T');
    $pdf->Ln();
    $pdf->Cell(18,14,'Payment:',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(30,14,$pago_actual.' of '.$pagos_totales,0,0);
    $pdf->SetFont('');
    $pdf->Cell(30,14,'Billing period:',0,0);
    $pdf->SetFont('','U');
    if ($fecha_de_pago_proxima==""){ //solo existen noches extras       $fecha_de_pago_proxima=$o['end'];
    }
    $pdf->Cell(45,14,$fecha_de_pago_actual.' / '.$fecha_de_pago_proxima,0,0);

     $pdf->SetFont('');
     $pdf->Cell(30,14,'(YYYY-MM-DD)',0,0);

     $encabezado=array('Quantity','Details','Price','Total');

      if (($o['EN']>0)&&($pagos_totales==$pago_actual)){      	$total_a_cobrar=($o['EN']*$o['ppn']);
      	$data=array( 1=>array($o['EN'],'Extra Nights',number_format($o['ppn'],2),number_format($total_a_cobrar,2)));
      }else{      	$total_a_cobrar=(1*$o['PMV']);        $data=array( 1=>array('1','Monthly Payment',number_format($o['PMV'],2),number_format($total_a_cobrar,2)));      }

     $pdf->FacturaTable($encabezado,$data);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Billed Amount = ','L',0,'R',0);

     $pdf->Cell(40,6,'USD '.number_format($total_a_cobrar,2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'Deposit = ','L',0,'R',0);
     $pdf->SetFont('','U');
     $pdf->Cell(40,6,'USD '.number_format($o['dep'],2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'GENERAL TOTAL = ','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($o['total'],2),'R',0,'R',0);
     $pdf->SetFont('');

     $pdf->Ln();
     $pdf->Cell(145,6,'Balance pending = ','L',0,'R',0);
     //balance penciente
     if ($o['dep']>0){
     	if (($o['dep'])>(($pago_actual-1)*$o['PMV'])){ //si deposito mayor que los pagos realizados
      	   $balance_pendiente=$o['total']-$o['dep'];
      	}else{           $balance_pendiente=$o['total']-(($pago_actual-1)*$o['PMV']);      	}

     }else{ //que hace si no hay deposito      $balance_pendiente=$o['total']-(($pago_actual-1)*$o['PMV']);     }
     //balance pendiente

     $pdf->Cell(40,6,'USD '.number_format($balance_pendiente,2),'R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Payment amount = ','L',0,'R',0);

     //total a pagar
     if ($o['dep']==0){
        $total_a_pagar=$total_a_cobrar;
     }else{     	//verificar magnitud del deposito
     	if (($o['dep'])>(($pago_actual-1)*$o['PMV'])){//si deposito mayor que los pagos realizados
     	 $pagos_hechos=(($pago_actual-1)*$o['PMV']);       	 $total_pagado=$pagos_hechos+$total_a_cobrar;
       	 if (($o['dep'])>=$total_pagado){//si el monto de deposito sobrepasa o es igual los pagado mas este mes       	 	$total_a_pagar=0;
       	 }else{            $total_a_pagar=$total_pagado-$o['dep'];
       	 }


        }else{         $total_a_pagar=$total_a_cobrar;        }     }
     //total a pagar

     $pdf->Cell(40,6,'USD '.number_format($total_a_pagar,2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(185,0,'','T');
         //services
         $total_services_long=0;
         $pdf->Ln();
         $pdf->SetFont('Times','',8);
				foreach ($servicios_reserva_long as $sl){

                    $pdf->Cell(30,6,ucfirst($sl['name'])."= ".$sl['price'],0,0);
                    $pdf->Ln(5);
					$total_services_long+=$sl['price'];
				}
				 $pdf->Cell(80,6,'MONTHLY PER SERVICES -> USD '.number_format($total_services_long,2),0,0);
				 $pdf->Cell(30,6,'MONTHLY PER VILLA -> USD '.number_format($o['PL'],2),0,0);
                $pdf->Ln();
     		$pdf->SetFont('');
    //payments
    $pdf->SetFont('','B');
    if ($o['EN']>0){
 	 	$pagos_enteros=($o['PAYM']-1);
 	}else{
 	 	$pagos_enteros=$o['PAYM'];
 	}
	$pdf->Cell(80,6,$pagos_enteros.' Monthly payments to USD '.number_format($o['PMV'],2).' each.',0,0);

	if($o['EN']>0){
      $pdf->Cell(80,6,$o['EN'].' Extra nights to USD '.number_format($o['ppn'],2).' each.',0,0);
    }
    $pdf->Ln();
    $pdf->SetFont('Times','',12);

     $pdf->Cell(27,6,'IMPORTANT: ',0,0);
     $pdf->SetFont('','U');
     $pdf->Cell(50,6,'Electricity is charged monthly per consumption.',0,0);
     $pdf->SetFont('');
     //signature invoice
     $pdf->Ln(30);
     $pdf->Cell(93,6,'Delivery by:',0,0,'C',0);
     $pdf->Cell(93,6,'Received by:',0,0,'C',0);
     $pdf->Ln(15);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Ln();
     $pdf->Cell(93,6,'R.C.L. Administracciones, SRL.',0,0,'C',0);
     $pdf->Cell(93,6,$pagable_para,0,0,'C',0);

    //signature end

	$pdf->Output('documents/invoices/'.$invoice_number.'.pdf', 'F');

	$ref=$_POST['ref'];
	$src='documents/invoices/'.$invoice_number.'.pdf';
	$id_adm=$_SESSION['info']['id'];
	$link= new subDB();
	$link->insert_invoice($ref, $src, $id_adm, $invoice_number, '2');//insert invoice in db

	$pdf->Output();
 }else{
	header('Location:invoices.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>