<link type="text/css" href="../for_rent/datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script>
	/*$(function() {
		$( "#datepicker" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
		$( "#datepicker2" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
	});*/
	 <!--//
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	//-->
	</script>

	<?
	$data= new getQueries ();
	$referrals=$data->showTable_all($table='commission', $order='name');
	
	?>
<p class="header">RESERVACIONES PAGADAS</p>
<form method="post" action="">
	<p>
		<span style="margin-left:35px;">Referral:
			<select name="referral_showing" >
				<option value="0">See All</option>
				<?php
				foreach($referrals AS $k){
				?>
				<option value="<?=$k['id']?>"  <?php if($_POST['referral_showing']==$k['id']){?> selected="selected" <?php }?> ><?=$k['name']?> <?=$k['lastname']?></option>
				<?php
				}
				?>
			</select>
			From: <input id="from" type="text" name="start" value="<?=$_POST['start']?>" required="required"/>
			To:<input id="to" type="text" name="end" value="<?=$_POST['end']?>" required="required"/>
			<input class="book_but" type="submit" name="go" value="Go"/>
		</span>
	</p>
</form>

<?php
	if($_POST){
		$start_date=date('Y-m-d', strtotime($_POST['start'])); $end_date=date('Y-m-d', strtotime($_POST['end']));
		if($_POST['referral_showing']!=''){
			$_SESSION['REFERAL']['SHOWING']=$_POST['referral_showing'];
			//$bookings_found=$data->bookings_referral_status($referralid=$_SESSION['REFERAL']['SHOWING'], $status=2);
			$bookings_found=$data->bookings_referral_status_ft($referralid=$_SESSION['REFERAL']['SHOWING'], $status=2, $from=$start_date, $to=$end_date);
			
			/*echo "<pre>";
			print_r($bookings_found); exit();
			echo "</pre>";*/
			
			$total_records=$data->getAffectedRows();
			$_SESSION['COUNT']['QTY2']=$total_records;
		}

		if($_SESSION['COUNT']['QTY2']==''){/*only query all the fist time*/
				#$bookings_found=$data->bookings_referral_status($referralid=0, $status=2);//will show all is not post
				//$bookings_found=$data->bookings_referral_paid();
				#$total_records=$data->getAffectedRows();
				#$_SESSION['COUNT']['QTY2']=$total_records;
		}
			 
			 
		
		/*============================INFO TO GET PAGES START===============================================*/
		  $count=$_SESSION['COUNT']['QTY2'];
		  $items_pp=20;
		  if($_GET['pag']!=''){
			$current_page=$_GET['pag'];  
		  }else{
			$current_page=1;
		  }
	   
		  $paging_info = get_paging_info($count,$items_pp,$current_page);/*pages functions*/
		 /*============================INFO TO GET PAGES END===============================================*/	
		 #$bookings_found=$data->referral_commission_state_ft($id_referral=$_SESSION['REFERAL']['SHOWING'], $from_records=$paging_info['si'], $to_records=$items_pp, $status_comission=2, $from=$start_date, $to=$end_date);
		 //$bookings_found=$data->bookings_referral_unpaid();
			 #$bookings_found1=$data->referral_commission_state1_ft($id_referral=$_SESSION['REFERAL']['SHOWING'], $from_records=$paging_info['si'], $to_records=$items_pp, $status_comission=2, $from=$start_date, $to=$end_date);
			 /*
			 print_r($bookings_found1);
			 
			 print_r($bookings_found);
			 die();*/
			if($bookings_found1){
				foreach($bookings_found1 AS $b){
					array_push($bookings_found,$b);
				}
			}
			
			

			?>

		  <? if ($bookings_found){
			
			
		  ?>

			<p style="font-size:10px; padding-left:15px; color:blue;"><strong>Total comisiones pagadas: <?=$count?></strong> 
				
			</p>
			<hr />
			<table  align="center" cellpadding="2" cellspacing="2" border="0">

				<tr class="title">

					<td class='centro' id="td">
						BOOKING<br/> REFERENCE
					</td>
					<td class='centro' id="td">
						STATUS
					</td>
					<td class='centro' id="td">
						REFERAL
					</td>
					<td class='centro' id="td">
						CLIENT
					</td>
					<td class='centro' id="td">
						VILLA
					</td>
					<td class='centro' id="td">
						FROM
					</td>
					<td class='centro' id="td">
						TO
					</td>
					<td class='centro' id="td">
						TOTAL USD
					</td>
					<td class='centro' id="td">
						COMMISSION
					</td>
				</tr>
			<?php

			$x=0;
			$General_Totals=0;
			//echo "<pre>"; print_r($bookings_found); echo "</pre>";

			foreach ($bookings_found as $k){
				$comission_discounted_amount=$data->show_any_data_limit1("bookingreferred", "ref_book", $k['ref'], "=");
			?>

			<tr class='fila<?=$x;?>'  >

			   <td id='td' class='derecha'><?=$k['ref']?></td>
				   <?
				   switch ($k['status']){
					case 0:
						$status_result="<span style='color:red'>Cancelled</span>";
						break;
					case 1:
						$status_result="<span class='azul2'>Checked in - Short</span>";
						break;
					case 2:
						$status_result="<span class='azul2'>Confirmed - Short</span>";
						break;
					case 3:
						$status_result= "<span class='morado'>No Confirmed - Short </span>";
						break;
					case 4:
						$status_result= "<span class='outck'>Checked out - Short</span>";
						break;
					case 5:
						$status_result= "<span style='color:red'>Maintenance (out of service)</span>";
						break;
				   case 6:
						$status_result= "<span class='r_vip'>Checked in - VIP, Short</span>";
						break;
					case 7:
						$status_result= "<span class='r_owner'>Checked in - Owner, Short</span>";
						break;
					case 8:
						$status_result= "<span class='r_long'>Checked in - Long</span>";
						break;
					case 9:
						$status_result= "<span class='r_long'>Confirmed - Long</span>";
						break;
					case 10:
						$status_result= "<span class='r_long'>No Confirmed - Long</span>";
						break;
					case 11:
						$status_result= "<span class='r_long'>Checked Out - Long</span>";
						break;
					case 12:
						$status_result= "<span class='r_vip'>Confirmed - VIP, Short</span>";
						break;
					case 13:
						$status_result= "<span class='r_vip'>No Confirmed - VIP, Short</span>";
						break;
					case 14:
						$status_result= "<span class='r_vip'>Checked Out - VIP, Short</span>";
						break;
					case 15:
						$status_result= "<span class='r_vip'>Checked in - VIP, Long</span>";
						break;
					case 16:
						$status_result= "<span class='r_vip'>Confirmed - VIP, Long</span>";
						break;
					case 17:
						$status_result= "<span class='r_vip'>No Confirmed - VIP, Long</span>";
						break;
					case 18:
						$status_result= "<span class='r_vip'>Checked Out - VIP, Long</span>";
						break;
					case 19:
						$status_result= "<span class='r_long'>Confirmed - Owner, Short</span>";
						break;
					case 20:
						$status_result= "<span class='r_long'>No confirmed - Owner, Short</span>";
						break;
					case 21:
						$status_result= "<span class='r_long'>Checked Out - Owner, Short</span>";
						break;
					case 22:
						$status_result= "<span class='r_long'>Checked in - Owner, Long</span>";
						break;
					case 23:
						$status_result= "<span class='r_long'>Confirmed - Owner, Long</span>";
						break;
					case 24:
						$status_result= "<span class='r_long'>No confirmed - Owner, Long</span>";
						break;
					case 25:
						$status_result= "<span class='r_long'>Checked Out - Owner, Long</span>";
						break;
					default:
					   $status_result= "<span class='negro'><u>Unavailabe</u></span>";
						break;
				   }
				   ?>
			   <td id='td' class='derecha'><?=$status_result?></td>

			   <? $db= new getQueries ();
			   $referal_d=$db->show_id("commission", $k['id_referal']);
			   ?>
			   <td id='td' class='derecha'><? echo $referal_d[0]['name']." ".$referal_d[0]['lastname'];?> </td>

				 <? $db= new getQueries ();
			   $client_d=$db->show_id("customers", $k['client']);

			   ?>
				 <td id='td' class='derecha'><? echo  $client_d[0]['name']." ". $client_d[0]['lastname'];?></td>

				<? $db= new getQueries ();
			   $villa_d=$db->show_id("villas", $k['villa']);
			   /*$total_booking=$k['subtotal']-$k['itbis'];*/
				$total_booking=(($k['ppn']*$k['NLS'])+($k['PHS']*$k['NHS']));
				 if($k['status']==11){
					  //$total_booking=(($k['ppn']*$k['NLS'])+($k['PHS']*$k['NHS']));
					  $total_booking=($k['pl']*($k['pq']-1)+(($k['pl']/30)*$k['en']));
				  }
			   $General_Totals+=$total_booking;//sum this booking to total
			   ?>
				  <td id='td' class='derecha'><? echo  $villa_d[0]['no'];?></td>

				   <td id='td' class='derecha'><?=formatear_fecha($k['start']);?></td>
					<td id='td' class='derecha'><?=formatear_fecha($k['end']);?></td>

					  <!--//   codigo para promotion code//-->
						<?
							
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
									 }
							  }
					?>
					 <!--//   codigo para promotion code//-->
					<td id='td' class='derecha'><?=number_format(($total_booking-$descuento),2);?></td>
					<td id='td' class='derecha'><?
					if($k['status']==11){
						$percent_2_charge=(($referal_d[0]['long_percent']*100)-$comission_discounted_amount[0]['discounted']);
					}else{
						$percent_2_charge=(($referal_d[0]['percent']*100)-$comission_discounted_amount[0]['discounted']);
					}
					$percent_2_charge/=100;
					echo number_format((($total_booking-$descuento)*$percent_2_charge),2);
					
					?></td>
				 </tr>
			 <?
			 if ($x==0){$x++;} elseif ($x==1){$x--;}
			 $referal_id=$k['id_referal'];
			}
			//.utf8_encode($k['lastname'])
			?>

			</table>

		  <?
		  # numeros_de_paginas($paging_info,$max=7,'paid.php');
		  
		  
		  }else{
			   ?> 
			  <!--<p><span style="margin-left:35px;">Referral:
				<select name="referral_showing" onchange="window.location='paid.php?rs='+this.value">
					<option value="0">See All</option>
					<?php
					//foreach($referrals AS $k){
					?>
					<option value="<?=$k['id']?>"  <?php if($_SESSION['REFERAL']['SHOWING']==$k['id']){?> selected="selected" <?php }?> ><?=$k['name']?> <?=$k['lastname']?></option>
					<?php
					//}
					?>
				</select>
				</span>
				</p>-->
				<hr/>
			<?php	
			echo "<p style='text-align:center; color:red; font-size:16px;'>NO HAY RESERVAS PAGADAS.</p>";
		  }
	}	  
		  ?>

