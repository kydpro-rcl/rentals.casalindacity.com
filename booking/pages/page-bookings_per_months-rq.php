<? include('menu_CSS/menu-admin.php');
/*function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 } */
?>
<p class="header">Search bookings per Months</p>
<form method="post" action="bookings_per_months-rq.php" >
	<p id="fields" style="text-align:center;">Month:
	     <select name="m">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>
      Year:
   	<select name="y">
      	<?
      	for($i=(date('Y')-1); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($_POST['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>

      <input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>


 <?
 if($_POST){
	   $ultimo_dia = ultimoDia($mes=$_POST['m'],$ano=$_POST['y']);
	   $fecha_final_mes=$_POST['y'].'-'.$_POST['m'].'-'.$ultimo_dia;
      $fecha_inicial_mes=$_POST['y'].'-'.$_POST['m'].'-01';
     //$dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);
	 
	
	 
       $db= new getQueries();
		$result=$db->booking_per_months($month=$_POST['m'], $year=$_POST['y']);

		if ($result){
			
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings <a href="export_to_excel_bookings_months.php?y=<?=$_POST['y']?>&m=<?=$_POST['m']?>" alt="">Export to Excel</a></p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="11" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER MONTHS </strong><!--</p>-->
												</td>
											</tr>
				    						<tr bgcolor="#a6cdf4">
					    						<td align="center" class="blue_dark" style="font-size:10px;"><strong>Villa</strong>
					    						</td>
					    						<td align="center" class="blue_dark" style="font-size:10px;"><strong>From</strong>
					    						</td>
					    						<td  align="center" class="blue_dark" style="font-size:10px;"><strong>To</strong>
					    						</td>
					    						

					    						<td align="center" class="blue_dark" style="font-size:10px;"><strong>Ref.</strong>
					    						</td>
					    						<td  class="blue_dark" align="center" style="font-size:10px;"><strong>Status</strong>
					    						</td>
												<td align="center" class="blue_dark" style="font-size:10px;"><strong>Client's name</strong>
												<td  class="blue_dark" align="center" style="font-size:10px;"><strong>Client's email</strong>
					    						</td>
												
					    						</td>
				    						</tr>
			<? 
			$total_mes_villas='';
			$total_itebis_mes='';
			$total_discounted_mes='';
			
			
			$total_mes_confirmed='';
			$total_mes_noconfirmed='';
			
			
			
			foreach ($result as $b){
								
			 // $resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$b,$last_date_month=$fecha_final_mes);
							
			  if(($b['status']!=0)&&($b['status']!=5)&&($b['status']!=7)&&($b['status']!=19)&&($b['status']!=20)&&($b['status']!=21)&&($b['status']!=22)&&($b['status']!=23)&&($b['status']!=24)&&($b['status']!=25)){		/*only if it's not owners, cancelled, maintenance*/
			 				  
				  $total_resrvas_USD=$b['total'];
				  $total_noches_reserva=$b['nights'];
				  $price_per_night=($total_resrvas_USD/$total_noches_reserva);
				  
				  if(($b['status']==8)||($b['status']==9)||($b['status']==10)||($b['status']==11)||($b['status']==26)||($b['status']==27)||($b['status']==28)||($b['status']==29)||($b['status']==30)||($b['status']==31)||($b['status']==32)||($b['status']==33)){		/*only if long term or buyer reservations*/
					
					$total_usd_month=($price_per_night*$resultado_booking['nights_occupied']);/*only apply to buyer and long*/
					$total_villa_sin_itebis=$total_usd_month;
					$itebis_actual=''; $discount_no_taxes='';/*LEAVE DE CONTAINER EMPTY WHEN REPEAT LOOP*/
				  }else{/*do below if short or mid term*/
				  
					  $total_usd_month=$total_resrvas_USD;
					  $discount_no_taxes=$b['discounted']-($b['discounted']*(15.254/100));/*only apply to short term reservations*/
					  $total_villa_sin_itebis=$total_usd_month-$b['itbis']-$discount_no_taxes;/*only apply to short term reservations*/
					  $itebis_actual=$total_villa_sin_itebis*0.18;/*only apply to short term reservations*/
				  }
				  
				  
				  if(($b['status']==3)||($b['status']==10)||($b['status']==13)||($b['status']==17)||($b['status']==27)||($b['status']==31)||($b['status']==35)){		/*what is unferified*/
					  $total_mes_noconfirmed+=$total_villa_sin_itebis;
					  
					  $amount_confirmed='';
					  $amount_unverified=$total_villa_sin_itebis;
				  }else{/* we assume then the amount is confirmed*/
					  $total_mes_confirmed+=$total_villa_sin_itebis;
					  
					  $amount_confirmed=$total_villa_sin_itebis;
					  $amount_unverified='';
				  }
					$client=$db->showTable_restrinted($table='customers', $condition="id=".$b['client'], $order='id');
					?>
					<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
					<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
						 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
						

						<td  style="font-size:11px" ><?=$b['ref']?></td>
						<td  style="font-size:10px" ><?=booking_status($b['status']);?></td>
					<td  style="font-size:11px" ><?=$client[0]['name']?> <?=$client[0]['lastname']?></td>
						<td  style="font-size:11px" ><?=$client[0]['email']?></td>
						
					</tr>
				 <? 
				
			 
 
			  $total_mes_villas+=$total_villa_sin_itebis;
			  $total_itebis_mes+=$itebis_actual;
			  $total_discounted_mes+=$discount_no_taxes;


			 }
			 
			  
			 }?>
			 
			
			</table>
			<?
			//monto_mes_booking($fechainicia, $fechafinal, $montotal, $mes_year);
		}else{
			echo "<p>&nbsp;</p>";
			echo "<hr/>";
			echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No bookings found for your search</p>";
		}
  }
		?>