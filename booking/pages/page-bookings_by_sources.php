<? include('menu_CSS/menu-admin.php');
/*function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 } */
?>
<p class="header">Report bookings by sources</p>
<form method="post" action="bookings_by_sources.php" >
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

      <input class="book_but" type="submit" name="go" value="Show"/>
	</p>
</form>


 <?
 if($_POST){
       $db= new getQueries();
		//$result=$db->booking_per_months($month=$_POST['m'], $year=$_POST['y']);
		$source4=$db->booking_by_sosurce($month=$_POST['m'], $year=$_POST['y'], $status=4);
		if($source4){ $source4QTY=whatSource($source4);}
		
		$source3=$db->booking_by_sosurce($month=$_POST['m'], $year=$_POST['y'], $status=3);
		if($source3){ $source3QTY=whatSource($source3);}
		
		$source2=$db->booking_by_sosurce($month=$_POST['m'], $year=$_POST['y'], $status=2);
		if($source2){ $source2QTY=whatSource($source2);}
		
		$source1=$db->booking_by_sosurce($month=$_POST['m'], $year=$_POST['y'], $status=1);
		if($source1){ $source1QTY=whatSource($source1);}
		
		$source_referral=$source4QTY['referral']+$source3QTY['referral']+$source2QTY['referral']+$source1QTY['referral'];
		$source_engine=$source4QTY['engine']+$source3QTY['engine']+$source2QTY['engine']+$source1QTY['engine'];
		$source_direct=$source4QTY['direct']+$source3QTY['direct']+$source2QTY['direct']+$source1QTY['direct'];
		
		$totalSBook=count($source4)+count($source3)+count($source2)+count($source1);
		
		/*echo "total $totalSBook";
		echo "<pre>";
		print_r($source4QTY);
		echo "</pre>";*/
		?>
		<table border="1" width="80%" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<th>SOURCE</th>
				<th>QTY</th>
				<th>%</th>
			</tr>
			<tr>
				<td>Booking Engines</td>
				<td><?=$source_engine?></td>
				<td><?php $percentD=(($source_engine*100)/$totalSBook); echo number_format($percentD,0);?>%</td>
			</tr>
			<tr>
				<td>Referrals</td>
				<td><?=$source_referral?></td>
				<td><?php $percentD=(($source_referral*100)/$totalSBook); echo number_format($percentD,0);?>%</td>
			</tr>
			<tr>
				<td>Direct bookings</td>
				<td><?=$source_direct?></td>
				<td><?php $percentD=(($source_direct*100)/$totalSBook); echo number_format($percentD,0);?>%</td>
			</tr>
			<tr>
				<td>TOTAL</td>
				<td><?=$totalSBook?></td>
				<td>100%</td>
			</tr>
		</table>
		<?

		/*if ($result){

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
					    						<td align="center" class="blue_dark"><strong>Total</strong>
					    						</td>

					    						<td align="center" class="blue_dark"><strong>Ref.</strong>
					    						</td>
					    						<td  class="blue_dark" align="center"><strong>Status</strong>
					    						</td>
												<td  class="blue_dark" align="center"><strong>Client's Email</strong>
					    						</td>
				    						</tr>
			<? foreach ($result as $b){
				$client=$db->showTable_restrinted($table='customers', $condition="id=".$b['client'], $order='id');
				?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					<td style="font-size:11px; text-align:right;"  > US$ <?=number_format($b['total'],2)?></td>

					<td  style="font-size:11px" ><?=$b['ref']?></td>
					<td  style="font-size:10px" ><?=booking_status($b['status']);?></td>
					<td  style="font-size:11px" ><?=$client[0]['email']?></td>
				</tr>
			 <? }?>
			</table>
			<?
		}else{
			echo "<p>&nbsp;</p>";
			echo "<hr/>";
			echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No bookings found for your search</p>";
		}*/
  }
		?>