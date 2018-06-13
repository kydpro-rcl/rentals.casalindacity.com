<? include('menu_CSS/menu-admin.php');
/*function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 } */
?>
<p class="header">Search bookings per Months Paypal</p>
<form method="post" action="bookings_monthspp.php" >
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
       $db= new getQueries();
		$result=$db->booking_per_monthspp($month=$_POST['m'], $year=$_POST['y']);

		if ($result){
			 
			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings</p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER MONTHS </strong><!--</p>-->
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
												<td align="center" class="blue_dark"><strong>Payment PP</strong>
												<td align="center" class="blue_dark"><strong>Date Paid</strong>
					    						</td>
				    						</tr>
			<?foreach ($result as $b){
			 $paypalPaid=$db->showTable_restrinted($table='payments', $condition="ref=".$b['ref']." AND type=3 AND class=1", $order='id');
			 /*$montoTotalPagado=$db->amountRef($b['ref'],'1');*//*paid*/?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					

					<td  style="font-size:11px" ><?=$b['ref']?></td>
					<td  style="font-size:11px" ><?=booking_status($b['status']);?></td>
					<td style="font-size:11px; text-align:right;"  > <? if($paypalPaid){ foreach($paypalPaid AS $k){ $montoTotalPagado+=$k['amount']; $fechaPago=$k['fecha']; }} /*ECHO "<PRE>"; PRINT_R($paypalPaid); ECHO "</PRE>";*/ if($montoTotalPagado){ echo number_format($montoTotalPagado,2);}?></td>
					<td><? if($fechaPago!=''){ echo formatear_fecha(date('Y-m-d',strtotime($fechaPago)));}?></td>
				</tr>
			 <?
			 unset($montoTotalPagado);unset($fechaPago);
			 }?>
			</table>
			<?
		}else{
			echo "<p>&nbsp;</p>";
			echo "<hr/>";
			echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No bookings found for your search</p>";
		}
  }
		?>