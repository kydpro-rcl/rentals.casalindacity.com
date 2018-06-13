<? include('menu_CSS/menu-admin.php');
/*function sp2($va){
  $num=str_pad($va, 2, '0', STR_PAD_LEFT);
 return $num;
 } */
?>
<p class="header">Search bookings per promotion</p>
<form method="post" action="bookings_per_promo.php" >
	<p id="fields" style="text-align:center;">Promotion code:
	  <input type="text" name="code" value="<?=$_POST['code']?>"/>
      <input class="book_but" type="submit" name="go" value="go"/>
	</p>
</form>


 <?
 if($_POST){
       $db= new getQueries();
		$result=$db->booking_per_promo($_POST['code']);

		if ($result){

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings</p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
												<td colspan="7" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER PROMO </strong><!--</p>-->
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
				    						</tr>
			<? foreach ($result as $b){?>
				<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
				<td style="font-size:9px" ><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
					 <td  style="font-size:11px" ><?=formatear_fecha($b['start'])?></td><td style="font-size:11px"  ><?=formatear_fecha($b['end'])?></td>
					<td style="font-size:11px; text-align:right;"  > US$ <?=number_format($b['total'],2)?></td>

					<td  style="font-size:11px" ><?=$b['ref']?></td>
					<td  style="font-size:11px" ><?=booking_status($b['status']);?></td>
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