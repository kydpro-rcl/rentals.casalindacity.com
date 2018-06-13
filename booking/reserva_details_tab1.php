<style>
#achanged a {
 color:#1d659f; text-decoration:none;
 }
 #achanged a:hover {
 color:red; text-decoration:underline;
 }
</style>
<?php
//require_once('inc/session.php');
  $id=$_GET['id'];
		if ($_SESSION['info']){
		 if($id){
			require_once('template/head.php');
			require_once('init.php');

			$db=new getQueries ();   //connect and make a query - Ej. get info from a ref number
			$busy=$db->see_occupancy_id($id);
		    $ocupabilidad=$busy[0];
			 $gente_reserva=$db->people($ocupabilidad['reserveid']);
			 $servicios_reserva=$db->services_reserved($ocupabilidad['reserveid']);
			 $excursiones_reserva=$db->excrusiones_reserved($ocupabilidad['reserveid']);
			 $villa_reserva=$db->villa($ocupabilidad['villa']);
			 $servicios_reserva_long=$db->services_reserved_long($ocupabilidad['reserveid']);
			 $payments_date=$db->payments_date($ocupabilidad['reserveid']); //get payments date per long rental

			//get information for referal
			$agent_comision=$db->showTable_r($table='bookingreferred', $field='ref_book', $value=$ocupabilidad['ref'], $operator='=');
		  
		  $montoTotalDevuelto=$db->amountRef($ocupabilidad['ref'],'2');/*payment refund*/
		  $montoTotalSeguridad=$db->amountRef($ocupabilidad['ref'],'3');/*security deposit*/
		  $montoTotalSDevuelto=$db->amountRef($ocupabilidad['ref'],'4');/*security refund*/
		  $montoTotalSTransferido=$db->amountRef($ocupabilidad['ref'],'5');/*Move to another booking*/
		 //===========================VERIFY INVOICES SENT TO CALL API AND SEE IS THEY ARE PAID============================================================= 
		  //$facturasEnviada=$db->show_data($table='ppinvoices', $condition="ref='".$ocupabilidad['ref']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
		  $comission_discounted_amount=$db->show_any_data_limit1("bookingreferred", "ref_book", $ocupabilidad['ref'], "=");
		  $this_disc=$db->show_any_data_limit1("discount", "reference", $ocupabilidad['ref'], "=");
			
		  $facturasEnviada=$db->invoicesUnpaid($ocupabilidad['ref']);
		 if($facturasEnviada){
			 //call API to ckeck sent and reminded.
			  require_once('invoiceAPI/InvoiceAPI.php');
			 foreach($facturasEnviada AS $k){
				 switch($k['status']){
					case 'Sent': 
						$invoiceDetails=getDetailsInvoice($k['invoiceID']); //call API to see if paid or other status of invoice
						if($invoiceDetails['responseEnvelope.ack']=='Success'){
							switch($invoiceDetails['invoiceDetails.status']){
								case 'Paid'://save payments and change status
									//save payment for booking
									savePayment($k['ref'], $k['amount'], $k['invoiceID']);
									//change status  TO BOOKING is no esta confirmado
									changeStatus($k['id'], $status='Paid');//invoice
									break;
								default: //change de status to any other status of details.
									changeStatus($k['id'], $status=$invoiceDetails['invoiceDetails.status']);
							}
						}
					break;
							
					case 'Reminded': 
						$invoiceDetails=getDetailsInvoice($k['invoiceID']); //call API to see if paid or other status of invoice
						if($invoiceDetails['responseEnvelope.ack']=='Success'){
							switch($invoiceDetails['invoiceDetails.status']){
								case 'Paid'://save payments and change status
									//save payment for booking
									savePayment($k['ref'], $k['amount'], $k['invoiceID']);
									//change status  TO BOOKING is no esta confirmado
									changeStatus($k['id'], $status='Paid');//invoice
									break;
								default: //change de status to any other status of details.
									changeStatus($k['id'], $status=$invoiceDetails['invoiceDetails.status']);
							}
						}
					break;
					case 'Paid': 
						//do nothing because it's paid
					break;
					default:
						$invoiceDetails=getDetailsInvoice($k['invoiceID']); //call API to see if paid or other status of invoice
						if($invoiceDetails['responseEnvelope.ack']=='Success'){
							switch($invoiceDetails['invoiceDetails.status']){
								case 'Paid'://save payments and change status
									//save payment for booking
									savePayment($k['ref'], $k['amount'], $k['invoiceID']);
									//change status  TO BOOKING is no esta confirmado
									changeStatus($k['id'], $status='Paid');//invoice
									break;
								default: //change de status to any other status of details.
									changeStatus($k['id'], $status=$invoiceDetails['invoiceDetails.status']);
							}
						}
				 }
			 }
			 
		 }
		 $montoTotalPagado=$db->amountRef($ocupabilidad['ref'],'1');/*paid after API has been called to check invoices paid*/
			?>
			<script type="text/javascript" src="js/confirm.js"></script>
			<table ><tr>
<td >

<b>Reference:</b> <a href="edit-booking.php?refnumb=<?=$ocupabilidad['ref'];?>" title="Change this booking" target="_blank"><u><?=$ocupabilidad['ref'];?></u></a> <b>Status:</b>
			  <?
			  	if($ocupabilidad['line']==3){ $apo="APOLLO - ";
				$apolloBook=true;
				}
		       switch ($ocupabilidad['status']){
		       	case 0:
		         	echo "<span style='color:red'>Cancelled</span>";
		         	$short=1;
			       	break;
		       	case 1:
				
		         	echo "<span class='azul2'>$apo Checked in - Short</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
			    case 2:
		         	echo "<span class='azul2'>$apo Confirmed - Short</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
			    case 3:
		         	echo "<span class='morado'>$apo No Confirmed - Short</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
				case 4:
		         	echo "<span class='outck'>$apo Checked out - Short</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
			    case 5:
		         	echo "<span style='color:red'>Maintenance (out of service)</span>";
		         	$maintenaced=1;
			       	break;
			   case 6:
		         	echo "<span class='r_vip'>Checked in - VIP, Short</span>";
		         	$short=1;
			       	break;
			    case 7:
		         	echo "<span class='r_owner'>Checked in - Owner, Short</span>";
		         	$owners_in_house=1;
			       	break;
			    case 8:
		         	echo "<span class='r_long'>Checked in - Long</span>";
		         	$long=1;
			       	break;
			    case 9:
		         	echo "<span class='r_long'>Confirmed - Long</span>";
		         	$long=1;
			       	break;
			 	case 10:
		         	echo "<span class='r_long'>No Confirmed - Long</span>";
		         	$long=1;
			       	break;
			    case 11:
		         	echo "<span class='r_long'>Checked Out - Long</span>";
		         	$long=1;
			       	break;
			 	case 12:
		         	echo "<span class='r_vip'>Confirmed - VIP, Short</span>";
		         	$short=1;
			       	break;
			    case 13:
		         	echo "<span class='r_vip'>No Confirmed - VIP, Short</span>";
		         	$short=1;
			       	break;
			 	case 14:
		         	echo "<span class='r_vip'>Checked Out - VIP, Short</span>";
		         	$short=1;
			       	break;
			    case 15:
		         	echo "<span class='r_vip'>Checked in - VIP, Long</span>";
		         	$long=1;
			       	break;
			 	case 16:
		         	echo "<span class='r_vip'>Confirmed - VIP, Long</span>";
		         	$long=1;
			       	break;
			    case 17:
		         	echo "<span class='r_vip'>No Confirmed - VIP, Long</span>";
		         	$long=1;
			       	break;
			 	case 18:
		         	echo "<span class='r_vip'>Checked Out - VIP, Long</span>";
		         	$long=1;
			       	break;
			    case 19:
		         	echo "<span class='r_long'>Confirmed - Owner, Short</span>";
		         	$short=1;
			       	break;
			 	case 20:
		         	echo "<span class='r_long'>No confirmed - Owner, Short</span>";
		         	$short=1;
			       	break;
			    case 21:
		         	echo "<span class='r_long'>Checked Out - Owner, Short</span>";
		         	$short=1;
			       	break;
			 	case 22:
		         	echo "<span class='r_long'>Checked in - Owner, Long</span>";
		         	$long=1;
			       	break;
			    case 23:
		         	echo "<span class='r_long'>Confirmed - Owner, Long</span>";
		         	$long=1;
			       	break;
			 	case 24:
		         	echo "<span class='r_long'>No confirmed - Owner, Long</span>";
		         	$long=1;
			       	break;
			    case 25:
		         	echo "<span class='r_long'>Checked Out - Owner, Long</span>";
		         	$long=1;
			       	break;
			    case 26:
		         	echo "<span class='r_long'>Checked in - Buyer  Long</span>";
		         	$buyer=1;
			       	break;
			    case 27:
		         	echo "<span class='r_long'>No Confirmed -Buyer  Long</span>";
		         	$buyer=1;
			       	break;
			 	case 28:
		         	echo "<span class='r_long'>Confirmed - Buyer  Long</span>";
		         	$buyer=1;
			       	break;
			    case 29:
		         	echo "<span class='r_long'>Checked Out - Buyer  Long</span>";
		         	$buyer=1;
			       	break;
				 case 30:
		         	echo "<span class='r_long'>Checked in - Buyer Short</span>";
		         	$buyer=1;
			       	break;
			    case 31:
		         	echo "<span class='r_long'>No Confirmed -Buyer Short</span>";
		         	$buyer=1;
			       	break;
			 	case 32:
		         	echo "<span class='r_long'>Confirmed - Buyer Short</span>";
		         	$buyer=1;
			       	break;
			    case 33:
		         	echo "<span class='r_long'>Checked Out - Buyer Short</span>";
		         	$buyer=1;
			       	break;
				case 34:
		         	echo "<span class='r_long'>Mid term - checked in</span>";
		         	$mid=1;
			       	break;
				case 35:
		         	echo "<span class='r_long'>Mid term - No confirmed</span>";
		         	$mid=1;
			       	break;
				case 36:
		         	echo "<span class='r_long'>Mid term - Confirmed</span>";
		         	$mid=1;
			       	break;
				case 37:
		         	echo "<span class='r_long'>Mid term - Check out</span>";
		         	$mid=1;
			       	break;
				case 38:
		         	echo "<span class='azul2'>Try and Buy - Check in</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
			    case 39:
		         	echo "<span class='azul2'>Try and Buy - No confirmed</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
			    case 40:
		         	echo "<span class='morado'>Try and Buy - Confirmed</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
				case 41:
		         	echo "<span class='outck'>Try and Buy - Check out</span>";
		         	if($apolloBook!=true) $short=1;
			       	break;
		       	default:
			       	echo "<span class='negro'><u>Unavailabe</u></span>";
			      // 	break;
		       }

		      if ($ocupabilidad['dep']>0){ echo " <strong>Paid:</strong> <span class='azul2'>".$ocupabilidad['dep']." USD</span>";}
				$montoTotalPagado+=$ocupabilidad['dep'];
		      # $short
			  ?> 
			  
			  </td>
			  <td>
			 
</td>
</tr></table>
<!-- End payment button -->
				<?
				if($apolloBook==true){
					//echo 'Apollo';
					
					        //BELOW PICK UP THE EVENT ON THE BOOKING APPLIED
			  	//$evento_found=$db->show_any_data_limit1("events_saved", "ref", $ocupabilidad['ref'], "=");
			  	?>

			  	  <!--//   codigo para promotion code//-->
					<?
					$TotalNoches=$ocupabilidad['NLS']+$ocupabilidad['NHS'];
		                //$this_disc=$db->show_any_data_limit1("discount", "reference", $ocupabilidad['ref'], "=");
		                $disc_found=$this_disc[0];
			              if ($disc_found){
			              	//print_r($disc_found);
			                    //hacer calculos
			                    $amount_nightsLS=($ocupabilidad['NLS']*$ocupabilidad['ppn']);
			                    $amount_nightsHS=($ocupabilidad['NHS']*$ocupabilidad['PHS']);
			                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

			                     if  ($disc_found['pro_type']=="2"){   //Amount
			                           $descuento=($disc_found['pro_qty']);
			                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
			                           $tipo_desc="monto";
			                           $promotion_code=$disc_found['pro_code'];

			                     }elseif($disc_found['pro_type']=="1"){ //percent
			                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="porcient";
			                         $promotion_code=$disc_found['pro_code'];
			                     }elseif($disc_found['pro_type']=="3"){ //days
			                       // $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                       //  $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="days";
			                         $promotion_code=$disc_found['pro_code'];

			                         if ($ocupabilidad['NLS']!=0 &&  $ocupabilidad['NHS']==0){//solo low season
			                           $descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                        }

			                        if (($ocupabilidad['NLS']==0)&&( $ocupabilidad['NHS']!=0)){//solo High season
			                           $descuento=$ocupabilidad['PHS']*$disc_found['qty_days'];
			                        }

			                        if ($ocupabilidad['NLS']!=0 &&   $ocupabilidad['NHS']!=0){//ambas season
			                          if($ocupabilidad['NLS']>=$disc_found['qty_days']){
			                         	$descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                          }else{
			                          	$descuento=$ocupabilidad['ppn']*$ocupabilidad['NLS'];
			                          	$descuento+=$ocupabilidad['PHS']*($disc_found['qty_days']-$ocupabilidad['NLS']);
			                          }
		                       		}

		                       		$variable_descuento=$disc_found['qty_days']." Nights";
			                     }

			              }
					?>
					<!--//   codigo para promotion code//-->
			       <div class="money_box" style="margin-left:5px;">CURRENCY<hr /><?/* print_r($disc_found);*/?>
				     <? if($evento_found[0]){/* if special event was found do this*/?>
				   		<p style="text-align:right;"><span style="color:red;">Special Event:<strong><u><?=$evento_found[0]['name']?></u></strong><br/>
		                  <?=$evento_found[0]['qty']?> <?

		                  switch($evento_found[0]['type']){
		                   case 1: echo '%'; break;
		                   case 2: echo 'USD'; break;
		                  }

		                  ?>
		                  <?

		                  switch($evento_found[0]['increase']){
		                   case 1: echo 'increased'; break;
		                   case 2: echo 'decreased'; break;
		                  }
		                  ?> per nights
		                  </span>
		               </p>
					 <?}?>

			         <? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['NLS'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['NLS']*$ocupabilidad['ppn']),2);?> </p>
			         	<p id="left"><? echo $ocupabilidad['NHS'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['NHS']*$ocupabilidad['PHS']),2);?> </p>
			          <? }?>

			           <? if (($ocupabilidad['NHS']==0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['ppn']),2);?> </p>
			          <? }?>

					<? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']==0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['PHS']),2);?> </p>
			          <? }?>
				            <!--//codigo promotion//-->
		                     <?
		                     $LS_monto=$ocupabilidad['NLS']*$ocupabilidad['ppn'];
		                     $HS_monto=$ocupabilidad['NHS']*$ocupabilidad['PHS'];
		                     ?>
						    <? if (($descuento>0)&&($tipo_desc=="monto")){?>

						    <p id="left" style="text-align:right; color:green;">
						    	(<?=$promotion_code?>)	Discount =
						    		<? echo "US$ ".number_format($descuento,2); ?>
						    </p>
						    <?}?>
						    <? if (($descuento>0)&&($tipo_desc=="porcient")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						     <? if (($descuento>0)&&($tipo_desc=="days")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?> Discount of <?=$ocupabilidad['NLS']+$ocupabilidad['NHS']?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						    <? if ($descuento>0){?>
		                   <P id="left" style="font-weight:bold; color:green;">Amount after discount = USD <? echo number_format(($LS_monto+$HS_monto)-$descuento,2);?></p>
		                   <?}?>
					     <!--//fin codigo promotion//-->
					     <?
					      if (!empty($servicios_reserva)){
								$total_services2=0; $total_carros=0;
								foreach ($servicios_reserva as $s){
		                          $total_services2+=$s['price'];
		                          if($s['type']=="Car_Rental"){
                                   $carros_viejo=true;/*para saber si hay carros de antes y sumar al total*/
                                   $total_carros+=$s['price'];
				                  }
								}
							 }
					     ?>

					     <?
					      if (!empty($excursiones_reserva)){
							$total_excursion=0;
			                 foreach ($excursiones_reserva as $k){
			                 //echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
			                 $total_excursion+=$k['total'];

			                 }
			               //   echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
						  }


                          if($carros_viejo==true){
                            $sub_total=$ocupabilidad['total']-$ocupabilidad['itbis']-$total_services2-$total_excursion+$total_carros;
                          }else{
                          	$sub_total=$ocupabilidad['total']-$ocupabilidad['itbis']-$total_services2-$total_excursion;
                          }
					     ?>

			         <P id="left"><strong>Sub-Total = USD <? echo number_format($sub_total,2);?></strong></p>
			      <?
			        if (!empty($servicios_reserva)){
						$total_services=0;  $total_carros=0;
						foreach ($servicios_reserva as $s){
					   // echo $s['price']." ";
						   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
							echo "<P id='right_blue'>".$s['name']." = ".$s['price']."</p>"; $total_services+=$s['price'];
						   }elseif($s['type']=="Car_Rental"){
		                    echo "<P id='right_blue'>".substr($s['name'],0,15)." (".$s['qty']." days)= ".$s['price']."</p>"; $total_services+=$s['price'];
		                    $carros_viejo=true;/*para saber si hay carros de antes y sumar al total*/
		                    $total_carros+=$s['price']; /*para extrar el 18 pociendo a los carros viejos*/
						   }else{
							echo "<P id='right_blue'>".ucfirst($s['type'])." ( ".substr($s['name'],0,15).")= ".$s['price']."</p>"; $total_services+=$s['price'];
						   }

						}
			  		 echo "<P id='right_blue'><strong>Total per Services = USD ".number_format($total_services,2)."</strong></p>";
					 }
					 $grand_total=($ocupabilidad['subtotal']+$total_services);
					 ?>

					 <?
					 //------------start showing excursions---------------------------------
					/* echo '<pre>';
					 print_r($excursiones_reserva);
					 echo '</pre>'; */
					  if (!empty($excursiones_reserva)){
						$total_excursion=0;
		                 foreach ($excursiones_reserva as $k){
		                 echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
		                 $total_excursion+=$k['total'];
		                 }
		                  echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
					  }
					 ?>
					 <?
					  /* if($carros_viejo==true){
					   	$ocupabilidad['itbis']+=$total_carros*0.18;
					   }*/
					  /*if((strtotime($ocupabilidad['date']))<(strtotime(TAX_FECHA))){?>
                      <p id="left"><?=TAX_PER_OLD?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.16),2);?></p>
					 <?}else{?>
					  <p id="left"><?=TAX_PERCENT?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.18),2);?></p>
					 <?}*/?>

					 <?
					 echo "<hr />";
					  $carros_rentados=$db->showTable_r($table='cars_rented', $field='ref', $value=$ocupabilidad['ref'], $operator='=');

					   if($carros_viejo==true){
					   	$ocupabilidad['total']+=$total_carros+($total_carros*0.18);
					   }
					   $reference=$ocupabilidad['ref'];
					 ?>
						<P id='left'><strong>TOTAL <? if($carros_rentados){ echo "WITHOUT CARS"; } ?>= USD <?=number_format($TotalGral=$itebis_var+$sub_total+$total_services2+$total_excursion,2);?></strong></p>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Total Paid =  <?=number_format($montoTotalPagado,2);?></a></span></p>
						
						<? $totaldue=$TotalGral-$montoTotalPagado+$montoTotalDevuelto;
						
						if($totaldue>0){ $colordeuda="blue";}elseif($totaldue==0){ $colordeuda="green"; }else{ $colordeuda="red";} 
						?>
						<P id='left' style="color:<?=$colordeuda?>; font-weight:bold;">Balance due = <?=number_format($TotalGral-$montoTotalPagado+$montoTotalDevuelto,2);?></p>
						
						<? if($montoTotalDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Payment Refund = <?=number_format($montoTotalDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSeguridad>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security deposit = <?=number_format($montoTotalSeguridad,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security Refund = <?=number_format($montoTotalSDevuelto,2);?></a></span></p>
						<?}?>
						
						<? $v=$villa_reserva[0];?>
						<p style="text-align:right;">ACCOUNTING INFO<br/>
						Accounting fee <!--13.85/week-->=<? echo $AccFee=number_format(((13.85/7)*$TotalNoches),2);?><br/>
						Adm fee <!--5.77/week-->=<? echo $AdmFee=number_format(((5.77/7)*$TotalNoches),2);?><br/>
						Internet <!--6.92/week-->=<? echo $IntFee=number_format(((6.92/7)*$TotalNoches),2);?><br/>
						Gas <!--5.77/week-->=<? echo $GasFee=number_format(((5.77/7)*$TotalNoches),2);?><br/>
						Water <!--5.77/week-->=<? echo $WatFee=number_format(((5.77/7)*$TotalNoches),2);?><br/>
						Pool/garden <!--villa info *12/52-->=<? $poolService=(($v['p_out_clear']*12)/52); echo $PooFee=number_format((($poolService/7)*$TotalNoches),2);?><br/>
						Maid <!--as above-->=<? $maidService=(($v['p_in_clear']*12)/52);  echo $MaidFee=number_format((($maidService/7)*$TotalNoches),2);?><br/>
						Maintenance <!--66.92/week-->=<? echo $MaiFee=number_format(((66.92/7)*$TotalNoches),2);?><br/>
						<!--electr. 2 bdr  159.23/week=<br/>-->
						Electr. <!--3 bdr 182.30 / week-->=<? if($v['bed']==2){ $EleFee=number_format(((159.23/7)*$TotalNoches),2);}else{$EleFee=number_format(((182.30/7)*$TotalNoches),2);} echo $EleFee; ?><br/>
						<span style="text-decoration:underline;">TOTAL SERVICES AND FEES=<? 
						$amtSF=$AccFee+$AdmFee+$IntFee+$GasFee+$WatFee+$PooFee+$MaidFee+$MaiFee+$EleFee;
						echo number_format($amtSF,2); ?></span><br/>
						VILLA AMOUNT= <? $amtVilla=$TotalGral-$amtSF; echo  number_format($amtVilla,2); ?><br/>
						15% commission RCL= <? $amtCom=$amtVilla*0.15; echo number_format($amtCom,2); ?><br/>
						Amount to owner = <? $amtOwe=$amtVilla-$amtCom; echo number_format($amtOwe,2); ?></p>
			       </div>
			       <div class="villa_box">
			      VILLA AND RESERVATION DETAILS<hr/>
			       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
			       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
			       <p><b>Villa No.</b>  <?=$v['no'];?></p>
			       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
			       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
			      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

			      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
			       </div>
				   <?
				}
				
				?>
				

				
				
			  <? if (($short==1)||($maintenaced==1)||($owners_in_house)){ //DO THIS ONLY IF SHORT TERM  OR MAINTENANCE OR SHORT TERM OWNER
		         //BELOW PICK UP THE EVENT ON THE BOOKING APPLIED
			  	$evento_found=$db->show_any_data_limit1("events_saved", "ref", $ocupabilidad['ref'], "=");
			  	?>

			  	  <!--//   codigo para promotion code//-->
					<?
		                $this_disc=$db->show_any_data_limit1("discount", "reference", $ocupabilidad['ref'], "=");
		                $disc_found=$this_disc[0];
			              if ($disc_found['new']!=1){
			              	//print_r($disc_found);
			                    //hacer calculos
			                    $amount_nightsLS=($ocupabilidad['NLS']*$ocupabilidad['ppn']);
			                    $amount_nightsHS=($ocupabilidad['NHS']*$ocupabilidad['PHS']);
			                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

			                     if  ($disc_found['pro_type']=="2"){   //Amount
			                           $descuento=($disc_found['pro_qty']);
			                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
			                           $tipo_desc="monto";
			                           $promotion_code=$disc_found['pro_code'];

			                     }elseif($disc_found['pro_type']=="1"){ //percent
			                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="porcient";
			                         $promotion_code=$disc_found['pro_code'];
			                     }elseif($disc_found['pro_type']=="3"){ //days
			                       // $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                       //  $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="days";
			                         $promotion_code=$disc_found['pro_code'];

			                         if ($ocupabilidad['NLS']!=0 &&  $ocupabilidad['NHS']==0){//solo low season
			                           $descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                        }

			                        if (($ocupabilidad['NLS']==0)&&( $ocupabilidad['NHS']!=0)){//solo High season
			                           $descuento=$ocupabilidad['PHS']*$disc_found['qty_days'];
			                        }

			                        if ($ocupabilidad['NLS']!=0 &&   $ocupabilidad['NHS']!=0){//ambas season
			                          if($ocupabilidad['NLS']>=$disc_found['qty_days']){
			                         	$descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                          }else{
			                          	$descuento=$ocupabilidad['ppn']*$ocupabilidad['NLS'];
			                          	$descuento+=$ocupabilidad['PHS']*($disc_found['qty_days']-$ocupabilidad['NLS']);
			                          }
		                       		}
		                       		$variable_descuento=$disc_found['qty_days']." Nights";
			                     }
			              }
					?>
					<!--//   codigo para promotion code//-->
			       <div class="money_box" style="margin-left:5px;">CURRENCY<hr /><?/* print_r($disc_found);*/?>
				     <? if($evento_found[0]){/* if special event was found do this*/?>
				   		<p style="text-align:right;"><span style="color:red;">Special Event:<strong><u><?=$evento_found[0]['name']?></u></strong><br/>
		                  <?=$evento_found[0]['qty']?> <?

		                  switch($evento_found[0]['type']){
		                   case 1: echo '%'; break;
		                   case 2: echo 'USD'; break;
		                  }

		                  ?>
		                  <?

		                  switch($evento_found[0]['increase']){
		                   case 1: echo 'increased'; break;
		                   case 2: echo 'decreased'; break;
		                  }
		                  ?> per nights
		                  </span>
		               </p>
					 <?}?>

			         <? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['NLS'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['NLS']*$ocupabilidad['ppn']),2);?> </p>
			         	<p id="left"><? echo $ocupabilidad['NHS'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['NHS']*$ocupabilidad['PHS']),2);?> </p>
			          <? }?>

			           <? if (($ocupabilidad['NHS']==0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['ppn']),2);?> </p>
			          <? }?>

					<? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']==0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['PHS']),2);?> </p>


			          <? }?>
				            <!--//codigo promotion//-->
		                     <?
		                     $LS_monto=$ocupabilidad['NLS']*$ocupabilidad['ppn'];
		                     $HS_monto=$ocupabilidad['NHS']*$ocupabilidad['PHS'];
		                     ?>
						    <? if (($descuento>0)&&($tipo_desc=="monto")){?>

						    <p id="left" style="text-align:right; color:green;">
						    	(<?=$promotion_code?>)	Discount =
						    		<? echo "US$ ".number_format($descuento,2); ?>
						    </p>
						    <?}?>
						    <? if (($descuento>0)&&($tipo_desc=="porcient")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						     <? if (($descuento>0)&&($tipo_desc=="days")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?> Discount of <?=$ocupabilidad['NLS']+$ocupabilidad['NHS']?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						    <? if ($descuento>0){?>
		                   <P id="left" style="font-weight:bold; color:green;">Amount after discount = USD <? echo number_format(($LS_monto+$HS_monto)-$descuento,2);?></p>
		                   <?}?>
					     <!--//fin codigo promotion//-->
					     <?
					      if (!empty($servicios_reserva)){
								$total_services2=0; $total_carros=0;
								foreach ($servicios_reserva as $s){
		                          $total_services2+=$s['price'];
		                          if($s['type']=="Car_Rental"){
                                   $carros_viejo=true;/*para saber si hay carros de antes y sumar al total*/
                                   $total_carros+=$s['price'];
				                  }
								}
							 }
					     ?>

					     <?
					      if (!empty($excursiones_reserva)){
							$total_excursion=0;
			                 foreach ($excursiones_reserva as $k){
			                 //echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
			                 $total_excursion+=$k['total'];

			                 }
			               //   echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
						  }


                          if($carros_viejo==true){
                            $sub_total=($LS_monto+$HS_monto)-$total_services2-$total_excursion+$total_carros;
                          }else{
                          	$sub_total=($LS_monto+$HS_monto)-$total_excursion;
                          }
						  
						if($comission_discounted_amount[0]['discounted']>0){
						  $monto_por_villa=(($LS_monto+$HS_monto)-$descuento);
						  
						  $comisiont_amount_discounted=$monto_por_villa*($comission_discounted_amount[0]['discounted']/100);
					     ?>
							<P id="left"><strong><span style="color:green;">Comission discount (<?=$comission_discounted_amount[0]['discounted'];?> %)= USD <? echo number_format($comisiont_amount_discounted,2);?></span></strong></p>
						<?php
						 }
						 
						 
						 
					if($this_disc[0]['discounted']!=''){
					 
						//$this_disc[0]['discounted']-=$this_disc[0]['discounted']*(15.254/100);
						//$this_disc[0]['discounted']-=5.4;
						//$sub_total-=$this_disc[0]['discounted'];
						//$sub_total=number_format($sub_total,0);
						$discount_no_taxes=$this_disc[0]['discounted']-($this_disc[0]['discounted']*(15.254/100));
						$sub_total-=$discount_no_taxes;
						
					 ?>
					 
					 <p id="left"><strong>Discount (<?=$this_disc[0]['pro_code']?>)</strong>= USD <? echo number_format(($discount_no_taxes),2);?></p>
					 
					 <?php
					 }
					 
					 $sub_total-=$comisiont_amount_discounted;
						?> 
					
					
			         <P id="left"><strong>Sub-Total = USD <? echo number_format($sub_total,2);?></strong></p>
			      <?
			        if (!empty($servicios_reserva)){
						$total_services=0;  $total_carros=0;
						foreach ($servicios_reserva as $s){
					   // echo $s['price']." ";
						  /* if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
							echo "<P id='right_blue'>".$s['name']." = ".$s['price']."</p>"; $total_services+=$s['price'];
						   }elseif($s['type']=="Car_Rental"){
		                    echo "<P id='right_blue'>".substr($s['name'],0,15)." (".$s['qty']." days)= ".$s['price']."</p>"; $total_services+=$s['price'];
		                    $carros_viejo=true;//para saber si hay carros de antes y sumar al total
		                    $total_carros+=$s['price']; //para extrar el 18 pociendo a los carros viejos
						   }else{
							echo "<P id='right_blue'>".ucfirst($s['type'])." ( ".substr($s['name'],0,15).")= ".$s['price']."</p>"; $total_services+=$s['price'];
						   }*/
						   
						   echo "<P id='right_blue'>".substr($s['comment'],0,15)." (".$s['qty']." x ".$s['unit'].")";
						   if($s['tax']>0){
							   echo " + Tax";
						   }
						   echo "= ".$s['price']."</p>"; $total_services+=$s['price'];

						}
			  		 echo "<P id='right_blue'><strong>Total per Services = USD ".number_format($total_services,2)."</strong></p>";
					 }
					 $grand_total=($ocupabilidad['subtotal']+$total_services);
					 ?>

					 <?
					 //------------start showing excursions---------------------------------
					/* echo '<pre>';
					 print_r($excursiones_reserva);
					 echo '</pre>'; */
					  if (!empty($excursiones_reserva)){
						$total_excursion=0;
		                 foreach ($excursiones_reserva as $k){
		                 echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
		                 $total_excursion+=$k['total'];
		                 }
		                  echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
					  }
					
					 
					   if($carros_viejo==true){
					   	$ocupabilidad['itbis']+=$total_carros*0.18;
					   }
					  if((strtotime($ocupabilidad['date']))<(strtotime(TAX_FECHA))){/* si la fecha creada fue menor al 1 de enero 2013 solo aplica 16%*/?>
                      <p id="left"><?=TAX_PER_OLD?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.16),2);?></p>
					 <?}else{?>
					  <p id="left"><?=TAX_PERCENT?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.18),2);?></p>
					 <?}?>

					 <?
					 echo "<hr />";
					  $carros_rentados=$db->showTable_r($table='cars_rented', $field='ref', $value=$ocupabilidad['ref'], $operator='=');

					   if($carros_viejo==true){
					   	$ocupabilidad['total']+=$total_carros+($total_carros*0.18);
					   }
					   $reference=$ocupabilidad['ref'];
					 ?>
					 <p><?php /*=$total_services*/?></p>
						<P id='left'><strong>TOTAL <? if($carros_rentados){ echo "WITHOUT CARS"; } ?>= USD <?=number_format($TotalGral=$itebis_var+$sub_total+$total_services2+$total_excursion,2);?></strong></p>
						
						
						<?php if(($ocupabilidad['status']==38)||($ocupabilidad['status']==39)||($ocupabilidad['status']==40)||($ocupabilidad['status']==41)){
							$traynbuyinfo=$db->tbuy($ref=$reference);
							
							?>
						
							<P id='left' style="color:red;"><strong>TRY AND BUY CLIENT = USD <?=number_format($traynbuyinfo['total'],2);?></strong></p>
							<P id='left' style="color:green;"><strong>NEGUEN = USD <?=number_format($TotalGral-$traynbuyinfo['total'],2);?></strong></p>
						<?php }?>
						
						
						
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Total Paid =  <?=number_format($montoTotalPagado,2);?></a></span></p>
						
						<? $totaldue=$TotalGral-$montoTotalPagado+$montoTotalDevuelto;
						
						//========================CALL API TO CANCEL INVOICES PENDING UNPAID IF BOOKING IS CHECK OUT OR DUE AMOUN IS 1 DOLLAR========================
						if(($totaldue<=1)||($ocupabilidad['status']==4)||($ocupabilidad['status']==0)){
							$facturasUnpaid=$db->invoicesUnpaid($ocupabilidad['ref']);/*INVOICES UNPAID FOR THIS BOOKING*/
							if($facturasUnpaid){
								 //call API to ckeck sent and reminded.
								 require_once('invoiceAPI/InvoiceAPI.php');
								 foreach($facturasUnpaid AS $k){
									$resultado=cancelInvoice($invoiceId=$k['invoiceID']);
									if($resultado['responseEnvelope.ack']=='Success'){/*si tubo exito al cancelar la factura*/
										$invoice_info=getDetailsInvoice($invoiceId=$k['invoiceID']);
										$db=new getQueries (); 
										$facturasEnviada=$db->show_data($table='ppinvoices', $condition="invoiceID='".$k['invoiceID']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
										changeStatus($facturasEnviada[0]['id'], $status=$invoice_info['invoiceDetails.status']);
									}
								 }
							}
						}
						//========================END CALL API TO CANCEL INVOICES PENDING UNPAID IF BOOKING IS CHECK OUT OR DUE AMOUN IS 1 DOLLAR========================
						if($totaldue>0){ $colordeuda="blue";}elseif($totaldue==0){ $colordeuda="green"; }else{ $colordeuda="red";} 
						?>
						<P id='left' style="color:<?=$colordeuda?>; font-weight:bold;">Balance due = <?=number_format($TotalGral-$montoTotalPagado+$montoTotalDevuelto+$montoTotalSTransferido,2);?></p>
						
						<? if($montoTotalDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Payment Refund = <?=number_format($montoTotalDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSeguridad>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security deposit = <?=number_format($montoTotalSeguridad,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security Refund = <?=number_format($montoTotalSDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSTransferido>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Transferred to booking = <?=number_format($montoTotalSTransferido,2);?></a></span></p>
						<?}?>
						<? 
		  
						if($agent_comision[0]){
						// print_r($agent_comision[0]);
                         $agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
                         echo "<br/>";
                         echo "<strong>AGENT:</strong> <u>"; echo $agent[0]['name']." ".$agent[0]['lastname'];
                         //print_r($agent);
                         echo "</u><br/>";
						 
						 $monto_por_villa=(($LS_monto+$HS_monto)-$discount_no_taxes);
						 
						 //$percent_discounted=((100*$comission_discounted_amount[0]['discounted'])/$monto_por_villa);
						 $percent_discounted=$comission_discounted_amount[0]['discounted'];
						 $agent_percent=($agent[0]['percent']*100);
						 
						 
                         echo "<strong>(".($agent_percent-$percent_discounted)." % ) of  ";
                         
                         echo number_format($monto_por_villa,2);
						 
							$agent_percent_this_booking=$agent_percent-$percent_discounted;
							
                         echo " = <span style='color:red;' >US$ ";
                         echo  number_format(($monto_por_villa*($agent_percent_this_booking/100)),2);
                         echo "</span></strong>";

                         switch($agent_comision[0]['paid']){
                         	case 0: //pending to pay
                         		    echo " <span style='color:blue;' >(Pending to Pay)</span>";
                         	      break;
                         	case 1: //ready to pickup
                         			 echo " <span style='color:#c96207;' >(Ready to Pickup)</span>";
                         	      break;
                         	case 2: //Paid
                         			 echo " <span style='color:green;' >(Already Paid)</span>";
                         	      break;
                         }
						}
						?>

						<?

						/*print_r($carros);*/
						if($carros_rentados){
							?>
							<p>&nbsp;</p>
							<?
							$gral_cars=0;
							$taxes_cars=0;
							foreach($carros_rentados AS $k){
							 $this_car=$db->show_any_data_limit1("carros", "id", $k['id_car'], "=");
							$total_this_car=$k['qty_days']*$k['price']; $gral_cars+=$total_this_car; $taxes_cars+=$k['taxes'];
						   ?>
						   <p style="text-align:right; padding:0px; margin:0px; color:blue;">
						       <?=substr($this_car[0]['name'], 0, 25);?> <?=$k['qty_days']?>  x  <?=$k['price']?> = <?=number_format($total_this_car,2);?>
						   </p>
						   <?}
                             ?>
                            <p  style="text-align:right; padding:0px; margin:0px; font-weight:bold; color:blue; font-weight:bold; text-transform:uppercase;">To be paid upon arrival: USD <?=number_format($gral_cars+$taxes_cars,2);?></p>
                             <?
						}
						?>
			       </div>
			       <div class="villa_box"><? $v=$villa_reserva[0];?>
			      VILLA AND RESERVATION DETAILS<hr/>
			       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
			       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
			       <p><b>Villa No.</b>  <?=$v['no'];?></p>
			       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
			       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
			      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

			      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
			       </div>
		      <?}  ?>

		        <? if ($long==1){ //DO THIS ONLY IF LONG TERM
			  	?>
		           <div class="money_box" style="width:300px; margin-left:5px;">
		           <h4 style="margin:0px; padding:0px; margin-top:0px; margin-bottom:0px; font-size:11px;">PAYMENTS INFORMATION</h4>
		           <hr style="margin:0px; padding:0px; width:100%" />
		                <? if ($ocupabilidad['EN']>0){ $pagos_enteros=($ocupabilidad['PAYM']-1);}else{$pagos_enteros=$ocupabilidad['PAYM'];}?>

		                <?  /* verificar si hay noches extras y no hay pagos mensuales para aplicar tarifa mensual*/
		                if (($ocupabilidad['EN']>0)&&($pagos_enteros==0)){
                         // $pagos_enteros=1; $ocupabilidad['EN']=0;
		                }

		                ?>
			         	<p id="left" style="margin-top:0px; padding-top:0px;"><? echo $pagos_enteros;?> Monthly payments <b><? echo number_format($ocupabilidad['PMV'],2);?></b> = USD <? echo number_format(($pagos_enteros*$ocupabilidad['PMV']),2);?> </p>
		               <p id="left"><? echo $ocupabilidad['EN'];?> Extra nights x <b><? echo $ocupabilidad['ppn'];?></b> = USD <? echo number_format(($ocupabilidad['EN']*$ocupabilidad['ppn']),2);?> </p>

			         <?

					 echo "<hr />";
					 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($ocupabilidad['total'],2)."</strong></p>"; ?>
					 
					 <P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Total Paid =  <?=number_format($montoTotalPagado,2);?></a></span></p>
						
						<? 
						$TotalGral=$ocupabilidad['total'];
						$totaldue=$TotalGral-$montoTotalPagado+$montoTotalDevuelto;
						
						if($totaldue>0){ $colordeuda="blue";}elseif($totaldue==0){ $colordeuda="green"; }else{ $colordeuda="red";} 
						?>
						<P id='left' style="color:<?=$colordeuda?>; font-weight:bold;">Balance due = <?=number_format($TotalGral-$montoTotalPagado+$montoTotalDevuelto,2);?></p>
						
						<? if($montoTotalDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Payment Refund = <?=number_format($montoTotalDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSeguridad>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Security deposit = <?=number_format($montoTotalSeguridad,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Security Refund = <?=number_format($montoTotalSDevuelto,2);?></a></span></p>
						<?}?>
					 
					 
		             <span style="color:blue;"><u>First Payment on</u>: <b><?=formatear_fecha($ocupabilidad['start'])?></b> <!--//(See all)//--></span><br/>
		             <span style="font-size:10px; color:red;">NOTE: Electricity + Gas is charged monthly per consumption</span>
		            <p style="color: white; line-height:normal; font-weight:bold; text-align:center; margin-top:0px; margin-bottom:0px; background-color:#09F;">MORE DETAILS</P>
		              <?

		              if ($servicios_reserva_long){
						$total_services=0;
						foreach ($servicios_reserva_long as $sl){
					   // echo $s['price']." ";

							echo "<P id='right_blue'>".ucfirst($sl['name'])."= ".$sl['price']."</p>"; $total_services+=$sl['price'];
						}
			  		 echo "<P id='right_blue'><strong>Total Monthly per Services = USD ".number_format($total_services,2)."</strong></p>";
					 }
					 $grand_total=($ocupabilidad['subtotal']+$total_services);
			       ?>
			       <p style="line-height:normal; font-weight:bold; text-align:right; margin-top:0px;">Monthly price per villa <?=number_format($ocupabilidad['PL'],2)?></p>

                   	<?
						if($agent_comision[0]){
						$agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
                         echo "<br/>";
                         echo "<strong>AGENT:</strong> <u>"; echo $agent[0]['name']." ".$agent[0]['lastname'];
                         //print_r($agent);
                         echo "</u><br/>";
                         echo "<strong>(".($agent[0]['long_percent']*100)." % ) of  ";
                         $monto_por_villa=($ocupabilidad['PL']*$pagos_enteros+(($ocupabilidad['PL']/30)*$ocupabilidad['EN']));
                         echo $monto_por_villa;
                         echo " = <span style='color:red;' >US$ ";
                         echo  number_format(($monto_por_villa*$agent[0]['long_percent']),2);
                         echo "</span></strong>";

                         switch($agent_comision[0]['paid']){
                         	case 0: //pending to pay
                         			echo " <span style='color:blue;' >(Pending to Pay)</span>";
                         	      break;
                         	case 1: //ready to pickup
                         			echo " <span style='color:#c96207;' >(Ready to Pickup)</span>";
                         	      break;
                         	case 2: //Paid
                         			echo " <span style='color:green;' >(Already Paid)</span>";
                         	      break;
                         }
						}
						?>

			       </div>
			       <div class="villa_box" style="width:400px;"><? $v=$villa_reserva[0];?>
			      VILLA AND RESERVATION DETAILS<hr/>
			       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
			       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
			       <p><b>Villa No.</b>  <?=$v['no'];?></p>
			       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
			       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
			      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

			      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
			       </div>
			  	<?}?>
				
				
				 <? if (($mid==1)){ //DO THIS ONLY IF SHORT TERM  OR MAINTENANCE OR SHORT TERM OWNER
		         //BELOW PICK UP THE EVENT ON THE BOOKING APPLIED
			  	$evento_found=$db->show_any_data_limit1("events_saved", "ref", $ocupabilidad['ref'], "=");
			  	?>

			  	  <!--//   codigo para promotion code//-->
					<?
		                $this_disc=$db->show_any_data_limit1("discount", "reference", $ocupabilidad['ref'], "=");
		                $disc_found=$this_disc[0];
			              if ($disc_found){
			              	//print_r($disc_found);
			                    //hacer calculos
			                    $amount_nightsLS=($ocupabilidad['NLS']*$ocupabilidad['ppn']);
			                    $amount_nightsHS=($ocupabilidad['NHS']*$ocupabilidad['PHS']);
			                    $amount_nights=$amount_nightsLS+$amount_nightsHS;

			                     if  ($disc_found['pro_type']=="2"){   //Amount
			                           $descuento=($disc_found['pro_qty']);
			                           $variable_descuento="US$ ".$disc_found['pro_qty']." ";
			                           $tipo_desc="monto";
			                           $promotion_code=$disc_found['pro_code'];

			                     }elseif($disc_found['pro_type']=="1"){ //percent
			                        $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                         $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="porcient";
			                         $promotion_code=$disc_found['pro_code'];
			                     }elseif($disc_found['pro_type']=="3"){ //days
			                       // $descuento=($amount_nights*($disc_found['pro_qty']/100));
			                       //  $variable_descuento=number_format($disc_found['pro_qty'],0)." % ";
			                         $tipo_desc="days";
			                         $promotion_code=$disc_found['pro_code'];

			                         if ($ocupabilidad['NLS']!=0 &&  $ocupabilidad['NHS']==0){//solo low season
			                           $descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                        }

			                        if (($ocupabilidad['NLS']==0)&&( $ocupabilidad['NHS']!=0)){//solo High season
			                           $descuento=$ocupabilidad['PHS']*$disc_found['qty_days'];
			                        }

			                        if ($ocupabilidad['NLS']!=0 &&   $ocupabilidad['NHS']!=0){//ambas season
			                          if($ocupabilidad['NLS']>=$disc_found['qty_days']){
			                         	$descuento=$ocupabilidad['ppn']*$disc_found['qty_days'];
			                          }else{
			                          	$descuento=$ocupabilidad['ppn']*$ocupabilidad['NLS'];
			                          	$descuento+=$ocupabilidad['PHS']*($disc_found['qty_days']-$ocupabilidad['NLS']);
			                          }
		                       		}
		                       		$variable_descuento=$disc_found['qty_days']." Nights";
			                     }
			              }
					?>
					<!--//   codigo para promotion code//-->
			       <div class="money_box" style="margin-left:5px;">CURRENCY<hr /><?/* print_r($disc_found);*/?>
				     <? if($evento_found[0]){/* if special event was found do this*/?>
				   		<p style="text-align:right;"><span style="color:red;">Special Event:<strong><u><?=$evento_found[0]['name']?></u></strong><br/>
		                  <?=$evento_found[0]['qty']?> <?

		                  switch($evento_found[0]['type']){
		                   case 1: echo '%'; break;
		                   case 2: echo 'USD'; break;
		                  }

		                  ?>
		                  <?

		                  switch($evento_found[0]['increase']){
		                   case 1: echo 'increased'; break;
		                   case 2: echo 'decreased'; break;
		                  }
		                  ?> per nights
		                  </span>
		               </p>
					 <?}?>

			         <? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['NLS'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['NLS']*$ocupabilidad['ppn']),2);?> </p>
			         	<p id="left"><? echo $ocupabilidad['NHS'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['NHS']*$ocupabilidad['PHS']),2);?> </p>
			          <? }?>

			           <? if (($ocupabilidad['NHS']==0)&&($ocupabilidad['NLS']>0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights LS x <? echo $ocupabilidad['ppn'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['ppn']),2);?> </p>
			          <? }?>

					<? if (($ocupabilidad['NHS']>0)&&($ocupabilidad['NLS']==0)){?>
			         	<p id="left"><? echo $ocupabilidad['nights'];?> Nights HS x <? echo $ocupabilidad['PHS'];?> = USD <? echo number_format(($ocupabilidad['nights']*$ocupabilidad['PHS']),2);?> </p>


			          <? }?>
				            <!--//codigo promotion//-->
		                     <?
		                     $LS_monto=$ocupabilidad['NLS']*$ocupabilidad['ppn'];
		                     $HS_monto=$ocupabilidad['NHS']*$ocupabilidad['PHS'];
		                     ?>
						    <? if (($descuento>0)&&($tipo_desc=="monto")){?>

						    <p id="left" style="text-align:right; color:green;">
						    	(<?=$promotion_code?>)	Discount =
						    		<? echo "US$ ".number_format($descuento,2); ?>
						    </p>
						    <?}?>
						    <? if (($descuento>0)&&($tipo_desc=="porcient")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?>Discount of <?=number_format($amount_nights,2);?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						     <? if (($descuento>0)&&($tipo_desc=="days")){?>
						    	<p id="left" style="text-align:right; color:green;">
						    		(<?=$promotion_code?>) <?=$variable_descuento;?> Discount of <?=$ocupabilidad['NLS']+$ocupabilidad['NHS']?> =
						    		<? echo "<u>US$ ".number_format($descuento,2)."</u>"; ?>
						    	</p>
						    <?}?>
						    <? if ($descuento>0){?>
		                   <P id="left" style="font-weight:bold; color:green;">Amount after discount = USD <? echo number_format(($LS_monto+$HS_monto)-$descuento,2);?></p>
		                   <?}?>
					     <!--//fin codigo promotion//-->
					     <?
					      if (!empty($servicios_reserva)){
								$total_services2=0; $total_carros=0;
								foreach ($servicios_reserva as $s){
		                          $total_services2+=$s['price'];
		                          if($s['type']=="Car_Rental"){
                                   $carros_viejo=true;/*para saber si hay carros de antes y sumar al total*/
                                   $total_carros+=$s['price'];
				                  }
								}
							 }
					     ?>

					     <?
					      if (!empty($excursiones_reserva)){
							$total_excursion=0;
			                 foreach ($excursiones_reserva as $k){
			                 //echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
			                 $total_excursion+=$k['total'];

			                 }
			               //   echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
						  }


                          if($carros_viejo==true){
                            $sub_total=$ocupabilidad['total']-$ocupabilidad['itbis']-$total_services2-$total_excursion+$total_carros;
                          }else{
                          	$sub_total=$ocupabilidad['total']-$ocupabilidad['itbis']-$total_services2-$total_excursion;
                          }
						  
						 if($comission_discounted_amount[0]['discounted']>0){
						  $monto_por_villa=(($LS_monto+$HS_monto)-$descuento);
					     ?>
						<P id="left"><strong><span style="color:green;">Comission discount (<?=$comission_discounted_amount[0]['discounted'];?> %)= USD <? echo number_format(($monto_por_villa*($comission_discounted_amount[0]['discounted']/100)),2);?></span></strong></p>
						<?php
						 }
						 ?>
					
					
			         <P id="left"><strong>Sub-Total = USD <? echo number_format($sub_total,2);?></strong></p>
			      <?
			        if (!empty($servicios_reserva)){
						$total_services=0;  $total_carros=0;
						foreach ($servicios_reserva as $s){
					   // echo $s['price']." ";
						   if (($s['type']=="Airport Pick Up") || ($s['type']=="VIP Airport Pick Up") ){
							echo "<P id='right_blue'>".$s['name']." = ".$s['price']."</p>"; $total_services+=$s['price'];
						   }elseif($s['type']=="Car_Rental"){
		                    echo "<P id='right_blue'>".substr($s['name'],0,15)." (".$s['qty']." days)= ".$s['price']."</p>"; $total_services+=$s['price'];
		                    $carros_viejo=true;/*para saber si hay carros de antes y sumar al total*/
		                    $total_carros+=$s['price']; /*para extrar el 18 pociendo a los carros viejos*/
						   }else{
							echo "<P id='right_blue'>".ucfirst($s['type'])." ( ".substr($s['name'],0,15).")= ".$s['price']."</p>"; $total_services+=$s['price'];
						   }

						}
			  		 echo "<P id='right_blue'><strong>Total per Services = USD ".number_format($total_services,2)."</strong></p>";
					 }
					 $grand_total=($ocupabilidad['subtotal']+$total_services);
					 ?>

					 <?
					 //------------start showing excursions---------------------------------
					/* echo '<pre>';
					 print_r($excursiones_reserva);
					 echo '</pre>'; */
					  if (!empty($excursiones_reserva)){
						$total_excursion=0;
		                 foreach ($excursiones_reserva as $k){
		                 echo "<P id='right_blue' style='color:#cc1c0a;'>".substr($k['title'],0,15)." (".$k['qty_a']." adults)(".$k['qty_c']." kids)= ".$k['total']."</p>";
		                 $total_excursion+=$k['total'];
		                 }
		                  echo "<P id='right_blue' style='color:#cc1c0a;'><strong>Total Excursions = USD ".number_format($total_excursion,2)."</strong></p>";
					  }
					 ?>
					 
					 
					 
					 <?
					   if($carros_viejo==true){
					   	$ocupabilidad['itbis']+=$total_carros*0.18;
					   }
					  if((strtotime($ocupabilidad['date']))<(strtotime(TAX_FECHA))){/* si la fecha creada fue menor al 1 de enero 2013 solo aplica 16%*/?>
                      <p id="left"><?=TAX_PER_OLD?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.16),2);?></p>
					 <?}else{?>
					  <p id="left"><?=TAX_PERCENT?> - VAT - Taxes = USD <? echo number_format(($itebis_var=$sub_total*0.18),2);?></p>
					 <?}?>
					  
					 <?
					 echo "<hr />";
					  $carros_rentados=$db->showTable_r($table='cars_rented', $field='ref', $value=$ocupabilidad['ref'], $operator='=');

					   if($carros_viejo==true){
					   	$ocupabilidad['total']+=$total_carros+($total_carros*0.18);
					   }
					   $reference=$ocupabilidad['ref'];
					 ?>
						<P id='left'><strong>TOTAL <? if($carros_rentados){ echo "WITHOUT CARS"; } ?>= USD <?=number_format($TotalGral=$itebis_var+$sub_total+$total_services2+$total_excursion,2);?></strong></p>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Total Paid =  <?=number_format($montoTotalPagado,2);?></a></span></p>
						
						<? $totaldue=$TotalGral-$montoTotalPagado+$montoTotalDevuelto;
						
						//========================CALL API TO CANCEL INVOICES PENDING UNPAID IF BOOKING IS CHECK OUT OR DUE AMOUN IS 1 DOLLAR========================
						if(($totaldue<=1)||($ocupabilidad['status']==4)||($ocupabilidad['status']==0)){
							$facturasUnpaid=$db->invoicesUnpaid($ocupabilidad['ref']);/*INVOICES UNPAID FOR THIS BOOKING*/
							if($facturasUnpaid){
								 //call API to ckeck sent and reminded.
								 require_once('invoiceAPI/InvoiceAPI.php');
								 foreach($facturasUnpaid AS $k){
									$resultado=cancelInvoice($invoiceId=$k['invoiceID']);
									if($resultado['responseEnvelope.ack']=='Success'){/*si tubo exito al cancelar la factura*/
										$invoice_info=getDetailsInvoice($invoiceId=$k['invoiceID']);
										$db=new getQueries (); 
										$facturasEnviada=$db->show_data($table='ppinvoices', $condition="invoiceID='".$k['invoiceID']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
										changeStatus($facturasEnviada[0]['id'], $status=$invoice_info['invoiceDetails.status']);
									}
								 }
							}
						}
						//========================END CALL API TO CANCEL INVOICES PENDING UNPAID IF BOOKING IS CHECK OUT OR DUE AMOUN IS 1 DOLLAR========================
						if($totaldue>0){ $colordeuda="blue";}elseif($totaldue==0){ $colordeuda="green"; }else{ $colordeuda="red";} 
						?>
						<P id='left' style="color:<?=$colordeuda?>; font-weight:bold;">Balance due = <?=number_format($TotalGral-$montoTotalPagado+$montoTotalDevuelto,2);?></p>
						
						<? if($montoTotalDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Payment Refund = <?=number_format($montoTotalDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSeguridad>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security deposit = <?=number_format($montoTotalSeguridad,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$reference?>" target="_blank">Security Refund = <?=number_format($montoTotalSDevuelto,2);?></a></span></p>
						<?}?>
						
						<span style="color:red;font-weight:bold;">NOTE: Electricity is charged separate as per consumption.</span>
						<? 
		  
						if($agent_comision[0]){
						// print_r($agent_comision[0]);
                         $agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
                         echo "<br/>";
                         echo "<strong>AGENT:</strong> <u>"; echo $agent[0]['name']." ".$agent[0]['lastname'];
                         //print_r($agent);
                         echo "</u><br/>";
						 
						 //$monto_por_villa=(($LS_monto+$HS_monto)-$descuento);
						 $monto_por_villa=(($LS_monto+$HS_monto));
						 //$percent_discounted=((100*$comission_discounted_amount[0]['discounted'])/$monto_por_villa);
						 $percent_discounted=$comission_discounted_amount[0]['discounted'];
						 $agent_percent=($agent[0]['long_percent']*100);
						 
						 
                         echo "<strong>(".($agent_percent-$percent_discounted)." % ) of  ";
                         
                         echo $monto_por_villa;
						 
							$agent_percent_this_booking=$agent_percent-$percent_discounted;
							
                         echo " = <span style='color:red;' >US$ ";
                         echo  number_format(($monto_por_villa*($agent_percent_this_booking/100)),2);
                         echo "</span></strong>";

                         switch($agent_comision[0]['paid']){
                         	case 0: //pending to pay
                         		    echo " <span style='color:blue;' >(Pending to Pay)</span>";
                         	      break;
                         	case 1: //ready to pickup
                         			 echo " <span style='color:#c96207;' >(Ready to Pickup)</span>";
                         	      break;
                         	case 2: //Paid
                         			 echo " <span style='color:green;' >(Already Paid)</span>";
                         	      break;
                         }
						}
						?>

						<?

						/*print_r($carros);*/
						if($carros_rentados){
							?>
							<p>&nbsp;</p>
							<?
							$gral_cars=0;
							$taxes_cars=0;
							foreach($carros_rentados AS $k){
							 $this_car=$db->show_any_data_limit1("carros", "id", $k['id_car'], "=");
							$total_this_car=$k['qty_days']*$k['price']; $gral_cars+=$total_this_car; $taxes_cars+=$k['taxes'];
						   ?>
						   <p style="text-align:right; padding:0px; margin:0px; color:blue;">
						       <?=substr($this_car[0]['name'], 0, 25);?> <?=$k['qty_days']?>  x  <?=$k['price']?> = <?=number_format($total_this_car,2);?>
						   </p>
						   <?}
                             ?>
                            <p  style="text-align:right; padding:0px; margin:0px; font-weight:bold; color:blue; font-weight:bold; text-transform:uppercase;">To be paid upon arrival: USD <?=number_format($gral_cars+$taxes_cars,2);?></p>
                             <?
						}
						?>
			       </div>
			       <div class="villa_box"><? $v=$villa_reserva[0];?>
			      VILLA AND RESERVATION DETAILS<hr/>
			       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
			       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
			       <p><b>Villa No.</b>  <?=$v['no'];?></p>
			       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
			       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
			      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

			      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
			       </div>
		      <?}  ?>


			   <? if ($buyer==1){ //DO THIS ONLY IF BUYERS
			  	?>
		           <div class="money_box" style="width:300px; margin-left:5px;">
		           <h4 style="margin:0px; padding:0px; margin-top:0px; margin-bottom:0px; font-size:11px;">PAYMENTS INFORMATION</h4>
		           <hr style="margin:0px; padding:0px; width:100%" />
		                <? if ($ocupabilidad['EN']>0){ $pagos_enteros=($ocupabilidad['PAYM']-1);}else{$pagos_enteros=$ocupabilidad['PAYM'];}?>

		                <?  /* verificar si hay noches extras y no hay pagos mensuales para aplicar tarifa mensual*/
		                /*if (($ocupabilidad['EN']>0)&&($pagos_enteros==0)){
                          $pagos_enteros=1; $ocupabilidad['EN']=0;
		                } */

		                ?>
			         	<p id="left" style="margin-top:0px; padding-top:0px;"><? echo $pagos_enteros;?> Monthly payments <b><? echo number_format($ocupabilidad['PMV'],2);?></b> = USD <? echo number_format(($pagos_enteros*$ocupabilidad['PMV']),2);?> </p>
		               <p id="left"><? echo $ocupabilidad['EN'];?> Extra nights x <b><? echo $ocupabilidad['ppn'];?></b> = USD <? echo number_format(($ocupabilidad['EN']*$ocupabilidad['ppn']),2);?> </p>

			         <?

					 echo "<hr />";
					 echo "<P id='left'><strong>GENERAL TOTAL = USD ".number_format($ocupabilidad['total'],2)."</strong></p>"; ?>
					 
					 
					  <P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Total Paid =  <?=number_format($montoTotalPagado,2);?></a></span></p>
					 <? 
						$TotalGral=$ocupabilidad['total'];
						$totaldue=$TotalGral-$montoTotalPagado+$montoTotalDevuelto;
						
						if($totaldue>0){ $colordeuda="blue";}elseif($totaldue==0){ $colordeuda="green"; }else{ $colordeuda="red";} 
						?>
						<P id='left' style="color:<?=$colordeuda?>; font-weight:bold;">Balance due = <?=number_format($TotalGral-$montoTotalPagado+$montoTotalDevuelto,2);?></p>
						
						<? if($montoTotalDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Payment Refund = <?=number_format($montoTotalDevuelto,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSeguridad>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Security deposit = <?=number_format($montoTotalSeguridad,2);?></a></span></p>
						<?}?>
						<? if($montoTotalSDevuelto>0){?>
						<P id='left'><span id="achanged"><a href="transationsHistory.php?r=<?=$ocupabilidad['ref']?>" target="_blank">Security Refund = <?=number_format($montoTotalSDevuelto,2);?></a></span></p>
						<?}?>
					 
					 
		             <span style="color:blue;"><u>First Payment on</u>: <b><?=formatear_fecha($ocupabilidad['start'])?></b> <!--//(See all)//--></span><br/>
		             <span style="font-size:10px; color:red;">NOTE: Electricity + Gas is charged monthly per consumption</span>
		            <p style="color: white; line-height:normal; font-weight:bold; text-align:center; margin-top:0px; margin-bottom:0px; background-color:#09F;">MORE DETAILS</P>
		              <?

		              if ($servicios_reserva_long){
						$total_services=0;
						foreach ($servicios_reserva_long as $sl){
					   // echo $s['price']." ";

							echo "<P id='right_blue'>".ucfirst($sl['name'])."= ".$sl['price']."</p>"; $total_services+=$sl['price'];
						}
			  		 echo "<P id='right_blue'><strong>Total Monthly per Services = USD ".number_format($total_services,2)."</strong></p>";
					 }
					 $grand_total=($ocupabilidad['subtotal']+$total_services);
			       ?>
			       <p style="line-height:normal; font-weight:bold; text-align:right; margin-top:0px;">Monthly price per villa <?=number_format($ocupabilidad['PL'],2)?></p>

                   	<?
						if($agent_comision[0]){
							$agent=$db->showTable_r($table='commission', $field='id', $value=$agent_comision[0]['id_referal'], $operator='=');
                         echo "<br/>";
                         echo "<strong>AGENT:</strong> <u>"; echo $agent[0]['name']." ".$agent[0]['lastname'];
                         //print_r($agent);
                         echo "</u><br/>";
                         echo "<strong>(".($agent[0]['long_percent']*100)." % ) of  ";
                         $monto_por_villa=($ocupabilidad['PL']*$pagos_enteros+(($ocupabilidad['PL']/30)*$ocupabilidad['EN']));
                         echo $monto_por_villa;
                         echo " = <span style='color:red;' >US$ ";
                         echo  number_format(($monto_por_villa*$agent[0]['long_percent']),2);
                         echo "</span></strong>";

                         switch($agent_comision[0]['paid']){
                         	case 0: //pending to pay
                         			echo " <span style='color:blue;' >(Pending to Pay)</span>";
                         	      break;
                         	case 1: //ready to pickup
                         			echo " <span style='color:#c96207;' >(Ready to Pickup)</span>";
                         	      break;
                         	case 2: //Paid
                         			echo " <span style='color:green;' >(Already Paid)</span>";
                         	      break;
                         }
						}
						?>

			       </div>
			       <div class="villa_box" style="width:400px;"><? $v=$villa_reserva[0];?>
			      VILLA AND RESERVATION DETAILS<hr/>
			       <img style="float:left; padding-right:5px;" src="<?=$v['pic']?>" alt="villa No.<?=$v['no']?>" title="Villa No.<?=$v['no']?>" width="153" height="103">
			       <p> <b>From: </b><?=formatear_fecha($ocupabilidad['start'])?><b><br/> To:</b> <?=formatear_fecha($ocupabilidad['end'])?> </p>
			       <p><b>Villa No.</b>  <?=$v['no'];?></p>
			       <P><b>Maximun Capacity:</b> <?=$v['capacity'];?> Persons</p>
			       <p> <b>Size:</b> <?=number_format($v['ft2'],0);?> ft&sup2; / <?=$v['m2'];?> m&sup2;</p>
			      <P> <b>Bedrooms:</b> <?=$v['bed'];?> &nbsp;&nbsp;&nbsp;<b>Bathrooms:</b> <?=$v['bath'];?> &nbsp;&nbsp;&nbsp;<b>Airconditioners:</b> <?=$v['AC'];?></p>

			      <p> <!--Owner:--> <b>Details:</b> <?=$v['head'];?></p>
			       </div>
			  	<?}?>
		       <div class="client_box" style="margin-left:5px;">
		      <!--*----------------------------------------------->
		    <? $estado=$ocupabilidad['status'];
		    if (($estado==5)||($estado==7)||($estado==19)||($estado==20)||($estado==21)||($estado==22)||($estado==23)||($estado==24)||($estado==25)){?>
		       <? if (($estado==7)||($estado==19)||($estado==20)||($estado==21)||($estado==22)||($estado==23)||($estado==24)||($estado==25)){
				   $owner=$db->show_id('owners', $ocupabilidad['client']);
				   ?>
		            <p class="_p">OWNER DETAILS</><hr/>
		            <p class="_p"><b>Owner in house: </b><? echo $owner[0]['name'].' '.$owner[0]['lastname']; ?><br/> <b>Own villa (s):</b> <? $vo=$db->show_data('villas', "`id_owner`=".$ocupabilidad['client'], 'id'); foreach( $vo as $vi){ echo "(".$vi['no'].") "; }
		             $sending_name=$owner[0]['name']; $sending_lastname=$owner[0]['lastname'];
		            ?> </p>
		        <? }?>

		        <? if ($estado==5){?>
		            <p class="_p">OUT OF SERVICE TEMPORARY</><hr/>
		        <? }?>
		 	</div> <!--*----------------------------------------------->
		    <? }else{ ?>
		    	<? $cl=$db->customer($ocupabilidad['client']);?>
		        <p class="_p">CLIENT AND PERSONS</><hr/>

		       <p class="_p"><b>Customer: </b><a href="view-clients-details.php?id=<?=$cl['id'];?>" title="Client details" target="_blank"><? echo $cl['name'].' '.$cl['lastname']; ?></a>&nbsp;&nbsp;&nbsp; <b>No.</b> <? echo $cl['id'];
		              $sending_name=$cl['name']; $sending_lastname=$cl['lastname'];
		       ?></p>
		       <p class="_p"><b>Phone:</b> <? if ($cl['phone']){ echo $cl['phone'];}else{ echo 'unavailable';}?>&nbsp;&nbsp;&nbsp;  <b>Email:</b> <? if ($cl['email']){echo $cl['email'];}else{echo 'unavailable';}?></p>
		       <p class="_p"><b>Address:</b> <? if  ($cl['address']){ echo $cl['address'].", ".$cl['country']; }else{ echo 'unavailable';}?></p>

		       <div class="people_box" style="text-align:center"><!--<b>PERSONS IN VILLA</b><br>--><?
			   echo '<table border=0 cellpadding=1 cellspacing=1><tr><td class="peq" valign=top><strong>'.$ocupabilidad['adults'].' Adults</strong></td><td class="peq" valign=top><strong>'.$ocupabilidad['kids'].' Children</strong></td></tr>';
			   echo '<tr><td valign=top ><ol id="ol">';
				   foreach ($gente_reserva as $p){

					 if ($p['type']==1)	echo '<li class=\'li_brown\' >'.ucfirst($p['name'])." ".ucfirst($p['lastname'])."</li>";
					}
				echo '</ol></td><td valign=top ><ol id="ol">';
				foreach ($gente_reserva as $p){
					 if ($p['type']==2)	echo '<li >'.ucfirst($p['name'])." ".ucfirst($p['lastname'])."</li>";
					}
			   echo '</ol></td></tr></table>';
		       ?>
		      </div></div>
		    <?} ?>



		<div class="notes_box">NOTES AND COMMENTS<hr/>
           <?
            /*======================NEW COMMENTS SYSTEM=================================================*/
             $booking_comment=$db->show_any_data($table='comments', $field='ref', $value=$ocupabilidad['ref'], $operator='=');
			 
			 if( $booking_comment){
			 	//echo "comments made for booking ".$ocupabilidad['ref']."<br/>";
				 foreach($booking_comment AS $k){
				 	 //solo presentar las notas si no estan borradas
				 	 //dar la oportunidad de borrar la nota al manager only
				 	 //poder poner la nota como manager y estas no se pueden borrar
			         $data= new DB(); $made=$data->getUserDetails($k['id_adm']);
			         if($x==1){ $color="#ffffff;";}else{$color="#e2eefd;";}
			      if($k['deleted']!=1){/*si la nota no esta borrada*/
			       if($k['tipo']!=4){/*BE SURE TO ONLY SHOW THE NOTES O COMMENTS THAT DON'T BELONG TO THE BOOKING SYSTEM CHANGES*/
			        if($k['tipo']==2){$color_user="red;"; $color_date="red;";}else{ $color_user="#3B5998;"; $color_date="#AAAAAA;";} //CHANGE THE COLOR TO USER AND DATE IF IT IS A MANAGER NOTE
			        if($k['tipo']==3){
						$color_note="black;"; $color="#ffc2c2;";$color_date="black;";$color_user="#black;";
					}else{ 
						$color_note="#333333;";
					}  //CHANGE THE COLOR TO THE NOTE TEXT IF IT IS A COMPLAINT
			        if($k['tipo']==5){$color="#edebeb;";}  //CHANGE THE COLOR TO THE NOTE TEXT IF IT IS A COMPLAINT
				 	?>
				 	<div  class="row" style="background-color:<?=$color?> padding:0; margin:0;border-bottom: 1px solid  #cecccc;">
				 		<div style="float:left; font-weight:bold; padding-right:30px; color:<?=$color_user?>  direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 1.28;  text-align: left;">
				 		<? switch($k['tipo']){
				 			case 2: //mean that it is a manager note
				 					echo "MANAGER NOTE - ";
				 					break;
				 			case 3: //complaint note
				 					echo "COMPLAINT NOTE - ";
				 					break;
				 			case 5: //booking system note (information sent to client)
				 					echo "BOOKING SYSTEM - ";
				 					break;
				 		}?>
				 		<?=$made[0]['name']?> <!--//<?=$made[0]['lastname']?> (<?=$made[0]['user']?>)//-->
				 		</div>
				 		<div class="row" style="float:left;color:<?=$color_date?>  font-weight:bold;   cursor: default;  display: inline-block;  vertical-align: top;  direction: ltr;  font-family: lucida grande,tahoma,verdana,arial,sans-serif;  font-size: 11px;  line-height: 1.28; text-align: left;">
				 		<?=date("d M Y - g:i:s A",strtotime($k['fecha']))?> <?/* if($k['tipo']==5){?><span style="color:black">(SYSTEM NOTE)</span><?}*/?>
				 		</div>
				 		<? if($k['tipo']!=5){/*if it is not a booking sent info note*/?>
					 		<? if($_SESSION['info']['manager']==1){/*ONLY DELETE NOTE IF THE USER IS THE MANAGER*/?>
					 			<span class="delete"><a href="reserva_details.php?del_note=<?=$k['id']?>&id=<?=$_GET['id']?>" onClick="return confirmSubmitText('Are you sure you want to delete this note?');"><img src="images/DeleteGray.png" alt="Delete" width="10" height="10" border="0"/></a></span>
					 		<?}/*ONLY DELETE NOTE IF THE USER IS THE MANAGER*/?>
				 		<?}?>
				 	    <p  style="clear:both;line-height: 14px; word-wrap: break-word; color:<?=$color_note?>   direction: ltr; font-family: lucida grande,tahoma,verdana,arial,sans-serif; font-size: 11px; text-align: left; margin-bottom:0;">           <? if($k['tipo']!=5){/*if it is not a booking sent info note*/?>
				 	    <?=$k['comment'];?>
                       <?}else{?>
                         <strong><span style="color:black;"> BOOKING INFORMATION SENT TO CLIENT</span> </strong>
                       <?}?>
				 	    </p>
				 	    <p style="margin:0; padding:0;">&nbsp;</p>
				 	</div>
				   <?
				    if ($x==0){$x++;} elseif ($x==1){$x--;}
				   }/*TERMINA CONDICIONAL SI LA NOTE NO ES UNA CAMBIO DEL BOOKING SYSTEM*/
				  }/*termina condicional si la nota no esta borrada*/
				 }
			 }
		 /*======================NEW COMMENTS SYSTEM=================================================*/
           ?>
		   <?php
		   $facturasEnviada=$db->show_data($table='ppinvoices', $condition="ref='".$ocupabilidad['ref']."'", $order='id');/*INVOICES FOR THIS BOOKING*/
		   if($facturasEnviada){
			   ?>
			 <table align="center" cellpadding="2" cellspacing="2" border="0" width="100%">
				<tr style="background-color:green; color:white;">
					<td class='centro' id="td">invoiceID</td>
					<td class='centro' id="td">Charged</td>
					<td class='centro' id="td">Amount</td>
					<td class='centro' id="td">Due Date</td>
					<td class='centro' id="td">Status</td>
					<td class='centro' id="td">URL</td>
				</tr>
			   <?
			   foreach($facturasEnviada AS $k){
				   /*echo $k['invoiceID'];
				   echo "<br/>";*/
				   ?>
					<?php
					$x=0;								
					?>
					<tr class="fila<?=$x?>" style="color:<?=$colors?>">
						<td style="font-size:8px" ><?=$k['invoiceID']?></td>
						<td style="font-size:10px"><? if($k['tipopago']==3){ echo "100%"; }elseif($k['tipopago']==2){ echo "50%"; }elseif($k['tipopago']==1){echo "One night";}?></td>
						<td style="font-size:10px" align="right"><?=$k['amount']?></td>
						<td style="font-size:10px" ><?=$k['duedate']?></td>
						<td style="font-size:10px"  ><?=$k['status']?></td>
						<td style="font-size:10px"  ><a href='<?=$k['url']?>' target="_blank">View</a></td>
					</tr>
								<? if ($x==0){$x++;} elseif ($x==1){$x--;}
								
			   }
			   ?>
					</table>
				<?
		   }
		   
		   ?>


			<? if($ocupabilidad['rc']){?><b>Booking Note:</b><br /> <?=stripslashes($ocupabilidad['rc']);?><br /><?}?>
		  <? $link= new DB();
		  
		  if ($ocupabilidad['status']==0){
		  	$cancelled=$db->show_cancelled($ocupabilidad['ref']);
			$madec=$link->getUserDetails($cancelled[0]['id_adm']);
		    echo "CANCELLATION REASONS: <span style='color:red;'>".stripslashes($cancelled[0]['reasons'])." [on ".$cancelled[0]['date']." by: ".$madec[0]['name']."]</span>";
		  }
		  ?>


		   <?/* if (!empty($servicios_reserva)){
			 //echo "<b>Services Comment:</b><br/>";
			 foreach ($servicios_reserva as $s){
			 	if($s['note']!=""){
		    		echo "<span class='c_b'><b>".$s['type']."</b>: ".stripslashes($s['note'])."<br/></span>";
		    	}
			 }?>
			 <br />
			<?}*/?>

			<? /*if ($ocupabilidad['adm']!="0"){*/?>

				<? if ($ocupabilidad['upd']>0){?>

					<?
					$fecha_modificado=$db->show_id("occupancy_mod", $ocupabilidad['upd']);
					?>
					<?  // echo $ocupabilidad['adm'];
					//$link= new DB(); $made=$link->getUserDetails($ocupabilidad['adm']);
					 $made=$link->getUserDetails($fecha_modificado[0]['id_adm']);
					?>

				<p class="derecha">Last modified by: <u><?=$made[0]['name'];?></u>

				On: <span  style="color:red"><?=date("d M Y - g:i:s A",strtotime($fecha_modificado[0]['date']));?></span>
				<!--//<br/>Created: <span  style="color:red"><?=$ocupabilidad['date'];?></span>//-->
				</p>
				 <?
				   if ($ocupabilidad['line']==1){
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Client online</span>";
			      	echo " On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }elseif($ocupabilidad['line']==2){
			        $get_referral_id=$db->show_any_data_limit1('bookingreferred', 'ref_book', $ocupabilidad['ref'], '=');  //get the id of this referral
			        $referral_details=$db->show_any_data_limit1('commission', 'id', $get_referral_id[0]['id_referal'], '=');  //get datails for this referral
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Referral (".$referral_details[0]['name']." ".$referral_details[0]['lastname'].")</span>";
			      	echo " On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }elseif($ocupabilidad['line']==4){
			        $get_referral_id=$db->show_any_data_limit1('bookingreferred', 'ref_book', $ocupabilidad['ref'], '=');  //get the id of this referral
			        $referral_details=$db->show_any_data_limit1('commission', 'id', $get_referral_id[0]['id_referal'], '=');  //get datails for this referral
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Referral <!--(".$referral_details[0]['name']." ".$referral_details[0]['lastname'].")--></span>[DIDN'T SENT TO CLIENT]<BR/>";
			      	echo " On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }else{
			       //buscar el usuario que lo hizo
		            $made1=$link->getUserDetails($ocupabilidad['adm']); //echo $ocupabilidad['adm'];
		            echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">".$made1[0]['name']." ".$made1[0]['lastname']."</span>";
			      	echo " On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }
			       ?>

				<?}else{?>
				<!--//<p class="derecha">Made by: <?=$made[0]['name'];?><br>
				 On: <span  style="color:red"><?=$ocupabilidad['date'];?></span>
				</p>//-->
		         <?
		         $link= new DB();
		         $made=$link->getUserDetails($ocupabilidad['adm']);
			        if ($ocupabilidad['line']==1){
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Client online</span><br/>";
			      	echo "On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }elseif($ocupabilidad['line']==2){
			        $get_referral_id=$db->show_any_data_limit1('bookingreferred', 'ref_book', $ocupabilidad['ref'], '=');  //get the id of this referral
			        $referral_details=$db->show_any_data_limit1('commission', 'id', $get_referral_id[0]['id_referal'], '=');  //get datails for this referral
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Referral (".$referral_details[0]['name']." ".$referral_details[0]['lastname'].")</span><br/>";
			      	echo "On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }elseif($ocupabilidad['line']==4){
			        $get_referral_id=$db->show_any_data_limit1('bookingreferred', 'ref_book', $ocupabilidad['ref'], '=');  //get the id of this referral
			        $referral_details=$db->show_any_data_limit1('commission', 'id', $get_referral_id[0]['id_referal'], '=');  //get datails for this referral
			        echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Referral <!--(".$referral_details[0]['name']." ".$referral_details[0]['lastname'].")--></span>[DIDN'T SENT TO CLIENT]<BR/>";
			      	echo " On: <span  style=\"color:red\">".date("d M Y - g:i:s A",strtotime($ocupabilidad['date']))."</span></p>";
			       }else{
			        //echo "<p class=\"derecha\">Made by: <span  style=\"color:red\">Unavailable</span><br/>";
			      	//echo "On: <span  style=\"color:red\">".$ocupabilidad['date']."</span></p>";
			      	?>
		            <p class="derecha">Made by: <?=$made[0]['name']." ".$made[0]['lastname'];?><br>
				 		On: <span  style="color:red"><?=date("d M Y - g:i:s A",strtotime($ocupabilidad['date']));?></span>
					</p>
					<?
			       }
		         ?>
				<?}?>

		</div>
			<?
		 }else{
			 //header('Location:booking-calendar.php');
			die('Error: missing id on booking details');
			 }
		}else{
			// header('Location:login.php');
			die('Error: This user is not logged in');
			 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
		  }
		?>
		<table style="clear:both">
		<tr>
			<td>
				<style>#web-buttons-idt4wi7 a{display:block;color:transparent;} #web-buttons-idt4wi7 a:hover{background-position:left bottom;}a#web-buttons-idt4wi7a {display:none}</style>
				<table id="web-buttons-idt4wi7" width=0 cellpadding=0 cellspacing=0 border=0><tr>
				<td style="padding-right:0px" title ="Apply Payment">
				<a href="applyPayment.php?i=<?=$id;?>" target="_blank" title="Apply Payment" style="background-image:url(images/btt4wi71.png);width:83px;height:26px;display:block;"><br/></a></td>
				</tr></table>
			</td>
			<? if ($_SESSION['info']['cancelbooking']==1){?>
			<td>
				<style>#web-buttons-idt4wi7 a{display:block;color:transparent;} #web-buttons-idt4wi7 a:hover{background-position:left bottom;}a#web-buttons-idt4wi7a {display:none}</style>
				<table id="web-buttons-idt4wi7" width=0 cellpadding=0 cellspacing=0 border=0><tr>
				<td style="padding-right:0px" title ="Cancel Booking">
				<a href="cancel-booking.php?ref=<?=$ocupabilidad['ref'];?>" target="_blank" title="Cancel Booking" style="background-image:url(images/cancel_booking.png);width:83px;height:26px;display:block;"><br/></a></td>
				</tr></table>
			</td>
			<?}?>
			<td>
				<style>#web-buttons-idt4wi7 a{display:block;color:transparent;} #web-buttons-idt4wi7 a:hover{background-position:left bottom;}a#web-buttons-idt4wi7a {display:none}</style>
				<table id="web-buttons-idt4wi7" width=0 cellpadding=0 cellspacing=0 border=0><tr>
				<td style="padding-right:0px" title ="Print">
				<a href="invoices.php?ref=<?=$ocupabilidad['ref'];?>" target="_blank" title="Print" style="background-image:url(images/print_small.png);width:41px;height:26px;display:block;"><br/></a></td>
				</tr></table>
				<!--<form method="post" action="reserva_details_print.php" target="_blank">
					<input type="hidden" name="id" value="<?=$id?>" />
					<input type="image" src="images/Print_0.png" alt="Submit">
				</form>-->
			</td>
			<td>
				<style>#web-buttons-id34u7t a{display:block;color:transparent;} #web-buttons-id34u7t a:hover{background-position:left bottom;}a#web-buttons-id34u7ta {display:none}</style>
				<table id="web-buttons-id34u7t" width=0 cellpadding=0 cellspacing=0 border=0><tr>
				<td style="padding-right:0px" title ="Send Invoice">
				<a href="send_booking_invoice.php?ref=<?=$ocupabilidad['ref'];?>"  target="_blank" title="Send Invoice" style="background-image:url(images/send_invoice.png);width:72px;height:26px;display:block;"><br/></a></td>
				</tr></table>
				
			</td>
	
				<!--<input type="image" src="images/Close_0.png" onclick="javascript: window.parent.history.go(); window.close();" alt="Close">-->
			
			<td>
			<style>#web-buttons-id34u7t a{display:block;color:transparent;} #web-buttons-id34u7t a:hover{background-position:left bottom;}a#web-buttons-id34u7ta {display:none}</style>
			<table id="web-buttons-id34u7t" width=0 cellpadding=0 cellspacing=0 border=0><tr>
			<td style="padding-right:0px" title ="Send Info">
			<a href="send_booking_info.php?ref=<?=$ocupabilidad['ref'];?>"  target="_blank"  title="Send Info" onClick="return confirmSubmitText('Are you sure you want to send information about booking no. <?=$ocupabilidad['ref'];?> to <?=$sending_name." ".$sending_lastname;?> ?');" style="background-image:url(images/info_client.png);width:59px;height:26px;display:block;"><br/></a></td>
			</tr></table>
			<? if ($_SESSION['info']['level']<=4){
				 if (($ocupabilidad['status']!=0)&&($ocupabilidad['status']!=5)){?>
					<!--<input type="button" class="book_but" onclick="window.open('edit-booking.php?refnumb=<?=$ocupabilidad['ref'];?>')" value="update" title="Change this customer"> -->
				<? }
				}?>
			</td>
			<? if (($estado!=5)&&($estado!=0)){?>
			<td>
				<!--<form method="post" action="send_info_client.php" target="_blank">
					<input type="hidden" name="ref" value="<?=$ocupabilidad['ref'];?>" />
					<input type="image" src="images/Sent_to_Client_0.png" alt="Submit" title="Send this info to the Customer" onClick="return confirmSubmitText('Are you sure you want to send information about booking no. <?=$ocupabilidad['ref'];?> to <?=$sending_name." ".$sending_lastname;?> ?');">
				</form>-->
			</td>
			
			<?}?>
		</tr>
		</table>