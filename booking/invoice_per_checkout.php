<?php
require_once('inc/session.php');
if ($_SESSION['info']){
  //  echo $_POST['ref'];

  $desc1=$_POST['desc1'];
  $price1=$_POST['price1'];
  $desc2=$_POST['desc2'];
  $price2=$_POST['price2'];
  $desc3=$_POST['desc3'];
  $price3=$_POST['price3'];
  $desc4=$_POST['desc4'];
  $price4=$_POST['price4'];
  $total_charge_rent=($price1+$price2+$price3+$price4);
  //check out
  $desc5=$_POST['desc5'];
  $price5=$_POST['price5'];
  $late_ckout=array('desc'=>$desc5,'price'=>$price5);
  $ckout_charg=array();
  for ($i=1; $i<=4; $i++){
   if (${"price{$i}"}) array_push($ckout_charg, array('desc'=>${"desc{$i}"}, 'price'=>${"price{$i}"}));
  }
 // print_r($ckout_charg);


 if ($_POST['ref']!=''){

	require_once('init.php');
	 $db= new getQueries ();
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];

    if (empty($o)){header('Location:check-out.php'); die();}


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
		   $this->Cell(60,9,'R.C.L. ADMINISTRACCIONES, S.A.');
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

		function FacturaTable($header,$data,$ckout)
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
		    $this->Cell(array_sum($w),0,'','T');$this->Ln();
		     foreach($ckout as $ck)
		    {
		        $this->Cell($w[0],6,$ck['desc'],'LR',0,'C',$fill);
		        $this->Cell($w[1],6,number_format($ck['price'],2),'LR',0,'R',$fill);
		       // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		       $this->Cell($w[2],6,number_format($ck['price'],2),'LR',0,'R',$fill);
		       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		    }
	    $this->Cell(array_sum($w),0,'','T');
		}

		function FacturaService($header,$data,$ckout)
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
		        $this->Cell($w[0],6,ucfirst($row['type']).' '.$row['name'],'LR',0,'C',$fill);
		        $this->Cell($w[1],6,'USD '.$row['price'],'LR',0,'R',$fill);
		       // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		        $this->Cell($w[2],6,'USD '.$row['price'],'LR',0,'R',$fill);
		       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		    }
		   /* foreach($ckout as $k)
		    { */
		    	$this->SetFont('','B');
		        $this->Cell($w[0],6,ucfirst($ckout['desc']),'LR',0,'C',$fill);
		        $this->Cell($w[1],6,'USD '.$ckout['price'],'LR',0,'R',$fill);
		       // $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
		        $this->Cell($w[2],6,'USD '.$ckout['price'],'LR',0,'R',$fill);
		        $this->SetFont('');
		       // $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
		        $this->Ln();
		        $fill=!$fill;
		   // }
	    $this->Cell(array_sum($w),0,'','T');
		}
	}

    $Num=$db->highest_invoice_registered(); $numero=$Num[0]['id']+1;  //get the highest inserted id and sum 1 for next insertion
    $client=$db->customer($o['client']); 	$villa=$db->villa($o['villa']);   $encabezado=array('Details','Price','Total');
    $invoice_number=str_pad($numero, 9, "0", STR_PAD_LEFT);   //will output 000055
	//Creación del objeto de la clase heredada
	$pdf=new PDF();
	$pdf->AliasNbPages();
  if ($total_charge_rent>0){
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

	$pdf->Cell(50,14,'VILLA NO.: '.$villa[0]['no'],0,0);
	$pdf->Cell(60,14,'FROM: '.formatear_fecha($o['start']),0,0);
	$pdf->Cell(60,14,'TO: '.formatear_fecha($o['end']),0,0);
	$pdf->Ln(5);
	$pdf->Cell(50,14,'RESERVE REF.: '.$o['ref'],0,0);
	$pdf->SetFont('');
	//end invoice top


     $precio=number_format($o['ppn'],2);
      $precioHS=number_format($o['PHS'],2);

      if (($o['NHS']>0)&&($o['NLS']>0)){ //high and low season
       $totalHS=number_format(($o['PHS']*$o['NHS']),2);
       $totalLS=number_format(($o['ppn']*$o['NLS']),2);
       $data=array( 1=>array($o['NLS'].' nights LS','USD '.$precio,'USD '.$totalLS),2=>array($o['NHS'].' nights HS','USD '.$precioHS,'USD '.$totalHS));
	  }

	  if (($o['NHS']==0)&&($o['NLS']>0)){ //low season
        $totalLS=number_format(($o['ppn']*$o['NLS']),2);
     	$data=array(1=>array($o['nights'].' nights LS','USD '.$precio,'USD '.$totalLS), 2=>array('','',''));
      }

      if (($o['NHS']>0)&&($o['NLS']==0)){ //high season
      	$totalHS=number_format(($o['PHS']*$o['NHS']),2);
     	$data=array(1=>array($o['nights'].' nights HS','USD '.$precioHS,'USD '.$totalHS), 2=>array('','',''));
      }

  	 $pdf->FacturaTable($encabezado,$data,$ckout_charg);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Sub-Total Nights = ','L',0,'R',0);

     //$sub_total= ($totalHS+$totalLS);
     $sub_total=($o['subtotal']-$o['itbis']);

     $pdf->Cell(40,6,'USD '.number_format($sub_total,2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'ITBIS (VTA - TAXS) 16% = ','L',0,'R',0);
     $pdf->SetFont('','U');
     $pdf->Cell(40,6,'USD '.number_format($itbis=($sub_total*0.16),2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'TOTAL PER NIGHTS = ','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($general_total=($itbis+$sub_total),2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
      $pdf->Cell(185,0,'','T');
     $pdf->Ln();

     $sub_ckout=0;
     foreach($ckout_charg as $ck){
     $sub_ckout+=$ck['price'];
     }

     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'Checkout charges','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($sub_ckout,2),'R',0,'R',0);
      $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(145,6,'ITBIS (VTA - TAXS) 16 %','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format($ck_tax=($sub_ckout*0.16),2),'R',0,'R',0);
     $pdf->Ln();
     $pdf->SetFont('','B');
     $pdf->Cell(145,6,'TOTAL PAYMENT','L',0,'R',0);
     $pdf->Cell(40,6,'USD '.number_format(($sub_ckout+$ck_tax),2),'R',0,'R',0);
     $pdf->SetFont('');
     $pdf->Ln();
     $pdf->Cell(185,0,'','T');
     //signature invoice
     $pdf->Ln(15);
     $pdf->Cell(93,6,'Delivery by:',0,0,'C',0);
     $pdf->Cell(93,6,'Received by:',0,0,'C',0);
     $pdf->Ln(15);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
     $pdf->Ln();
     $pdf->Cell(93,6,'R.C.L. Administracciones',0,0,'C',0);
      //signature end
   }
      $servicios_reserva=$db->services_reserved($o['reserveid']);
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   if($price5>0){
     if ((!empty($servicios_reserva))||(!empty($price5))){
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
	     $pdf->FacturaService($encabezado,$servicios_reserva,$late_ckout);
	     $pdf->Ln();
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'Sub-Total = ','L',0,'R',0);
	     $sub_total=($o['aps']);
	     $pdf->Cell(40,6,'USD '.number_format(($ckout_subtotal=$sub_total+$late_ckout['price']),2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->Cell(145,6,'ITBIS (VTA - TAXS) 16%  = ','L',0,'R',0);
	     $pdf->SetFont('','U');
	     $pdf->Cell(40,6,'USD '.number_format(($ck_itbis=$late_ckout['price']*0.16),2),'R',0,'R',0);
	     $pdf->SetFont('');
	     $pdf->Ln();
	     $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'GENERAL TOTAL = ','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format(($ckout_subtotal+$ck_itbis),2),'R',0,'R',0);
	     $pdf->SetFont('');
	      $pdf->Ln();
	     //$pdf->SetFont('','B');
	     $pdf->Cell(145,6,'Late check out total = ','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format(($late_ckout['price']+$ck_itbis),2),'R',0,'R',0);
	    // $pdf->SetFont('');
	     $pdf->Ln();
	      $pdf->SetFont('','B');
	     $pdf->Cell(145,6,'TOTAL PAYMENT= ','L',0,'R',0);
	     $pdf->Cell(40,6,'USD '.number_format(($late_ckout['price']+$ck_itbis),2),'R',0,'R',0);
	     $pdf->SetFont('');
	    //$pdf->Ln();
	     $pdf->Cell(145,6,'','L',0,'R',0);
	     $pdf->Cell(40,6,'','R',0,'R',0);
	     $pdf->Ln();
	     $pdf->Cell(185,0,'','T');

		//signature invoice
	     $pdf->Ln(15);
	     $pdf->Cell(93,6,'Delivery by:',0,0,'C',0);
	     $pdf->Cell(93,6,'Received by:',0,0,'C',0);
	     $pdf->Ln(15);
	     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
	     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
	     $pdf->Ln();
	     $pdf->Cell(93,6,'R.C.L. Administracciones',0,0,'C',0);
	     //signature end
   	  }
  }
	$pdf->Output('documents/invoices/ckout/'.$invoice_number.'.pdf', 'F');     //safe a pdf file for this invoices

	$ref=$_POST['ref'];
	$src='documents/invoices/ckout/'.$invoice_number.'.pdf';
	$id_adm=$_SESSION['info']['id'];
	$link= new subDB();
	$link->insert_invoice($ref, $src, $id_adm, $invoice_number, 2);//insert invoice in db
    //hacer ckout aqui y coger id
    $date_ckout=date("Y-m-d G:i:s");// $id_adm=$_SESSION['info']['id'];
	$link2=new DB(); //connect to class

    //$link2->check_out($_POST['id_reserva']); //UPDATE THIS reserve TO CHECK OUT
    $status="4";
    $result=$link->check_out($_POST['id_reserva'],$status); //make checkout for this reserve

    $id_ckout=$link2->check_out_insert($ref, $date_ckout, $id_adm); //INSERT checkout record  AND TAKE ID INSERTED
    //introducir los cargos de los checkout
    $link2->charge_per_ckout($id_ckout,$desc1,$desc2,$desc3,$desc4,$desc5,$price1,$price2,$price3,$price4,$price5);
       //==============INSERT A COMMENT AS A BOOKING CHANGE IN A EDITION OF A BOOKING=========================
   				  $fecha=date("Y-m-d G:i:s");
                  $insert_comment=$link2->insert_comments($ref,'',$tipo='4'/*mean booking changed*/,$deleted='0', $id_adm=$_SESSION['info']['id'], $fecha, $complaint_no='2'/*mean check out*/, $id_villa, $id_ocupacion_mod=$id_ckout);
		//=====================================================================================================
	$pdf->Output();  //show invoice per checkout
 }else{
	header('Location:check-out.php');
 }
}else{
	header('Location:login.php');
	die();
}
?>