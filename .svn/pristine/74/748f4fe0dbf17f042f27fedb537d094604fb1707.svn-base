<? include('menu_CSS/menu-admin.php');

?>
<p class="header">Search bookings per Months for Accounting</p>
<form method="post" action="bookings_per_months_acc.php" >
	<p id="fields" style="text-align:center;">Month:
	     <select name="m">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?}elseif(date('m')==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>
      Year:
   	<select name="y">
      	<?
      	for($i=(date('Y')-1); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($_POST['y']==$i){?> selected="selected" <?}elseif(date('Y')==sp2($i)){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>

      <input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>


 <?
 if($_POST){
       $db= new getQueries();
		$result=$db->booking_per_months($month=$_POST['m'], $year=$_POST['y']);
		$total_gral=''; $total_paid=''; $total_due='';
		if ($result){

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings </p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER MONTHS FOR ACCOUNTING </strong><!--</p>-->
												</td>
											</tr>
				    						<tr bgcolor="#a6cdf4">
					    						<td align="center" class="blue_dark"><strong>Villa</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>From</strong>
					    						</td>
					    						<td  align="center" class="blue_dark"><strong>To</strong>
					    						</td>
												
												<td align="center" class="blue_dark"><strong>Ref.</strong>
					    						</td>
												<td  class="blue_dark" align="center"><strong>Status</strong>
					    						</td>
					    						<td align="center" class="blue_dark"><strong>Total</strong>
					    						</td>
												<td  class="blue_dark" align="center"><strong>paid</strong>
					    						</td>
												<td  class="blue_dark" align="center"><strong>due</strong>
					    						</td>
				    						</tr>
			<? 
			
			foreach ($result as $b){
				
				$this_disc=$db->show_any_data_limit1("discount", "reference", $b['ref'], "=");
					 
					/* if($this_disc[0]['discounted']!=''){
						 
					 }*/
				
				?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					 
					 <td  style="font-size:11px" ><?=$b['ref']?></td>
					 <td  style="font-size:10px" ><?=booking_status($b['status']);?></td>
					 
					<td style="font-size:11px; text-align:right;"  > <?=number_format($b['total']-$this_disc[0]['discounted'],2)?></td>

					<?php
					
					 
					
						 $montoTotalPagado=$db->amountRef($b['ref'],'1');/*paid after API has been called to check invoices paid*/
						 
						 $restante=($b['total']-$montoTotalPagado-$this_disc[0]['discounted']);
						 
						 if($restante>0){
							  $color_due='Blue';
						 }elseif($restante<0){
							 $color_due='Red';
						 }else{
							  $color_due='green';
						 }
						 
						 if($b['status']==0){
							  $color_due='purple';
						 }
					?>
					
					
					
					<td  style="font-size:11px" ><?=$montoTotalPagado?></td>
					
					<td style="font-size:11px; text-align:right; color:<?=$color_due?>;"  > <?=number_format($restante,2)?></td>
				</tr>
			 <? 
			 $total_monto=$b['total']-$this_disc[0]['discounted'];
			 $total_gral+=$total_monto; $total_paid+=$montoTotalPagado; $total_due+=$restante;
			 }?>
			 	<tr  bgcolor="#FFFF00"  >
					<td  colspan="5" style=" text-align:center;"><strong>Total</strong></td>
					<td style=" text-align:right;"  > <strong><?=number_format($total_gral,2)?></strong></td>
					<td ><strong><?=number_format($total_paid,2)?></strong></td>
					<td style=" text-align:right; "  ><strong> <?=number_format($total_due,2)?></strong></td>
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