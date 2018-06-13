<?php
require_once('inc/session.php');
if ($_SESSION['info']){

 if ($_POST['ref']!=''){

	require_once('init.php');
	 $db= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];

    switch($_POST['paid']){
		case 1: $pagable_para="Cash";
				break;
		case 2: $pagable_para="Debit/Credit Card";
				break;
		case 3: $pagable_para="Paypal";
				break;
		case 4: $pagable_para="Others";
				break;
    }

    if (empty($o)){header('Location:invoice_owners.php?error=Unknown reference number in our booking system'); die();}

    if (($o['status']==5)||($o['status']==8)||($o['status']==9)||($o['status']==10)||($o['status']==11)||($o['status']==15)||($o['status']==16)||($o['status']==17)||($o['status']==18)||($o['status']==22)||($o['status']==23)||($o['status']==24)||($o['status']==25)){
    	header('Location:invoices.php?error=We sorry this is not a short term rental');
    	die();
    }


	class PDF extends FPDF
	{
	//Cabecera de p�gina
		function Header()
		{
		    //Logo
		    $this->Image('images/invoice/simbol.jpg',15,10,40);
		    //Arial bold 15
		    $this->SetFont('Arial','B',15);
		    //Movernos a la derecha
		    $this->Cell(60);
		    //T�tulo
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

		    //Salto de l�nea
		    $this->Ln(20);
		}

	//Pie de p�gina
		function Footer()
		{
		    //Posici�n: a 1,5 cm del final
		    $this->SetY(-15);
		    //Arial italic 8
		    $this->SetFont('Arial','I',8);
		    $this->Cell(0,5,'Please, Visit: http://www.CasaLindaCity.com',0,0,'L');
		    $this->Cell(0,5,'Email: Reservations@CasaLindaCity.com',0,0,'R');
		    $this->Ln(1);
		    //N�mero de p�gina
		    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}

		function FacturaTable($header,$data)
		{
	    //Colores, ancho de l�nea y fuente en negrita
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
	    //Restauraci�n de colores y fuentes
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


		function FacturaService($header,$data)
		{
	    //Colores, ancho de l�nea y fuente en negrita
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
	    //Restauraci�n de colores y fuentes
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    //Datos
	    $fill=0;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,ucfirst($row['type']).' '.substr($row['name'],0,45),'LR',0,'C',$fill);
		        $this->Cell($w[1],6,'USD '.$row['price'],'LR',0,'R',$fill);

		        $this->Cell($w[2],6,'USD '.$row['price'],'LR',0,'R',$fill);

		        $this->Ln();
		        $fill=!$fill;
		    }
	    $this->Cell(array_sum($w),0,'','T');
		}

      function FacturaExcrusions($header,$data)
		{
	    //Colores, ancho de l�nea y fuente en negrita
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
	    //Restauraci�n de colores y fuentes
	    $this->SetFillColor(224,235,255);
	    $this->SetTextColor(0);
	    $this->SetFont('');
	    //Datos
	    $fill=0;
		    foreach($data as $row)
		    {
		        $this->Cell($w[0],6,substr(ucfirst($row['title']),0,45),'LR',0,'C',$fill);
		        $this->Cell($w[1],6,$row['qty_a'].' x '.number_format($row['price_a'],0).' - '.$row['qty_c'].' x '.number_format($row['price_c'],0),'LR',0,'R',$fill);

		        $this->Cell($w[2],6,'USD '.$row['total'],'LR',0,'R',$fill);

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
	$pdf->Cell(10,10,'INVOICE FOR OWNERS');      //invoice title
	$pdf->SetFont('Times','',12);
	//$pdf->Cell(0,10,'INVOICE PER RENT',0,1,'C');
	//invoice top
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
	$pdf->Cell(17,10,'Paid by:');
	$pdf->SetFont('','UB');
	$pdf->Cell(80,10,$pagable_para);
    $pdf->SetFont('');

	$pdf->Ln(15);
	if (($o['status']==7)||($o['status']==19)||($o['status']==20)||($o['status']==21)){
     $owner=$db->show_id('owners', $o['client']);
	 $client=$owner[0];
	 $inquilino="OWNER";
	}else{
	$inquilino="CLIENT";
	 $client=$db->customer($o['client']);
	}


	$pdf->Cell(30,14,$inquilino.': ',0,0);
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

    $pdf->Cell(25,14,$inquilino.' NO: ',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(20,14,$client['id'],0,0);
    $pdf->SetFont('');
    $pdf->Ln(5);

    $pdf->Cell(30,14,'ADDRESS: ',0,0);
    $pdf->SetFont('','U');
    $pdf->Cell(150,14,$client['address'],0,0);
    $pdf->SetFont('');
	$pdf->Ln(20);

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
	//end invoice top
	/*$pdf->Cell(0,14,'Starting on: '.$o['start'],0,1);
    $pdf->Cell(0,14,'Ending on: '.$o['end'],0,1);    */
	 //-----------buscar descuentos aqui--------------------------------------------------------------
		$this_disc=$db->show_any_data_limit1("discount", "reference", $o['ref'], "=");
                $disc_found=$this_disc[0];

	 //-----------verificar si la factura fue pagada con tarjeta de credito y si hay agentes para hacer los descuentos de lugar----------------
		$agent_comision=$db->showTable_r($table='bookingreferred', $field='ref_book', $value=$_POST['ref'], $operator='=');

		if($agent_comision[0]){
			 $agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');

			 $precioShort_LS=($o['ppn']-($agent[0]['percent']*$o['ppn']));
			 $precioShort_HS=($o['PHS']-($agent[0]['percent']*$o['PHS']));
		}else{
			 $precioShort_LS=$o['ppn'];
			 $precioShort_HS=$o['PHS'];
		}

		if($_POST['paid']==2){

			if($agent_comision[0]){
				$reducir_tarjetaLS=($o['ppn']*0.06);//reducirlo del total no de lo que queda luego de quitarle lo del agente
				$reducir_tarjetaHS=($o['PHS']*0.06);//reducirlo del total de la villa no de lo que queda despues de la comision
			}else{
				if($this_disc){ //only charge 6% if there is other discount
               $reducir_tarjetaLS=($precioShort_LS*0.06);
				 $reducir_tarjetaHS=($precioShort_HS*0.06);
				}else{
				 $reducir_tarjetaLS=($precioShort_LS*0.10);//en este caso el precio equivale a los mismos valores que son los precios de las villas sin reducirle el precio
				 $reducir_tarjetaHS=($precioShort_HS*0.10);//en este caso el precio equivale a los mismos valores que son los precios de las villas sin reducirle el precio
				}
			}

			$precioShort_LS-=$reducir_tarjetaLS;
			$precioShort_HS-=$reducir_tarjetaHS;
		}
		
		if($_POST['paid']==3){

			
				 $reducir_tarjetaLS=($precioShort_LS*0.032);//en este caso el precio equivale a los mismos valores que son los precios de las villas sin reducirle el precio
				 $reducir_tarjetaHS=($precioShort_HS*0.032);//en este caso el precio equivale a los mismos valores que son los precios de las villas sin reducirle el precio
				

			$precioShort_LS-=$reducir_tarjetaLS;
			$precioShort_HS-=$reducir_tarjetaHS;
		}

	 //-----------termian processos de descuentos------------------------------------------------

     $encabezado=array('Details','Price','Total');
      $precio=number_format($precioShort_LS,2);
      $precioHS=number_format($precioShort_HS,2);

      if (($o['NHS']>0)&&($o['NLS']>0)){ //high and low season
       $totalHS=number_format(($precioShort_HS*$o['NHS']),2);
       $totalLS=number_format(($precioShort_LS*$o['NLS']),2);
       $data=array( 1=>array($o['NLS'].' nights LS','USD '.$precio,'USD '.$totalLS),2=>array($o['NHS'].' nights HS','USD '.$precioHS,'USD '.$totalHS),3=>array('','',''));
	  }

	  if (($o['NHS']==0)&&($o['NLS']>0)){ //low season
        $totalLS=number_format(($precioShort_LS*$o['NLS']),2);
     	$data=array(1=>array($o['nights'].' nights LS','USD '.$precio,'USD '.$totalLS), 2=>array('','',''),3=>array('','',''));
      }

      if (($o['NHS']>0)&&($o['NLS']==0)){ //high season
      	$totalHS=number_format(($precioShort_HS*$o['NHS']),2);
     	$data=array(1=>array($o['nights'].' nights HS','USD '.$precioHS,'USD '.$totalHS), 2=>array('','',''),3=>array('','',''));
      }


     $pdf->FacturaTable($encabezado,$data);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Sub-Total = ','L',0,'R',0);
    //--------------------------------------------------------------------------------------
      $amount_nightsLS=($o['NLS']*$precioShort_LS);
	  $amount_nightsHS=($o['NHS']*$precioShort_HS);
	  $amount_nights=$amount_nightsLS+$amount_nightsHS;
	  #$servicios_reserva=$db->services_reserved($o['reserveid']);//servicios que contiene esta reserva
	   #$excursions_reserva=$db->excrusiones_reserved($o['reserveid']);//excrusiones que contiene esta reserva
     //--------------------------------------------------------------------------------------


     $pdf->Cell(40,6,'USD '.number_format($amount_nights,2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln(4);
     //----------discount----------------------------------------------------------
               # $this_disc=$db->show_any_data_limit1("discount", "reference", $o['ref'], "=");
               # $disc_found=$this_disc[0];
	              if ($disc_found){
	              	//print_r($disc_found);
	                    //hacer calculos
                           //$amount_nights_descuento=

	                     if  ($disc_found['pro_type']=="2"){   //Amount
	                           $descuento=($disc_found['pro_qty']);
	                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
	                           $tipo_desc="monto";
	                           $promotion_code=$disc_found['pro_code'];

	                     }elseif($disc_found['pro_type']=="1"){ //percent discount
	                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
	                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
	                         $tipo_desc="porcient";
	                         $promotion_code=$disc_found['pro_code'];
	                     }elseif($disc_found['pro_type']=="3"){  ///days discounted
	                        //$descuento=($amount_nights*($disc_found['pro_qty']/100));
	                         $variable_descuento=$disc_found['qty_days']." Nights ";
	                         $tipo_desc="days";
	                         $promotion_code=$disc_found['pro_code'];

	                         //-------------------------------------------------------------------
	                         if ($o['NLS']!=0 &&  $o['NHS']==0){//solo low season
	                           $descuento=$o['ppn']*$disc_found['qty_days'];
	                        }

	                        if (($o['NLS']==0)&&($o['NHS']!=0)){//solo High season
	                           $descuento=$o['PHS']*$disc_found['qty_days'];
	                        }

	                        if ($o['NLS']!=0 &&  $o['NHS']!=0){//ambas season
	                          if($o['NLS']>=$disc_found['qty_days']){
	                         	$descuento=$o['ppn']*$disc_found['qty_days'];
	                          }else{
	                          	$descuento=$o['ppn']*$o['NLS'];
	                          	$descuento+=$o['PHS']*($disc_found['qty_days']-$o['NLS']);
	                          }
	                        }
	                     }
	              }

      if (($descuento>0)&&($tipo_desc=="monto")){

		$desc_var="($promotion_code) Discount = ";
	  }

	  if (($descuento>0)&&($tipo_desc=="porcient")){
			$desc_var="($promotion_code) $variable_descuento Discount of ".number_format($amount_nights,2)." =  ";
	  }

	  if (($descuento>0)&&($tipo_desc=="days")){

		$desc_var="($promotion_code) Discount of $variable_descuento  = ";
	   }

	 if ($descuento>0){
	     $pdf->SetFont('Times','',10);
	     $pdf->Cell(145,6,$desc_var,'L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format($descuento,2),'R',0,'R',0);
	     $pdf->Ln(3);
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'Amount after discount = ','L',0,'R',0);
	     $sub_total=($amount_nights-$descuento);
	     $pdf->Cell(40,6,'USD '.number_format($sub_total,2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln(5);
	     $pdf->SetFont('Times','',12);
	 }else{
	 	 $sub_total=($amount_nights);
	 }
     //---------------- discount-----------------------------------------------
     $pdf->Cell(145,6,'ITBIS (VAT - TAX) '.TAX_PERCENT.' = ','L',0,'R',0);
     $pdf->SetFont('','U');
     $pdf->Cell(40,6,'USD '.number_format($itbis=($sub_total*TAX_DECIMAL),2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'GRAND TOTAL= ','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($general_total=($itbis+$sub_total),2),'R',0,'R',0);
     $pdf->SetFont('');

     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);

     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(185,0,'','T');
     //signature invoice
     $pdf->Ln(20);
     $pdf->Cell(93,6,'Delivery by:',0,0,'C',0);
     $pdf->Cell(93,6,'Received by:',0,0,'C',0);
     $pdf->Ln(15);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Ln();
     $pdf->Cell(93,6,'R.C.L. Administracciones, SRL.',0,0,'C',0);
     // $pdf->Cell(93,6,'Customer Signature',0,0,'C',0);
     # $pdf->Cell(93,6,$pagable_para,0,0,'C',0);

      //signature end

	$pdf->Output('documents/invoices/'.$invoice_number.'.pdf', 'F');

	$ref=$_POST['ref'];
	$src='documents/invoices/'.$invoice_number.'.pdf';
	$id_adm=$_SESSION['info']['id'];
	$link= new subDB();
	#$link->insert_invoice($ref, $src, $id_adm, $invoice_number, $_POST['payable_to']);//insert invoice in db

	$pdf->Output();
 }else{
	header('Location:invoices.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>