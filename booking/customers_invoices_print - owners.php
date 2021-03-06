<?php
require_once('inc/session.php');
if ($_SESSION['info']){

 if ($_POST['ref']!=''){

	require_once('init.php');
	 $db= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];
	
	 $montoTotalPagado=$db->amountRef($_POST['ref'],'1');/*paid*/
	 $montoTotalDevuelto=$db->amountRef($_POST['ref'],'2');/*payment refund*/
	 $montoTotalSeguridad=$db->amountRef($_POST['ref'],'3');/*security deposit*/
	 $montoTotalSDevuelto=$db->amountRef($_POST['ref'],'4');/*security refund*/

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
		case 6: $pagable_para="Void (no charges)";
				break;
		default: $pagable_para="The Tenant";
				break;
    }

    if (empty($o)){header('Location:invoices.php?error=Unknown reference number in our booking system'); die();}

    if (($o['status']==5)||($o['status']==8)||($o['status']==9)||($o['status']==10)||($o['status']==11)||($o['status']==15)||($o['status']==16)||($o['status']==17)||($o['status']==18)||($o['status']==22)||($o['status']==23)||($o['status']==24)||($o['status']==25)||($o['status']==26)||($o['status']==27)||($o['status']==28)||($o['status']==29)){
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
	$pdf->Cell(80);
	$pdf->SetFont('','B');
	$pdf->Cell(80,10,'INVOICE PER RENT');      //invoice title
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
	$pdf->Cell(30,10,'PAYABLE TO:');
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

     $encabezado=array('Details','Price','Total');
      $precio=number_format($o['ppn'],2);
      $precioHS=number_format($o['PHS'],2);

      if (($o['NHS']>0)&&($o['NLS']>0)){ //high and low season
       $totalHS=number_format(($o['PHS']*$o['NHS']),2);
       $totalLS=number_format(($o['ppn']*$o['NLS']),2);
       $data=array( 1=>array($o['NLS'].' nights LS','USD '.$precio,'USD '.$totalLS),2=>array($o['NHS'].' nights HS','USD '.$precioHS,'USD '.$totalHS),3=>array('','',''));
	  }

	  if (($o['NHS']==0)&&($o['NLS']>0)){ //low season
        $totalLS=number_format(($o['ppn']*$o['NLS']),2);
     	$data=array(1=>array($o['nights'].' nights LS','USD '.$precio,'USD '.$totalLS), 2=>array('','',''),3=>array('','',''));
      }

      if (($o['NHS']>0)&&($o['NLS']==0)){ //high season
      	$totalHS=number_format(($o['PHS']*$o['NHS']),2);
     	$data=array(1=>array($o['nights'].' nights HS','USD '.$precioHS,'USD '.$totalHS), 2=>array('','',''),3=>array('','',''));
      }
		$comission_discounted_amount=$db->show_any_data_limit1("bookingreferred", "ref_book", $o['ref'], "=");
		$agent_discounted=$comission_discounted_amount[0]['discounted'];


     $pdf->FacturaTable($encabezado,$data);
	 $amount_nightsLS=($o['NLS']*$o['ppn']);
	  $amount_nightsHS=($o['NHS']*$o['PHS']);
	  $amount_nights=$amount_nightsLS+$amount_nightsHS;
	  
	 $amount_discount_referral=$amount_nights*($agent_discounted/100);
	 
	 if($agent_discounted>0){
		  $pdf->Ln();
		 $pdf->SetFont('');
		 $pdf->Cell(145,6,"Comission discount ($agent_discounted%) =",'L',0,'R',0);
		 $pdf->Cell(40,6,'USD '.number_format($amount_discount_referral,2),'R',0,'R',0);
	 }
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Sub-Total = ','L',0,'R',0);
    //--------------------------------------------------------------------------------------
      
	  $servicios_reserva=$db->services_reserved($o['reserveid']);//servicios que contiene esta reserva
	   $excursions_reserva=$db->excrusiones_reserved($o['reserveid']);//excrusiones que contiene esta reserva
     //--------------------------------------------------------------------------------------
     $pdf->Cell(40,6,'USD '.number_format($amount_nights-$amount_discount_referral,2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln(4);
     //----------discount----------------------------------------------------------
                $this_disc=$db->show_any_data_limit1("discount", "reference", $o['ref'], "=");
                $disc_found=$this_disc[0];
	              if ($disc_found){
	              	//print_r($disc_found);
	                    //hacer calculos


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
	   
	   if($disc_found['discounted']>0){
		   $descuento=$disc_found['discounted']-($disc_found['discounted']*(15.254/100));
		   $desc_var="(".$disc_found['pro_code'].") Discount = ";
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
	$sub_total-=$amount_discount_referral;
    if((strtotime($o['date']))<(strtotime(TAX_FECHA))){/* si la fecha creada fue menor al 1 de enero 2013 solo aplica 16%*/
     $pdf->Cell(145,6,'ITBIS (VAT - TAXS) '.TAX_PER_OLD.' = ','L',0,'R',0);
     $pdf->SetFont('','U');
     $pdf->Cell(40,6,'USD '.number_format($itbis=($sub_total*TAX_DEC_OLD),2),'R',0,'R',0);
    }else{
     $pdf->Cell(145,6,'ITBIS (VAT - TAXS) '.TAX_PERCENT.' = ','L',0,'R',0);
     $pdf->SetFont('','U');
     $pdf->Cell(40,6,'USD '.number_format($itbis=($sub_total*TAX_DECIMAL),2),'R',0,'R',0);
    }
     $pdf->SetFont('');
     $pdf->Ln();

     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'TOTAL PER RENT= ','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($general_total=($itbis+$sub_total),2),'R',0,'R',0);
     $pdf->SetFont('');
     //----------amount for services----------------------
     $sub_total_services=0;
        foreach ($servicios_reserva as $s){
     	 if($s['type']=='Car_Rental'){$total_por_vehiculos=$s['price'];}
     	 $sub_total_services+=$s['price'];
		 }
		 $services_tax1=($total_por_vehiculos*0.18);
		 //$sub_total_services=($o['aps']);
		 $total_per_services=$sub_total_services+$services_tax1;
	  //------------------------------------------------------
     if($total_per_services>0){    //do this only if any amount for services
	     $pdf->Ln();
	     $pdf->Cell(145,6,'TOTAL PER SERVICES=','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format($total_per_services,2),'R',0,'R',0);
     }


      //----------amount for excrusions----------------------
        $total_per_excursions=0;
        foreach ($excursions_reserva as $k){
          $total_per_excursions+=$k['total'];
		}
	  //------------------------------------------------------
     if($total_per_excursions>0){    //do this only if any amount for services
	     $pdf->Ln();
	     $pdf->Cell(145,6,'TOTAL PER EXCURSIONS=','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format($total_per_excursions,2),'R',0,'R',0);
     }
      //------------------------------------------------------------
     $pdf->Ln();
     $pdf->Cell(145,6,'','L',0,'R',0);
     $pdf->Cell(40,6,'','R',0,'R',0);
     $pdf->Ln();
     $pdf->Cell(145,6,'Amount paid','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.(number_format($o['dep']+$montoTotalPagado,2)),'R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'REMAINING PAYMENT','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format((($general_total+$total_per_services+$total_per_excursions)-$o['dep']-$montoTotalPagado+$montoTotalDevuelto),2),'R',0,'R',0);
     $pdf->SetFont('');
	 $pdf->Ln();
	 if($montoTotalDevuelto>0){
		$pdf->Cell(145,6,'Payment Refund','L',0,'R',0);
		$pdf->Cell(40,6,'USD '.number_format($montoTotalDevuelto,2),'R',0,'R',0);
		$pdf->Ln();
	 }
	 if($montoTotalSeguridad>0){
	  $pdf->Cell(145,6,'Security Deposit','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($montoTotalSeguridad,2),'R',0,'R',0);
     $pdf->Ln();
	 }
	 if($montoTotalSDevuelto>0){
	  $pdf->Cell(145,6,'Security Refund','L',0,'R',0);
      $pdf->Cell(40,6,'USD '.number_format($montoTotalSDevuelto,2),'R',0,'R',0);
     $pdf->Ln();
	 }
     
     $pdf->Cell(185,0,'','T');
	 
	 if (($o['status']==34)||($o['status']==35)||($o['status']==36)||($o['status']==37)){/*NOTE OF ELECTRICITY ONLY IF MID TERM RENTAL*/
			$pdf->Ln();
			$pdf->Cell(93,6,'NOTE: Electricity is charged separate as per consumption.',0,0,'C',0);
	 }
	 
	 
	 
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
      $pdf->Cell(93,6,$pagable_para,0,0,'C',0);

      //signature end

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
     if (!empty($servicios_reserva)){
      	$pdf->AddPage();
      	$pdf->Ln(30);
      	$pdf->Cell(80);
		$pdf->SetFont('','B');
		$pdf->Cell(80,10,'INVOICE PER SERVICES');
		$pdf->SetFont('Times','',12);
		$pdf->Ln(30);
		//head invoice
		$pdf->Cell(0,5,'No.: '.$invoice_number,0,0,'L');
		$fecha=date('Y-m-d G:i:s');
		$pdf->Cell(0,5,'Date: '.$fecha,0,0,'R');
		$pdf->Ln(15);
		$pdf->SetFont('','U');
		$pdf->Cell(130,14,'CLIENT: '.ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),0,0);
		$pdf->Cell(50,14,'PHONE: '.$client['phone'],0,0);
	    $pdf->Ln(5);
	    $pdf->Cell(130,14,'EMAIL: '.$client['email'],0,0);
	    $pdf->Cell(50,14,'CLIENT NO: '.$client['id'],0,0);
	    $pdf->Ln(5);
	    $pdf->Cell(180,14,'ADDRESS: '.$client['address'],0,0);
		$pdf->Ln(20);
		$villa=$db->villa($o['villa']);
		$pdf->Cell(50,14,'VILLA NO.: '.$villa[0]['no'],0,0);
		$pdf->Cell(60,14,'FROM: '.formatear_fecha($o['start']),0,0);
		$pdf->Cell(60,14,'TO: '.formatear_fecha($o['end']),0,0);
		$pdf->Ln(5);
		$pdf->Cell(50,14,'RESERVE REF.: '.$o['ref'],0,0);
		$pdf->SetFont('');
		//end head invoice
		 //$data=array(1=>array($o['nights'].' nights','USD '.$precio,'USD '.$total), 2=>array('','',''),3=>array('','',''));
	     $pdf->FacturaService($encabezado,$servicios_reserva);
	     $pdf->Ln();
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'Sub-Total = ','L',0,'R',0);
	     $sub_total=0;
        foreach ($servicios_reserva as $s){
     	 if($s['type']=='Car_Rental'){$total_por_vehiculos=$s['price'];}
         $sub_total+=$s['price'];
		 }

	    // $sub_total=($o['aps']);
	     $pdf->Cell(40,6,'USD '.number_format($sub_total,2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->Cell(145,6,'ITBIS (VAT - TAXS) '.TAX_PERCENT.' = ','L',0,'R',0);
	     $pdf->SetFont('','U');

		 $services_tax=($total_por_vehiculos*TAX_DECIMAL);
	     $pdf->Cell(40,6,'USD '.number_format($services_tax,2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'TOTAL PER SERVICES= ','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format($sub_total+$services_tax,2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->Cell(145,6,'','L',0,'R',0);
	     $pdf->Cell(40,6,'','R',0,'R',0);
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
	     $pdf->Cell(93,6,'R.C.L. Administracciones',0,0,'C',0);
	      //signature end
   	  }
   	 //---------EXCRUSIONS BELOW------------------------------------------

   	  if (!empty($excursions_reserva)){
   	  	$encabezado2=array('Details','Adults-Kids','Total');
      	$pdf->AddPage();
      	$pdf->Ln(30);
      	$pdf->Cell(80);
		$pdf->SetFont('','B');
		$pdf->Cell(80,10,'INVOICE PER EXCURSIONS');
		$pdf->SetFont('Times','',12);
		$pdf->Ln(30);
		//head invoice
		$pdf->Cell(0,5,'No.: '.$invoice_number,0,0,'L');
		$fecha=date('Y-m-d G:i:s');
		$pdf->Cell(0,5,'Date: '.$fecha,0,0,'R');
		$pdf->Ln(15);
		$pdf->SetFont('','U');
		$pdf->Cell(130,14,'CLIENT: '.ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),0,0);
		$pdf->Cell(50,14,'PHONE: '.$client['phone'],0,0);
	    $pdf->Ln(5);
	    $pdf->Cell(130,14,'EMAIL: '.$client['email'],0,0);
	    $pdf->Cell(50,14,'CLIENT NO: '.$client['id'],0,0);
	    $pdf->Ln(5);
	    $pdf->Cell(180,14,'ADDRESS: '.$client['address'],0,0);
		$pdf->Ln(20);
		$villa=$db->villa($o['villa']);
		$pdf->Cell(50,14,'VILLA NO.: '.$villa[0]['no'],0,0);
		$pdf->Cell(60,14,'FROM: '.formatear_fecha($o['start']),0,0);
		$pdf->Cell(60,14,'TO: '.formatear_fecha($o['end']),0,0);
		$pdf->Ln(5);
		$pdf->Cell(50,14,'RESERVE REF.: '.$o['ref'],0,0);
		$pdf->SetFont('');
		//end head invoice
		 //$data=array(1=>array($o['nights'].' nights','USD '.$precio,'USD '.$total), 2=>array('','',''),3=>array('','',''));
	     $pdf->FacturaExcrusions($encabezado2,$excursions_reserva);
	     $pdf->Ln();
	   //  $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'Sub-Total = ','L',0,'R',0);
	     $sub_total=($o['aps']);
	     $pdf->Cell(40,6,'USD '.number_format($total_per_excursions,2),'R',0,'R',0);
	     $pdf->SetFont('');

	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'TOTAL PER EXCURSIONS= ','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format($total_per_excursions,2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->Cell(145,6,'','L',0,'R',0);
	     $pdf->Cell(40,6,'','R',0,'R',0);
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
	     $pdf->Cell(93,6,'R.C.L. Administracciones',0,0,'C',0);
	      //signature end
   	  }

	$pdf->Output('documents/invoices/'.$invoice_number.'.pdf', 'F');

	$ref=$_POST['ref'];
	$src='documents/invoices/'.$invoice_number.'.pdf';
	$id_adm=$_SESSION['info']['id'];
	$link= new subDB();
	$link->insert_invoice($ref, $src, $id_adm, $invoice_number, $_POST['payable_to']);//insert invoice in db

	$pdf->Output();
 }else{
	header('Location:invoices.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>