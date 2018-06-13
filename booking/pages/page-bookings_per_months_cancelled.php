<? include('menu_CSS/menu-admin.php');

   $db= new getQueries();
 $villasrcl=$db->all_villas();
 /*echo "<pre>";
 print_r($villasrcl);
 echo "</pre>";*/
?>
<p class="header">Search bookings per Months Cancelled</p>
<form method="post" action="bookings_per_months_cancelled.php" >
	<p id="fields" style="text-align:center;">
	Villa <select name="villa_id">
		<option value="0">All</option>
		<? foreach ($villasrcl as $k){
			if($k['able_r']==1){
			?>
        	<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
        <?
			}
		}?>
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
     
		$result=$db->booking_per_months_cancelled($month=$_POST['m'], $year=$_POST['y'], $villa=$_POST['villa_id']);

		if ($result){

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings</p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS CANCELLED PER MONTHS </strong><!--</p>-->
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
		}
  }
		?>