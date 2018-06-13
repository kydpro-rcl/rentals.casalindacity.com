<?php
session_start();
if ($_SESSION['info']){
  //$_POST['ref']=557;
 if ($_POST['ref']!=''){

	require_once('init.php');
	 $db= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];
    $vehiculos_ant=$db->show_any_data('vehicle', 'ref_book', $_POST['ref'], '='); // vehiculos almacenados

    if (empty($o)){header('Location:booking-calendar.php'); die();}

   /* if (($o['status']==0)||($o['status']==5)||($o['status']==8)||($o['status']==9)||($o['status']==10)||($o['status']==11)||($o['status']==15)||($o['status']==16)||($o['status']==17)||($o['status']==18)||($o['status']==22)||($o['status']==23)||($o['status']==24)||($o['status']==25)){    	header('Location:invoices.php?error=We sorry this is not a short term rental');
    	die();
    } */

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

	}


	$pdf=new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
    $pdf->SetAuthor('ing.joseluis@msn.com');
	$pdf->SetTitle('Residencial Casa Linda-Invoice');
	$pdf->SetFont('Times','',12);
	$pdf->Ln(5);
	//$pdf->Cell(40);
	$pdf->SetFont('','B');
	$pdf->Cell(0,10,'INFORMATION FOR SECURITY');      //invoice title
	$pdf->SetFont('Times','',12);
	//$pdf->Cell(0,10,'INVOICE PER RENT',0,1,'C');
	//invoice top
	$pdf->Ln(10);
	$pdf->Cell(185,0,'','T');
   $pdf->Ln();


	//$invoice_number=str_pad($numero, 9, "0", STR_PAD_LEFT);   //will output 9 numbers


			     if (($o['status']==7)||($o['status']==19)||($o['status']==20)||($o['status']==21)){
			     $owner=$db->show_id('owners', $o['client']);
				 $client=$owner[0];
				 $inquilino="Owner:";
				}else{
				 $inquilino="Customer:";
				 $client=$db->customer($o['client']);
				}

    			$villa=$db->villa($o['villa']);

                $pdf->Cell(50,5,'BOOKING: '.$o['ref'],0,0);
                $fecha=date('Y-m-d G:i:s');
                $pdf->SetFont('Times','',8);

                $pdf->SetFont('','B');
				$pdf->Cell(18,5,'Date Printed: ',0,0,'L');
				$pdf->SetFont('');
				$pdf->Cell(42,5,$fecha,0,0,'L');$pdf->SetFont('','B');
				$pdf->Cell(15,5,'Printed by: ',0,0,'L');
				$pdf->SetFont('');
				$pdf->Cell(50,5,$_SESSION['info']['name'],0,0,'L');
                $pdf->SetFont('Times','',12);
                 $pdf->Ln();
		        $pdf->Cell(185,0,'','T');
                $pdf->Ln();
                $pdf->SetFont('','B');
		      	$pdf->Cell(46,6,$inquilino,'LR',0,'R',$fill=0); //puede ser cliente o dueño
		      	$pdf->SetFont('');
		        $pdf->Cell(139,6,ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),'LR',0,'L',$fill=0);
                $pdf->Ln();
                $pdf->Cell(185,0,'','T');
                $pdf->Ln();
               //client information
                $pdf->SetFont('','B');
		      	$pdf->Cell(46,6,'Cedula/Passport:','LR',0,'R',$fill=0);
		      	$pdf->SetFont('');
		        $pdf->Cell(57,6, $client['cedula']."/".$client['passport'] ,'LR',0,'L',$fill=0);
		      	 $pdf->SetFont('','B');
		      	$pdf->Cell(36,6,'Phone:','LR',0,'R',$fill=0);
		      	$pdf->SetFont('');
		        $pdf->Cell(46,6,$client['phone'],'LR',0,'L',$fill=0);
		        $pdf->Ln();
		        $pdf->Cell(185,0,'','T');
                $pdf->Ln();
                //passport cedula
                 $pdf->SetFont('','B');
		        $pdf->Cell(46,6,'Address:','LR',0,'R',$fill=0);
		         $pdf->SetFont('');
		        $pdf->Cell(139,6,$client['address'],'LR',0,'L',$fill=0);
		        $pdf->Ln();
		        $pdf->Cell(185,0,'','T');
                $pdf->Ln();
		        //address
		        $pdf->SetFont('','B');
		        $pdf->Cell(46,6,'Arrival:','LR',0,'R',$fill=0);
		        $pdf->SetFont('');
		        $pdf->Cell(47,6,formatear_fecha($o['start']),'LR',0,'L',$fill=0);
		        $pdf->SetFont('','B');
		        $pdf->Cell(46,6,'Departure:','LR',0,'R',$fill=0);
		        $pdf->SetFont('');
		        $pdf->Cell(46,6,formatear_fecha($o['end']),'LR',0,'L',$fill=0);
		        $pdf->Ln();
		        $pdf->Cell(185,0,'','T');
                $pdf->Ln();
		        //arrival - departure
		        $pdf->SetFont('','B');
		        $pdf->Cell(46,6,'No. Guests:','LR',0,'R',$fill=0);
		         $pdf->SetFont('');
		        $pdf->Cell(47,6,($o['kids']+$o['adults']),'LR',0,'L',$fill=0);
		         $pdf->SetFont('','B');
		       $pdf->Cell(46,6,'Villa:','LR',0,'R',$fill=0);
		         $pdf->SetFont('');
		        $pdf->Cell(46,6,$villa[0]['no'],'LR',0,'L',$fill=0);
		        $pdf->Ln();
		        $pdf->Cell(185,0,'','T');
                $pdf->Ln();
                 $data=$db->people($o['reserveid']);
		        ///INFORMATION FOR ADULTS AND CHIDREN GOING BELOW
                 $pdf->SetFont('','B');
          		 $pdf->Cell(93,6,'Guests Adults:',0,0,'L',0);
                  $pdf->SetFont('');
                  $pdf->Ln();
                   //aqui van los adutos
                   $i=0;
                  foreach ($data as $d){
				        if ($d['type']==1){				        	 $i++;                           $pdf->Cell(50,5,$i."- ".$d['name']." ".$d['lastname'],0,0);
                           $pdf->Ln();				        }
				        if ($d['type']==2) $kids="yes";
				  }

				  if ($kids=="yes"){
	                  $pdf->Ln();
	                  $pdf->SetFont('','B');
	                  $pdf->Cell(93,6,'Guests Children:',0,0,'L',0);
	                  $pdf->SetFont('');
	                   $pdf->Ln();
                   }
                   $i=0;
                   //aqui van los niños
                    foreach ($data as $d){
				        if ($d['type']==2){				        	$i++;
                           $pdf->Cell(50,5,$i."- ".$d['name']." ".$d['lastname'],0,0);
                           $pdf->Ln();
				        }
				     }
                  //-------------------------------------------------------------------
         if ($vehiculos_ant){// only if there are vehicles
                   $pdf->Cell(185,0,'','T');
                   $pdf->Ln();
                   $pdf->Cell(93,6,$o['vehicles'].'- VEHICLE DETAILS',0,0,'C',0);


                 foreach ( $vehiculos_ant AS $k){
	                $pdf->Ln();
			           //Vehiculo
			        $pdf->Cell(185,0,'','T');
	                $pdf->Ln();$pdf->SetFont('','B');
			        $pdf->Cell(46,6,'Make:','LR',0,'R',$fill=0);
			        $pdf->SetFont('');
			        $pdf->Cell(47,6,$k['make'],'LR',0,'L',$fill=0);

			        $pdf->SetFont('','B');
			        $pdf->Cell(46,6,'Model:','LR',0,'R',$fill=0);
			        $pdf->SetFont('');
			        $pdf->Cell(46,6,$k['model'],'LR',0,'L',$fill=0);
			        $pdf->Ln();
			        $pdf->SetFont('','B');
			        $pdf->Cell(46,6,'Licence Plate:','LR',0,'R',$fill=0);
			        $pdf->SetFont('');

			        $pdf->Cell(47,6,$k['lic_plate'],'LR',0,'L',$fill=0);
			        $pdf->SetFont('','B');
			        $pdf->Cell(46,6,'Color:','LR',0,'R',$fill=0);
			        $pdf->SetFont('');
			        $pdf->Cell(46,6,$k['color'],'LR',0,'L',$fill=0);

			        $pdf->Ln();
			        $pdf->Cell(185,0,'','T');
	                $pdf->Ln();
                  }
         }
	//$ref=$_POST['ref'];

	//$id_adm=$_SESSION['info']['id'];
	//$link= new subDB();
	//$link->insert_invoice($ref, $src, $id_adm, $invoice_number, '1');//insert invoice in db

	$pdf->Output();
 }else{
	header('Location:security-sheet.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>