<?php
include('menu_CSS/menu-admin.php');
 $db= new getQueries();
 $villas=$db->showTable_restrinted("villas","able_r=1","no");  /*//SHOW ONLY VILLAS AVAILABLE FOR RENT*/
?>
<p class="header">bookings per Villas</p>
<form method="post" action="bookings_per_villas.php" >
	<p id="fields" style="text-align:center;">
	Villa:
	    <select name="villa">
				<? foreach ($villas as $k){?>
				<option value="<?=$k['id']?>" <? if ($_POST['villa'] == $k['id']) {echo " SELECTED";} ?>><?=$k['no']?></option>
				<? }?>
				</select>
	
	Month:
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
     $dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);
	  
	  
		$result=$db->booking_per_villas($month=$_POST['m'], $year=$_POST['y'], $_POST['villa']);

		if ($result){

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <!--<p style="font-weight:bold;">Total found: <?=count($result);?> bookings <a href="export_to_excel_bookings_months.php?y=<?=$_POST['y']?>&m=<?=$_POST['m']?>" alt="">Export to Excel</a></p>-->
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER VILLAS </strong><!--</p>-->
												</td>
											</tr>
				    						<tr bgcolor="#a6cdf4">
					    						<td align="center" class="blue_dark"><strong>Villa</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>From</strong>
					    						</td>
					    						<td  align="center" class="blue_dark"><strong>To</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>Total</strong>
					    						</td>

					    						<td align="center" class="blue_dark"><strong>Ref.</strong>
					    						</td>
					    						<td  class="blue_dark" align="center"><strong>Status</strong>
					    						</td>
												<td  class="blue_dark" align="center"><strong>Nights</strong>
					    						</td>
				    						</tr>
			<? 
			$total_mes='';
			$total_mes_confirmed='';
			$total_mes_noconfirmed='';
			$total_nights='';
			foreach ($result as $b){
				$resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$b,$last_date_month=$fecha_final_mes);
				
				/*echo "<pre>";
				print_r($resultado_booking);
				echo "</pre>";*/
				$total_resrvas_USD=$b['total'];
				$total_noches_reserva=$b['nights'];
				
				$price_per_night=($total_resrvas_USD/$total_noches_reserva);
				$total_usd_month=($price_per_night*$resultado_booking['nights_occupied']);
				
			  if($b['status']!=0){		
				$client=$db->showTable_restrinted($table='customers', $condition="id=".$b['client'], $order='id');
				?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					<td style="font-size:11px; text-align:right;"  > US$ <?=number_format($total_usd_month,2)?></td>

					<td  style="font-size:11px" ><?=$b['ref']?></td>
					<td  style="font-size:10px" ><?=booking_status($b['status']);?></td>
					<td  style="font-size:11px" ><?=$resultado_booking['nights_occupied']?></td>
				</tr>
			 <? 
			 
				 if(($b['status']!=0)&&($b['status']!=5)){	
					$total_nights+=$resultado_booking['nights_occupied'];
					$total_mes+=$total_usd_month;
					
					if(($b['status']!=3)){		 
						$total_mes_confirmed+=$total_usd_month;
					}else{
						$total_mes_noconfirmed+=$total_usd_month;
					}
				 }
			  }else{/*de lo contrario no cuenta el dinero, pero quiero ver esta reservacion */
				  ?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					<td style="font-size:11px; text-align:right;"  > US$ <?=number_format($b['total'],2)?></td>

					<td  style="font-size:11px" ><?=$b['ref']?></td>
					<td  style="font-size:10px" ><?=booking_status($b['status']);?></td>
					<td  style="font-size:11px" ></td>
				</tr>
			 <? 
			  } 
			 }?>
			
			 
			 
			 <tr>
				<td colspan="2"><strong>Total month</strong></td>
				<td colspan="2"><strong>Confirmed: <?=number_format($total_mes_confirmed,2)?></strong></td>
				<td colspan="2"><strong> <? if($total_mes_noconfirmed) { echo "No confirmed:"; echo number_format($total_mes_noconfirmed,2); }?></strong></td>
				<td ><strong><?=$total_nights?></strong></td>
			 </tr>
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