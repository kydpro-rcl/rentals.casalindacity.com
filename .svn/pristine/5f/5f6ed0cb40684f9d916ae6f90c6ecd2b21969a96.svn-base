<?php
require_once('inc/session.php');
if ($_SESSION['info']){

 if ($_POST['ref']!=''){
	 $_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	require_once('init.php');
	 $db= new getQueries ();
  	$busy=$db->see_occupancy_ref($_POST['ref']);
    $o=$busy[0];

    if (empty($o)){header('Location:register-sheet.php?error=Unknown reference number in our booking system'); die();}

	if (($o['status']==7)||($o['status']==19)||($o['status']==20)||($o['status']==21)){
     $owner=$db->show_id('owners', $o['client']);
	 $client=$owner[0];
	 //$inquilino="OWNER";
	}else{
	//$inquilino="CLIENT";
	 $client=$db->customer($o['client']);
	}

    if($_POST['lang']==1){//English
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
				   $this->Cell(60,9,'R.C.L. ADMINISTRACIONES, SRL.');
				   $this->Image('images/invoice/letters.jpg',95,18,40);
				  $this->Ln(1);
				   $this->SetFont('Times','',8);
				   $this->Cell(87);
				   $this->Cell(87,30,'Sosua, Dominican Republic');
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
				    $this->Cell(0,5,'www.CasaLindaCity.com',0,0,'L');
				    $this->Cell(0,5,'Reservations@CasaLindaCity.com',0,0,'R');
				    $this->Ln(1);
				    //Número de página
				    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

				}

				function peopleRegistered($adults,$kids)
				{

			    //Cabecera
			    $w=array(93,93);
			    $this->Ln();
			    $qty_a=count($adults);//count number of adults
				$qty_k=count($kids);  //count number of kids
			    $fill=0;
			    $counter=0;

			    //Colores, ancho de línea y fuente en negrita
			    $this->SetFillColor(145,142,142);
			    $this->SetTextColor(255);
			    $this->SetDrawColor(56,55,55);
			    $this->SetLineWidth(.3);
			    $this->SetFont('','B');
			    //Cabecera
			     $this->Cell(186,7,$qty_a.' ADULTS',1,0,'C',1);
			   	 $this->Ln();
			   	 $this->SetFillColor(224,235,255);
			     $this->SetTextColor(0);
			     $this->SetFont('');
				    foreach($adults as $a)
				    {
					    if ($qty_a==1){
					       $this->Cell(186,6,ucfirst(utf8_decode($a['name'])).' '.ucfirst(utf8_decode($a['lastname'])),'LR',0,'C',$fill);
					       $this->Ln();
					    }else{
						    $counter+=1;
						    $this->Cell($w[0],6,ucfirst(utf8_decode($a['name'])).' '.ucfirst(utf8_decode($a['lastname'])),'LR',0,'C',$fill);
				            if ($counter==2){ $this->Ln(); $counter=0; $fill=!$fill;}
			             }

				     }
				     $r=($qty_a%2);//Remainder of $adults divided by 2.
			           if (($r==1)&&($qty_a!=1)){
			            $this->Cell($w[0],6,' ','LR',0,'C',$fill);
			            $this->Ln();
			           }

			    $this->Cell(array_sum($w),0,'','T');
		        $this->Ln(5);

		         //Colores, ancho de línea y fuente en negrita
			    $this->SetFillColor(145,142,142);
			    $this->SetTextColor(255);
			    $this->SetDrawColor(56,55,55);
			    $this->SetLineWidth(.3);
			    $this->SetFont('','B');
			    //Cabecera
			    $this->Ln();
			     $this->Cell(186,7,$qty_k.' KIDS',1,0,'C',1);
			   	 $this->Ln();
			   	 $this->SetFillColor(224,235,255);
			     $this->SetTextColor(0);
			     $this->SetFont('');
			     $counter2=0;
			     if ($qty_k!=0){
				    foreach($kids as $k){

					    if ($qty_k==1){
					       $this->Cell(186,6,ucfirst(utf8_decode($k['name'])).' '.ucfirst(utf8_decode($k['lastname'])),'LR',0,'C',$fill);
					       $this->Ln();
					    }else{
						    $counter2+=1;
						    $this->Cell($w[0],6,ucfirst(utf8_decode($k['name'])).' '.ucfirst(utf8_decode($k['lastname'])),'LR',0,'C',$fill);
				            if ($counter2==2){ $this->Ln(); $counter2=0; $fill=!$fill;}
			             }

		            }
				    $re=($qty_k%2);//Remainder of $adults divided by 2.
			           if (($re==1)&&($qty_k!=1)){
			            $this->Cell($w[0],6,' ','LR',0,'C',$fill);
			            $this->Ln();
			           }

			    $this->Cell(array_sum($w),0,'','T');
			     }
				}


			    }

			/*$Num=55;
			print str_pad($Num, 6, "0", STR_PAD_LEFT);   //will output 000055     */
			//Creación del objeto de la clase heredada
			$pdf=new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
		    $pdf->SetAuthor('ing.joseluis@msn.com');
			$pdf->SetTitle('Residencial Casa Linda-Invoice');
			$pdf->SetFont('Times','',16);
			$pdf->Ln(10);
			$pdf->Cell(80);
			$pdf->SetFont('','B');
			$pdf->Cell(80,10,'REGISTER SHEET');      //invoice title
			$pdf->SetFont('Times','',12);
			//$pdf->Cell(0,10,'INVOICE PER RENT',0,1,'C');
			//invoice top
			$pdf->Ln(10);
			$Num=$db->highest_re_sheet_registered(); $numero=$Num[0]['id']+1;  //get the highest inserted id and sum 1 for next insertion

			$invoice_number=str_pad($numero, 9, "0", STR_PAD_LEFT);   //will output 000000055  if 55
			$pdf->Cell(0,5,'No.: '.$invoice_number,0,0,'L');
			$fecha=date('Y-m-d G:i:s');
			$pdf->Cell(0,5,'Date: '.$fecha,0,0,'R');
			$pdf->Ln(5);
			//$pdf->Ln(20);
			$villa=$db->villa($o['villa']);
			//$pdf->SetFont('','U');
			$pdf->SetFont('','B');
			$pdf->Cell(50,14,'VILLA NO.: '.$villa[0]['no'],0,0);
			$pdf->Cell(80,14,'FROM: '.formatear_fecha($o['start']),0,0);
			$pdf->Cell(60,14,'TO: '.formatear_fecha($o['end']),0,0);
			$pdf->SetFont('');
			$pdf->Ln(5);
			$pdf->Cell(50,14,'REF. #: '.$o['ref'],0,0);
			$pdf->SetFont('','B');
			$pdf->Ln(5);
		    $pdf->Cell(50,14,'TIME CHECKOUT (No later than 12:00 or extra charge). ___________________',0,0);
		    $pdf->SetFont('');
			//$pdf->Ln();
		    // $pdf->Cell(185,0,'','T'); // make a line
			$pdf->Ln();

			//$client=$db->customer($o['client']);

			$pdf->Cell(80,14,'CLIENT: '.ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),0,0);
			$pdf->Cell(50,14,'PHONE: '.$client['phone'],0,0);
			$pdf->Cell(60,14,'CLIENT NO: '.$client['id'],0,0);
			//$pdf->Cell(60,14,'EMAIL: '.$client['email'],0,0);
		    $pdf->Ln(5);

		    $pdf->Cell(80,14,'EMAIL: '.$client['email'],0,0);
		    $pdf->Cell(50,14,'PASSPORT: '.$client['passport'],0,0);
		    $pdf->Cell(60,14,'CEDULA: '.$client['cedula'],0,0);
		    $pdf->Ln(5);
		    $pdf->Cell(130,14,'ADDRESS: '.$client['address'],0,0);
		    $paises=countryArray(); $actual_country=$paises[$client['country']];
		    $pdf->Cell(130,14,'COUNTRY: '.$actual_country,0,0);
		    $pdf->Ln(5);
		    $pdf->SetFont('Times','',10);
		    $pdf->Cell(55,14,'NO. GUEST: '.($o['kids']+$o['adults']),0,0);
		    $pdf->Cell(35,14,'No. NIGHTS: '.$o['nights'],0,0);

		     if (($o['NLS']>0)&&($o['NHS']>0)){ //if have mix seasons
		      $pdf->Cell(60,14,'PRICE/NIGHT: US$'.$o['ppn'].'/'.$o['PHS'].' + 18% tax',0,0);
		     }
		     if (($o['NLS']>0)&&($o['NHS']==0)){ //if have low seasons
		      $pdf->Cell(60,14,'PRICE/NIGHT: US$'.$o['ppn'].' + 18% tax',0,0);
		     }
		     if (($o['NLS']==0)&&($o['NHS']>0)){ //if have hight seasons
		      $pdf->Cell(60,14,'PRICE/NIGHT: US$'.$o['PHS'].' + 18% tax',0,0);
		     }
		    //$pdf->Ln();
		     //$pdf->Cell(185,0,'','T');

		     $encabezado=array('Adults','Children');
		     $data=$db->people($o['reserveid']);
		     //$pdf->Ln(5);

		    #  print_r($data);
		      $kids=array();
		      $adults=array();
		      foreach ($data as $d){
		        if ($d['type']==1) array_push($adults,$d);
		        if ($d['type']==2) array_push($kids,$d);
		     }
		    /*  echo '<br>';
		      print_r($adults);
		      echo '<br>';
		      print_r($kids); */
		      $pdf->peopleRegistered($adults,$kids);

		     $pdf->Ln(5);
		     $pdf->SetFont('');
		     $pdf->Cell(185,1,'I agree and acknowledge the following:',0);
		     $pdf->Ln(10);
		      $pdf->SetFont('','B');
		     $pdf->Cell(185,3,'# of Villa keys received: ______ replacement cost per villa key (50.00 USD)',0);
		     $pdf->Ln(10);
		     $pdf->Cell(185,3,'# of Key Cards received: ______ replacement cost per Key Card (10.00 USD)',0);
		     $pdf->Ln(10);
		     $pdf->Cell(185,4,'# of Safe keys received: ______ replacement cost per safe key (100.00 USD)',0);
		     $pdf->Ln(10);
		     $pdf->Cell(185,5,'# of remotes received: Radio______ DVD______TV______A/C______Cable______ Game _______',0);
			 $pdf->Ln();
              $pdf->Cell(185,5,'Replacement cost per remote is 100.00 USD',0);
		     $pdf->SetFont('');
		     $pdf->Ln(10);

		     $pdf->MultiCell(185,5,'While I am renting the above mentioned villa, I agree to accept responsibility for any damages to the villa itself, its furnishings and its small appliances; as well as responsibility for items that are lost during my stay.  I agree that R.C.L. AMINISTRACIONES, S.R.L. will replace and/or repair these lost or damaged items, and I will be charged for the cost of the repairs or replacements.  I also acknowledge and release R.C.L. AMINISTRACIONES, S.R.L. and its staff, of responsibility for any injury that may occur to myself, or my guests, during my stay at Residencial Casa Linda. I agree to abide by any rules set and enforced by Casa Linda and/or Casa Linda Security. ________(initials)',0, 'J');

		     $pdf->Ln(5);
		     $pdf->Cell(185,0,'There is no refund for early departures. ________(initials)',0);

		     //signature invoice
		     $pdf->Ln(15);
		     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
		     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
		     $pdf->Ln(5);
		     $pdf->Cell(93,6,'DATE',0,0,'C',0);
		      $pdf->Cell(93,6,'SIGNATURE',0,0,'C',0);
		      //signature end
		     # $servicios_reserva=$db->services_reserved($o['reserveid']);
    }//END WRITING REGISTER SHEET IN ENGLISH

    if($_POST['lang']==2){//Spanish
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
				   $this->Cell(60,9,'R.C.L. ADMINISTRACIONES, SRL.');
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
				    $this->Cell(0,5,'www.CasaLindaCity.com',0,0,'L');
				    $this->Cell(0,5,'Reservations@CasaLindaCity.com',0,0,'R');
				    $this->Ln(1);
				    //Número de página
				    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

				}

				function peopleRegistered($adults,$kids)
				{

			    //Cabecera
			    $w=array(93,93);
			    $this->Ln();
			    $qty_a=count($adults);//count number of adults
				$qty_k=count($kids);  //count number of kids
			    $fill=0;
			    $counter=0;

			    //Colores, ancho de línea y fuente en negrita
			    $this->SetFillColor(145,142,142);
			    $this->SetTextColor(255);
			    $this->SetDrawColor(56,55,55);
			    $this->SetLineWidth(.3);
			    $this->SetFont('','B');
			    //Cabecera
			     $this->Cell(186,7,$qty_a.' ADULTOS',1,0,'C',1);
			   	 $this->Ln();
			   	 $this->SetFillColor(224,235,255);
			     $this->SetTextColor(0);
			     $this->SetFont('');
				    foreach($adults as $a)
				    {
					    if ($qty_a==1){
					       $this->Cell(186,6,ucfirst(utf8_decode($a['name'])).' '.ucfirst(utf8_decode($a['lastname'])),'LR',0,'C',$fill);
					       $this->Ln();
					    }else{
						    $counter+=1;
						    $this->Cell($w[0],6,ucfirst(utf8_decode($a['name'])).' '.ucfirst(utf8_decode($a['lastname'])),'LR',0,'C',$fill);
				            if ($counter==2){ $this->Ln(); $counter=0; $fill=!$fill;}
			             }

				     }
				     $r=($qty_a%2);//Remainder of $adults divided by 2.
			           if (($r==1)&&($qty_a!=1)){
			            $this->Cell($w[0],6,' ','LR',0,'C',$fill);
			            $this->Ln();
			           }

			    $this->Cell(array_sum($w),0,'','T');
		        $this->Ln(5);

		         //Colores, ancho de línea y fuente en negrita
			    $this->SetFillColor(145,142,142);
			    $this->SetTextColor(255);
			    $this->SetDrawColor(56,55,55);
			    $this->SetLineWidth(.3);
			    $this->SetFont('','B');
			    //Cabecera
			    $this->Ln();
			     $this->Cell(186,7,$qty_k.' NIÑOS',1,0,'C',1);
			   	 $this->Ln();
			   	 $this->SetFillColor(224,235,255);
			     $this->SetTextColor(0);
			     $this->SetFont('');
			     $counter2=0;
			     if ($qty_k!=0){
				    foreach($kids as $k){

					    if ($qty_k==1){
					       $this->Cell(186,6,ucfirst(utf8_decode($k['name'])).' '.ucfirst(utf8_decode($k['lastname'])),'LR',0,'C',$fill);
					       $this->Ln();
					    }else{
						    $counter2+=1;
						    $this->Cell($w[0],6,ucfirst(utf8_decode($k['name'])).' '.ucfirst(utf8_decode($k['lastname'])),'LR',0,'C',$fill);
				            if ($counter2==2){ $this->Ln(); $counter2=0; $fill=!$fill;}
			             }

		            }
				    $re=($qty_k%2);//Remainder of $adults divided by 2.
			           if (($re==1)&&($qty_k!=1)){
			            $this->Cell($w[0],6,' ','LR',0,'C',$fill);
			            $this->Ln();
			           }

			    $this->Cell(array_sum($w),0,'','T');
			     }
				}


			    }

			/*$Num=55;
			print str_pad($Num, 6, "0", STR_PAD_LEFT);   //will output 000055     */
			//Creación del objeto de la clase heredada
			$pdf=new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage();
		    $pdf->SetAuthor('ing.joseluis@msn.com');
			$pdf->SetTitle('Residencial Casa Linda-Invoice');
			$pdf->SetFont('Times','',16);
			$pdf->Ln(5);
			$pdf->Cell(80);
			$pdf->SetFont('','B');
			$pdf->Cell(80,10,'HOJA DE REGISTRO');      //invoice title
			$pdf->SetFont('Times','',12);
			//$pdf->Cell(0,10,'INVOICE PER RENT',0,1,'C');
			//invoice top
			$pdf->Ln(10);
			$Num=$db->highest_re_sheet_registered(); $numero=$Num[0]['id']+1;  //get the highest inserted id and sum 1 for next insertion

			$invoice_number=str_pad($numero, 9, "0", STR_PAD_LEFT);   //will output 000000055  if 55
			$pdf->Cell(0,5,'No.: '.$invoice_number,0,0,'L');
			$fecha=date('Y-m-d G:i:s');
			$pdf->Cell(0,5,'Fecha: '.$fecha,0,0,'R');
			$pdf->Ln(5);
			//$pdf->Ln(20);
			$villa=$db->villa($o['villa']);
			//$pdf->SetFont('','U');
			$pdf->SetFont('','B');
			$pdf->Cell(50,14,'VILLA NO.: '.$villa[0]['no'],0,0);
			$pdf->Cell(80,14,'DESDE: '.formatear_fecha($o['start']),0,0);
			$pdf->Cell(60,14,'HASTA: '.formatear_fecha($o['end']),0,0);
			$pdf->SetFont('');
			$pdf->Ln(5);
			$pdf->Cell(50,14,'REF.#: '.$o['ref'],0,0);
			$pdf->SetFont('','B');
			$pdf->Ln(5);
		    $pdf->Cell(50,14,'HORA DE SALIDA (No mas tarde de las 12:00 o serán aplicados cargos extras). ___________________',0,0);
		    $pdf->SetFont('');
			//$pdf->Ln();
		    // $pdf->Cell(185,0,'','T'); // make a line
			$pdf->Ln();

			//$client=$db->customer($o['client']);

			$pdf->Cell(80,14,'CLIENTE: '.ucfirst(utf8_decode($client['name'])).' '.ucfirst(utf8_decode($client['lastname'])),0,0);
			$pdf->Cell(50,14,'TEL: '.$client['phone'],0,0);
			$pdf->Cell(60,14,'NO. CLIENTE: '.$client['id'],0,0);
			//$pdf->Cell(60,14,'EMAIL: '.$client['email'],0,0);
		    $pdf->Ln(5);

		    $pdf->Cell(80,14,'EMAIL: '.$client['email'],0,0);
		    $pdf->Cell(50,14,'PASAPORTE: '.$client['passport'],0,0);
		    $pdf->Cell(60,14,'CEDULA: '.$client['cedula'],0,0);
		    $pdf->Ln(5);
		    $pdf->Cell(130,14,'DIRECCION: '.$client['address'],0,0);
		    $paises=countryArray(); $actual_country=$paises[$client['country']];
		    $pdf->Cell(130,14,'PAIS: '.$actual_country,0,0);
		    $pdf->Ln(5);
		    $pdf->SetFont('Times','',10);
		    $pdf->Cell(55,14,'# HUESPEDES: '.($o['kids']+$o['adults']),0,0);
		    $pdf->Cell(35,14,'# NOCHES: '.$o['nights'],0,0);

		     if (($o['NLS']>0)&&($o['NHS']>0)){ //if have mix seasons
		      $pdf->Cell(60,14,'PRECIO/NOCHE: US$'.$o['ppn'].'/'.$o['PHS'].' + 18% tax',0,0);
		     }
		     if (($o['NLS']>0)&&($o['NHS']==0)){ //if have low seasons
		      $pdf->Cell(60,14,'PRECIO/NOCHE: US$'.$o['ppn'].' + 18% tax',0,0);
		     }
		     if (($o['NLS']==0)&&($o['NHS']>0)){ //if have hight seasons
		      $pdf->Cell(60,14,'PRECIO/NOCHE: US$'.$o['PHS'].' + 18% tax',0,0);
		     }
		    //$pdf->Ln();
		     //$pdf->Cell(185,0,'','T');

		     $encabezado=array('Adults','kids');
		     $data=$db->people($o['reserveid']);
		     //$pdf->Ln(5);

		    #  print_r($data);
		      $kids=array();
		      $adults=array();
		      foreach ($data as $d){
		        if ($d['type']==1) array_push($adults,$d);
		        if ($d['type']==2) array_push($kids,$d);
		     }
		    /*  echo '<br>';
		      print_r($adults);
		      echo '<br>';
		      print_r($kids); */
		      $pdf->peopleRegistered($adults,$kids);

		     $pdf->Ln(5);
		     $pdf->SetFont('');
		     $pdf->Cell(185,1,'Estoy de acuerdo y reconozco lo siguiente:',0);
		     $pdf->Ln(10);
		      $pdf->SetFont('','B');
		     $pdf->Cell(185,3,'# de llaves de villa recibidas:______________ El costo de reemplazo por llave de villa es (50.00 USD)',0);
		     $pdf->Ln(10);
		      $pdf->Cell(185,3,'# de llaves de tarjetas recibidas:______________ El costo de reemplazo por llave de tarjeta es (10.00 USD)',0);
		     $pdf->Ln(10);
		     $pdf->Cell(185,5,'# de llaves de caja recibidas:_______________  El costo de reemplazo por llave de caja es (100.00 USD)',0);
			 $pdf->Ln(10);
			 $pdf->Cell(185,4,'# de controles recibidos: Radio______ DVD______TV______AC______Cable______ Juego_______',0);
		     $pdf->Ln();

		     $pdf->Cell(185,6,'El costo de reemplazo es de US$100 por control perdido.',0);

		     $pdf->SetFont('');
		     $pdf->Ln(5);

		     $pdf->Ln();
		     $pdf->MultiCell(185,5,'Mientras estoy rentando la villa mencionada arriba, estoy de acuerdo a aceptar la responsabilidad por cualquier daño a la villa, sus muebles y sus utensilios; así como por cualquier elemento perdido durante mi estadía. Acepto que R.C.L. ADMINISTRACIONES,  S.R.L. reemplazará y/o reparará estos elementos perdidos o dañado, y yo seré cargado por el costo de reparación o reemplazo. Yo también reconozco y libero a R.C.L. ADMINISTRACIONES, S.R.L. y su equipo, de responsabilidad por cualquier herida que me pueda ocurrir, o a mis huéspedes, durante mi permanencia en Residencial Casa Linda. Estoy de acuerdo en acatar las normas establecidas y aplicadas por Casa Linda y/o la Seguridad de Casa Linda. ________(Iniciales)',0, 'J');
		     $pdf->Ln(5);
		     $pdf->Cell(185,0,'No hay devolución para salidas anticipadas. ________(Iniciales)',0);

		     //signature invoice
		     $pdf->Ln(15);
		     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
		     $pdf->Cell(93,6,'____________________________________',0,0,'C',0);
		     $pdf->Ln(5);
		     $pdf->Cell(93,6,'FECHA',0,0,'C',0);
		      $pdf->Cell(93,6,'FIRMA',0,0,'C',0);
		      //signature end
		     # $servicios_reserva=$db->services_reserved($o['reserveid']);
    }//END WRITING REGISTER SHEET IN SPANISH

	$pdf->Output('documents/registers/'.$invoice_number.'.pdf', 'F');    //make an output to a file pdf

	$ref=$_POST['ref'];
	$src='documents/registers/'.$invoice_number.'.pdf';
	$id_adm=$_SESSION['info']['id'];
	$link= new subDB();
	$link->insert_register_sheet($ref, $src, $invoice_number, $id_adm);//insert register sheet in db

	$pdf->Output();
 }else{
	header('Location:register-sheet.php?error=Reference number was Empty');
 }
}else{
	header('Location:login.php');
	die();
}
?>