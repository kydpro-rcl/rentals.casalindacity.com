<? include('menu_CSS/menu-admin.php');
/*function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 } */
?>
<p class="header">Search Payments per Year Paypal</p>
<form method="post" action="payments_yearspp.php" >
	<p id="fields" style="text-align:center;"><!--Month:
	     <select name="m">
      	<?
      	for($i=1; $i<=12; $i++){?>
         <option value="<?=sp2($i)?>" <? if($_POST['m']==sp2($i)){?> selected="selected" <?}?> ><?=date('F',strtotime(sp2('2012-'.$i.'-01')))?></option>
	      <?
	      }
      	?>
      </select>-->
      Year:
   	<select name="y">
      	<?
      	for($i=(date('Y')-1); $i<=date('Y')+1; $i++){?>
         <option value="<?=$i?>" <? if($_POST['y']==$i){?> selected="selected" <?}?> ><?=$i?></option>
	      <?
	      }
      	?>
      </select>

      <input class="book_but" type="submit" name="go" value="Show Report"/>
	</p>
</form>


 <?
 if($_POST){
       $db= new getQueries();
	   $mes=$_POST['m'];
	   $year=$_POST['y'];
	   $inicio_mes="$year-01-01";
	   $fin_mes="$year-12-31";
		//$result=$db->booking_per_monthspp($month=$_POST['m'], $year=$_POST['y']);
		 $result=$db->showTable_restrinted($table='payments', $condition="fecha>='".$inicio_mes."' AND fecha<='".$fin_mes."' AND type=3 AND class=1", $order='id');
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";	*/	
		if ($result){
			 $total_paid='';
			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> payments</p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="3" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF PAYMENTS PER MONTHS </strong><!--</p>-->
												</td>
											</tr>
				    						<tr bgcolor="#a6cdf4">
					    						<td align="center" class="blue_dark"><strong>Ref.</strong>
					    						</td>
												<td align="center" class="blue_dark"><strong>Payment Amount</strong>
												</td>
												<td align="center" class="blue_dark"><strong>Date Paid</strong>
					    						</td>
												<td align="center" class="blue_dark" nowrap="nowrap"><strong>Checkin</strong>
					    						</td>
												<td align="center" class="blue_dark" nowrap="nowrap"><strong>Checkout</strong>
					    						</td>
				    						</tr>
			<?foreach ($result as $b){
				$booking=$db->see_occupancy_id($b['ref']);
			 //print_r($booking[0]);
			 ?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['ref']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><?=$b['ref']?></td>
					
					<td style="font-size:11px; text-align:right;"  > <? echo number_format($b['amount'],2); $total_paid+=$b['amount'];?></td>
					<td nowrap="nowrap"><? echo formatear_fecha(date('Y-m-d',strtotime($b['fecha'])));?></td>
					<td nowrap="nowrap"><? echo formatear_fecha(date('Y-m-d',strtotime($booking[0]['start'])));?></td>
					<td nowrap="nowrap"><? echo formatear_fecha(date('Y-m-d',strtotime($booking[0]['end'])));?></td>
				</tr>
			 <?
			}
			 ?>
			 <tr>
			 <td colspan="2"><strong>Total</strong></td>
			 <td ><strong><?=number_format($total_paid,2)?> USD</strong></td>
			 </tr>
			</table>
			<?
		}else{
			echo "<p>&nbsp;</p>";
			echo "<hr/>";
			echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No Payments found for your search</p>";
		}
  }
		?>