<? 
function bookings_referralID($referalID){
	$sort="`busy`.`date`";
	$sql="";//all
	$data= new getQueries();
	$bookings_found=$data->bookings_referal_overview($referalID, $sql, $sort);  //muestra organizado por fechas 10
	if ($bookings_found){

		  ?>
<p style="font-size:10px; padding-left:15px; "><strong>Total bookings found: <?=count($bookings_found)?></strong></p>
		<hr style="width:95%;" />
			<table  align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
				<tr class="title" style="background-color:#dfdfdf;">
					 <td class='centro' id="td" style="text-align:center;">
						DATE
					</td>
					 <td class='centro' id="td" style="text-align:center;">
						CLIENT NAME
					</td>
					<td class='centro' id="td" style="text-align:center;">
					   REF. NO.
					</td>
					<td class='centro' id="td" style="text-align:center;">
					   BOOKING STATUS
					</td>
					<td class='centro' id="td" style="text-align:center;">
						PAYMENTS STATUS
					</td>
					<td class='centro' id="td" style="text-align:center;">
						DETAILS
					</td>
					<td class='centro' id="td" style="text-align:center;">
						COMMISSION AMOUNT
					</td>
				</tr>
			<?php

			$x=0;
			//$General_Totals=0;
			foreach ($bookings_found as $k){
			?>
			<tr class='fila<?=$x;?>'  >
			 <td id='td' class='derecha'><? echo  date('Y-m-d',strtotime($k['date']));?></td>
				 <? $db= new getQueries ();
			   $client_d=$db->show_id("customers", $k['client']);

			   ?>
				 <td id='td' class='derecha'><? echo  $client_d[0]['name']." ". $client_d[0]['lastname'];?></td>
				 <td id='td' class='derecha'><? echo  $k['ref'];?></td>
					 <?
				   switch ($k['status']){
					case 0:
						$status_result="<span style='color:red'>Cancelled</span>";
						break;
					case 1:
						$status_result="<span class='azul2'>Checked in-Short</span>";
						$tipo_de_renta=1;
						break;
					case 2:
						$status_result="<span class='azul2'>Confirmed-Short</span>";
						$tipo_de_renta=1;
						break;
					case 3:
						$status_result= "<span class='morado'>No Confirmed-Short</span>";
						$tipo_de_renta=1;
						break;
					case 4:
						$status_result= "<span class='outck'>Checked out-Short</span>";
						$tipo_de_renta=1;
						break;
					case 5:
						$status_result= "<span style='color:red'>Maintenance (out of service)</span>";
						break;
				   case 6:
						$status_result= "<span class='r_vip'>Checked in-short VIP</span>";
						$tipo_de_renta=1;
						break;
					case 7:
						$status_result= "<span class='r_owner'>Checked in-Owner Short</span>";
						$tipo_de_renta=1;
						break;
					case 8:
						$status_result= "<span class='r_long'>Checked in - Long</span>";
						$tipo_de_renta=2;
						break;
					case 9:
						$status_result= "<span class='r_long'>Confirmed - Long</span>";
						$tipo_de_renta=2;
						break;
					case 10:
						$status_result= "<span class='r_long'>No Confirmed - Long</span>";
						$tipo_de_renta=2;
						break;
					case 11:
						$status_result= "<span class='r_long'>Checked Out - Long</span>";
						$tipo_de_renta=2;
						break;
					case 12:
						$status_result= "<span class='r_vip'>Confirmed-Short VIP</span>";
						$tipo_de_renta=1;
						break;
					case 13:
						$status_result= "<span class='r_vip'>No Confirmed-Short VIP</span>";
						$tipo_de_renta=1;
						break;
					case 14:
						$status_result= "<span class='r_vip'>Checked Out-Short VIP</span>";
						$tipo_de_renta=1;
						break;
					case 15:
						$status_result= "<span class='r_vip'>Checked in-Long VIP</span>";
						$tipo_de_renta=2;
						break;
					case 16:
						$status_result= "<span class='r_vip'>Confirmed-Long VIP</span>";
						$tipo_de_renta=2;
						break;
					case 17:
						$status_result= "<span class='r_vip'>No Confirmed-Long VIP </span>";
						$tipo_de_renta=2;
						break;
					case 18:
						$status_result= "<span class='r_vip'>Checked Out-Long VIP</span>";
						$tipo_de_renta=2;
						break;
					case 19:
						$status_result= "<span class='r_long'>Confirmed-Owner, Short</span>";
						$tipo_de_renta=1;
						break;
					case 20:
						$status_result= "<span class='r_long'>No confirmed-Owner, Short</span>";
						$tipo_de_renta=1;
						break;
					case 21:
						$status_result= "<span class='r_long'>Checked Out - Owner, Short</span>";
						$tipo_de_renta=1;
						break;
					case 22:
						$status_result= "<span class='r_long'>Checked in - Owner, Long</span>";
						$tipo_de_renta=2;
						break;
					case 23:
						$status_result= "<span class='r_long'>Confirmed - Owner, Long</span>";
						$tipo_de_renta=2;
						break;
					case 24:
						$status_result= "<span class='r_long'>No confirmed - Owner, Long</span>";
						$tipo_de_renta=2;
						break;
					case 25:
						$status_result= "<span class='r_long'>Checked Out - Owner, Long</span>";
						$tipo_de_renta=2;
						break;
					default:
					   $status_result= "<span class='negro'><u>Unavailabe</u></span>";
						break;
				   }
				   ?>
			   <td id='td' class='derecha'><?=$status_result?></td>
			   <td> <? if ($k['status']==0){?><span style="color:red; font-weight:bold;"> Cancelled </span><? }?>
					<? if ($k['paid']==2){?> <span style="color:green; font-weight:bold;">Paid</span> <? }?>
					<? if (($k['status']==4)&&($k['paid']==0)){?> UnPaid <? }?>
					<? if ($k['paid']==1){?> Ready to pickup <? }?>
					<? if (($k['status']!=4)&&($k['status']<>0)&&($k['paid']==0)){?> <span style="color:orange; font-weight:bold;">In Process</span> <? }?>

			   </td>
			   <td><a href="#" onclick="reserva('../booking/reserva_details_RAP.php?id=<?=$k['busyid']?>','Details for Selection', 440, 760)">details</a></td>

			  <? if($tipo_de_renta==1){?>
				<?
			   /*$total_booking=$k['subtotal']-$k['itbis']; */
				$total_booking=(($k['ppn']*$k['NLS'])+($k['PHS']*$k['NHS']));

			   $db= new getQueries();
			   ?>

							 <!--//   codigo para promotion code//-->
						<?
							/*echo "<pre>";
							print_r($k);
							echo "</pre>"; */

							$this_disc=$db->show_any_data_limit1("discount", "reference", $k['ref'], "=");
							$disc_found=$this_disc[0];
							  if ($disc_found){
		
									$amount_nights=$total_booking;

									 if  ($disc_found['pro_type']=="2"){   //Amount
										   $descuento=($disc_found['pro_qty']);
									 }elseif($disc_found['pro_type']=="1"){ //percent
										$descuento=($amount_nights*($disc_found['pro_qty']/100));
									 }elseif($disc_found['pro_type']=="3"){ //days

										if ($k['NLS']!=0 &&  $k['NHS']==0){//solo low season
										   $descuento=$k['ppn']*$disc_found['qty_days'];
										}

										if (($k['NLS']==0)&&( $k['NHS']!=0)){//solo High season
										   $descuento=$k['PHS']*$disc_found['qty_days'];
										}

										if (($k['NLS']!=0) && ($k['NHS']!=0)){//ambas season
										  if($k['NLS']>=$disc_found['qty_days']){
											$descuento=$k['ppn']*$disc_found['qty_days'];
										  }else{
											$descuento=$k['ppn']*$k['NLS'];
											$descuento+=$k['PHS']*($disc_found['qty_days']-$k['NLS']);
										  }
										}

										/*$variable_descuento=$disc_found['qty_days']." Nights";*/
									 }

							  }
							  $total_booking-=$descuento; //reduce the discount to the total of the booking
					?>
					 <!--//   codigo para promotion code//-->
				<td id='td' class='derecha' style="text-align:right;"> <? if ($k['status']==0){?> US$ 0.00 <? }else{?> US$ <?=number_format($total_booking*$_SESSION['referal']['percent'],2);?> <? }?></td>
			  <?}?>
			   <? if($tipo_de_renta==2){?>
				<?
			   //$total_booking=$k['subtotal']-$k['itbis'];

			   ?>
				<? if ($k['EN']>0){ $meses_enteros=($k['PAYM']-1);}else{$meses_enteros=$k['PAYM'];}
				$noches_extras=$k['EN'];
				$precio_por_meses=$k['PL'];

				$total_comision_long=(($precio_por_meses*$meses_enteros)*$_SESSION['referal']['long_percent'])+((($precio_por_meses/30)*$noches_extras)*$_SESSION['referal']['long_percent']);
				?>
				<td id='td' class='derecha' style="text-align:right;"> US$ <?=number_format($total_comision_long,2);?> </td>
			  <?}?>
			   <? if($tipo_de_renta==0){?>
				<?
			   $total_booking=$k['subtotal']-$k['itbis'];

			   ?>
				<td id='td' class='derecha' style="text-align:right;">  US$ 0.00 </td>
			  <?}?>
			   </tr>
			 <?
			 if ($x==0){$x++;} elseif ($x==1){$x--;}

			}

			?>

			</table>



		<?}else{
			echo "<p style='text-align:center; color:red; font-size:16px;'>There are no bookings found.</p>";

		}
}
?>

<?php
function seeReferralClients($idReferral){
		$data= new getQueries ();
		if (!$_GET['sort']){
		//$customers=$data->show_all('customers', 'id');
		$customers=$data->show_data('customers', "`id_commission`='".$idReferral."' OR 	`id_seller`='".$idReferral."'", 'country');
		$total_records=$data->getAffectedRows();
		}else{

		 switch ($_GET['sort']){
		 case "no":
		 			$customers=$data->show_all('customers', 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "status":
		 			$customers=$data->show_all('customers', 'active');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "name":
		 			$customers=$data->show_all('customers', 'name');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "email":
		 			$customers=$data->show_all('customers', 'email');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "phone":
		 			$customers=$data->show_all('customers', 'phone');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "country":
		 			$customers=$data->show_all('customers', 'country');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 case "state":
		 			$customers=$data->show_all('customers', 'state');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 default	:
		 			$customers=$data->show_all('customers', 'id');
		 			$total_records=$data->getAffectedRows();
		 			break;
		 }
		}
		?>

		<!--//<p class="header">All our customers</p>//-->
		<p style="font-size:10px; padding-left:15px;"><strong>Total customers found: <?=$total_records?></strong></p>
		<hr style="width:95%;" />
		<table  align="center" cellpadding="2" cellspacing="2" border="0">

			<tr class="title">
				<td class='centro' id="td">
					NO
				</td>
				<td class='centro' id="td">
					FIRST NAME
				</td>
				<td class='centro' id="td">
					LAST NAME
				</td>
				<td class='centro' id="td">
					STATUS
				</td>
				<td class='centro' id="td">
					COUNTRY
				</td>
				<td class='centro' id="td">
					STATE
				</td>
				<td class='centro' id="td">AGENT FOR</td>
			</tr>
		<?php

		$x=0;
		foreach ($customers as $k){
		#echo $customers['4']['name'];
		echo "<tr class='fila$x' >
		<td id='td' class='derecha'>".$k['id']."</td>";

		echo "<td id='td'>".$k['name']."</td>";
		echo "<td id='td'>".($k['lastname'])."</td>";

		if ($k['active']==1){
			if ($k['classify_cust']==1){
				echo "<td class='centro' style='color:green;'  id='td'>Active</td>";
			}else{
				echo "<td class='centro' id='td'>Active</td>";
			}
		}else{
			if ($k['classify_cust']==1){
				echo "<td class='centro' style='color:#d91be0;' id='td'>Disabled</td>";
			}else{
				echo "<td class='centro rojo' id='td'>Disabled</td>";
			}
		}

		 $paises=countryArray();
		 $states=cities($k['country']);
		 $provincia=$states[$k['state']];

			  echo "<td id='td'>".$paises[$k['country']]."</td>";

			 if ($provincia){
				echo "<td id='td'>".$provincia."</td>";
			 }else{
			    echo  "<td id='td'>".$k['state']."</td>";
			 }
			 
			  ?>
			<td>
			<?if($k['id_commission']==$_SESSION['referal']['id']){?>
				Rental
			<?}?>-
			<?if($k['id_seller']==$_SESSION['referal']['id']){?>
			Sale
			<?}?>
			</td></tr>
			<?

		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		//.utf8_encode($k['lastname'])
		?>
		</table>
<?}?>

<?php

function email_body($ref, $full_name, $general_amount, $villa_number,$qty_nights,$starting,$ending){
	$total_sin_impuestos=($general_amount/1.18);//RETURN QUANTITIES WITHOUT TAXES
	$impuestos=number_format(($total_sin_impuestos*0.18),2);
	$PAYMENT_DUE=number_format(($general_amount-$resArray['AMT']),2);
	$villa_number=$vd['no'];
	$general_amount=number_format($general_amount,2);
	$body="<!doctype html>
	<html>
	<head>
	<meta charset=\"utf-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	<title>BOOKING RESERVATION-Residencial Casa Linda</title>
	<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
	</head>


	<body>
	<div class=\"container\">
	<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

	<p>&nbsp;</p>
	<p>Dear $full_name,</p>

	<p>Thank you for booking with Residencial Casa Linda,
	<p><strong>BOOKING RESERVATION: $ref.
	  
	  </strong>
	<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
	  Check-In $starting		 Check-in time: 3.00 PM<br>
	  Check-Out
	</strong><strong> $ending
	  Check-out time: 12.00 Noon<br>
	  <br>
	  Price: $total_sin_impuestos USD
	  <br>
	  Taxes:
	  $impuestos USD<br>
	  Total price: $general_amount USD<br>
	  Balance due: $PAYMENT_DUE USD</strong></p>
	<p>  <br>
	  Shortly you will receive an invoice from us, please pay this one within 24 hours to confirm your reservation.<br>
	  These invoices are controlled by our cancellation fees and depending on the time before arrival more invoices will follow until the full payment has been made.
	</p>
	<p>  <br>
	  Bring yours and all adults who checks in with you passport or Valid ID into the check-in office in order to check-in.<br>
	  We will ask for a security deposit of 75USD per room, this can be in cash or 
	  CC slip.<br>
	</p>
	<p>Our office is located on the first gate to the left on El Choco Road.  </p>
	<p>  Upon arrival you will recieve all controls and keys for the villa, when you come to the villa there will be a free water 5-gallon.
	  <br>
	  If you need any more come by the office with the empty one and for a small fee we will replace it for a full one.
	  <br>
	  There will also be an inventory list of what was there upon check-in from our staff, 
	  please go through this as you are responsible for any breakage in the villa during your stay. <br>
	  <br>
	 You will recieve a one time welcome package in the villa:</p>
	<ul>
	  <li>Coffee</li>
	  <li>Shampoo</li>
	  <li>Bodywash</li>
	  <li>Dish Soap</li>
	  <li>Sponge</li>
	</ul>
	<p>Residencial Casa Linda strives to create the best relaxed and enjoyable vacations for all of our clients.<br>
	  Therefore please respect our rules regarding parties and loud noices during your stay, more info will be give upon arrival.
	</p>
	<p>Daily housekeeping and pool service is included in your villa as well as Free shuttle bus from Sosua to Cabarete on a schedule.<br>
	  <br>
	  Don\'t miss out on our extra services we offer, airport pickup, excursions, car rental and more!<br>
	More info on our website!</p>
	<p>Best wishes,
	  The Casa Linda team!</p>
	<p>If you have any questions feel free to contact us.<br>
	  Residencial Casa Linda <br>
	  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
	  Tel: +1 809 571 1190 <br>
	  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
	  <a href=\"mailto:Frontdesk@casalindacity.com\">Frontdesk@casalindacity.com</a></p>
	<p><small><strong>Unless you have paid in full, remember that you will receive invoices as we are closing up to arrival date (as per cancellation rules). <br>
	Failure in doing this may result in a cancellation.
	This way you will be fully paid for a smoother check-in.</strong></small> <strong><br>
	<small><a href=\"http://www.casalindacity.com/Terms_and_conditions.php\" target=\"new\">Terms and Conditions </a></small></strong></p>
	</div>
	</body>
	</html>";
	return $body;
}
function email_body_referral($ref, $full_name, $general_amount, $villa_number,$qty_nights,$starting,$ending){
	$total_sin_impuestos=($general_amount/1.18);//RETURN QUANTITIES WITHOUT TAXES
	$impuestos=number_format(($total_sin_impuestos*0.18),2);
	$PAYMENT_DUE=number_format(($general_amount-$resArray['AMT']),2);
	$villa_number=$vd['no'];
	$general_amount=number_format($general_amount,2);
	$body="<!doctype html>
	<html>
	<head>
	<meta charset=\"utf-8\">
	<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
	<title>BOOKING RESERVATION-Residencial Casa Linda</title>
	<link href=\"http://www.casalindacity.com/bootstrap-3.3.2-dist/css/bootstrap.min.css\" rel=\"stylesheet\">
	</head>


	<body>
	<div class=\"container\">
	<p><img class=\"img-responsive\" src=\"http://www.casalindacity.com/bookingconfirmation.jpg\" alt=\"www.casalindacity.com\" title=\"www.casalindacity.com\" /></p>

	<p>&nbsp;</p>
	<p>Dear $full_name,</p>

	<p>Thank you for booking with Residencial Casa Linda,
	<p><strong>BOOKING RESERVATION: $ref.
	  
	  </strong>
	<p><strong>To stay in villa $villa_number for $qty_nights nights<br>
	  Check-In $starting		 Check-in time: 3.00 PM<br>
	  Check-Out
	</strong><strong> $ending
	  Check-out time: 12.00 Noon<br>
	  <br>
	  Price: $total_sin_impuestos USD
	  <br>
	  Taxes:
	  $impuestos USD<br>
	  Total price: $general_amount USD</p>
	
	<p><br><br></p>
	
	
	<p>Best wishes,
	  The Casa Linda team!</p>
	<p>If you have any questions feel free to contact us.<br>
	  Residencial Casa Linda <br>
	  <a href=\"www.CasaLindaCity.com\"> www.CasaLindaCity.com </a><br>
	  Tel: +1 809 571 1190 <br>
	  <a href=\"mailto:Reservations@casalindacity.com\">Reservations@casalindacity.com</a><br>
	  <a href=\"mailto:Frontdesk@casalindacity.com\">Frontdesk@casalindacity.com</a></p>
	
	</div>
	</body>
	</html>";
	return $body;
}

?>