<? include('menu_CSS/menu-admin.php');
include('inc/date-picker1.php');
?>
<p class="header">Report of bookings per day</p>
<form method="post" action="bookings_referral72.php" >
	 <p id="fields" style="text-align:center;">
         <span style="font-size:10px; color:red;"></span>Date to show:
		 <input type="text" name="desde" value="<? if($_POST['desde']){ echo $_POST['desde']; }else{ echo date('Y-m-d'); }?>" id="datepicker" size="10"/> 
		 Source: 
		 <select name="src">
			<option value="" <? if($_POST['src']==''){ echo 'selected="selected"'; }?>>All</option>
			<option value="0" <? if($_POST['src']=='0'){ echo 'selected="selected"'; }?>>Staff</option>
			<option value="1" <? if($_POST['src']=='1'){ echo 'selected="selected"'; }?>>Client online</option>
			<option value="2" <? if($_POST['src']=='2'){ echo 'selected="selected"'; }?>>Referral Agent</option>
			<option value="7" <? if($_POST['src']=='7'){ echo 'selected="selected"'; }?>>API</option>
			<option value="12" <? if($_POST['src']=='12'){ echo 'selected="selected"'; }?>>HA</option>
		 </select>
		 <input class="book_but" type="submit" name="go" value="Go"/>
         <br/><span style="font-size:10px; color:gray;">YYYY-MM-DD</span>
		 
        </p>
</form>


 <?
 if($_POST){
	 
		/*$ultimo_dia = ultimoDia($mes=$_POST['m'],$ano=$_POST['y']);
		$fecha_final_mes=$_POST['y'].'-'.$_POST['m'].'-'.$ultimo_dia;
		$fecha_inicial_mes=$_POST['y'].'-'.$_POST['m'].'-01';
		$dias_arreglos_mes=arreglos_days($start_date=$fecha_inicial_mes, $end_date=$fecha_final_mes);*/
	 
		$date=$_POST['desde'];
		/*
		echo $date;
		die();*/
       $db= new getQueries();
		#$result=$db->booking_per_months($month=$_POST['m'], $year=$_POST['y']);
		if($_POST['src']==''){
			$result=$db->see_occupancy_date($date);
		}else{
			$result=$db->see_occupancy_date_s($date, $s=$_POST['src']);
		}
		
		
		if ($result){
			
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/

			?>
			 <p>&nbsp;</p>
			 <hr/>
			 <p style="font-weight:bold;">Total found: <?=count($result);?> bookings </p>
			<table align="center" cellpadding="2" cellspacing="2">
			<tr>
				<td colspan="11" align="center" width="85%" class="blue_light"><!--<p>--><strong>REPORT OF BOOKINGS PER DAY </strong></td>	
			</tr>
			<tr bgcolor="#a6cdf4">
				<td align="center" class="blue_dark" style="font-size:10px;"><strong>Villa</strong></td>
				
				<td align="center" class="blue_dark" style="font-size:10px;"><strong>From</strong></td>
				
				<td  align="center" class="blue_dark" style="font-size:10px;"><strong>To</strong></td>
				
				

				<td align="center" class="blue_dark" style="font-size:10px;"><strong>Ref.</strong></td>
				
				<td  class="blue_dark" align="center" style="font-size:10px;"><strong>Status</strong></td>
				
				
			
				

				<td align="center" class="blue_dark" style="font-size:10px;"><strong>source</strong></td>
				<td align="center" class="blue_dark" style="font-size:10px;"><strong>client's name</strong></td>
				<td align="center" class="blue_dark" style="font-size:10px;"><strong>email</strong></td>
				<td align="center" class="blue_dark" style="font-size:10px;"><strong>created date</strong></td>
			</tr>
			<? 
				
			
			foreach ($result as $b){
				$client=$db->customer($b['client']);
			 # $resultado_booking=noches_del_mes_en_booking($array_days_month=$dias_arreglos_mes, $array_booking=$b,$last_date_month=$fecha_final_mes);
					?>
					<tr  bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$b['busyid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''" >
						<td style="font-size:9px"><? $villa=$db->villa($b['villa']); echo $villa[0]['no'];?></td>
						<td style="font-size:11px"><?=date("M j, Y", strtotime($b['start']));?></td>
						<td style="font-size:11px"><?=date("M j, Y", strtotime($b['end']))?></td>
						<td style="font-size:11px"><?=$b['ref']?></td>
						<td style="font-size:10px"><?=booking_status($b['status']);?></td>
					
					
						<td style="font-size:11px; text-align:right;"><?php
						switch($b['line']){
							case 0: echo "Staff"; break;
							case 1: echo "Client online"; break;
							case 2: echo "Referral Agent"; break;
							case 3: echo "Booking Engine"; break;
							case 4: echo "Referral Agent"; break;//did not sent to client info
							case 7: echo "API"; break;
							case 12: echo "HA"; break;
							default: echo "unknown";
						}
						
						?> </td>
						<td style="font-size:11px; text-align:right;"><?=$client['name']?> <?=$client['lastname']?> </td>
						<td style="font-size:11px; text-align:left;"> <?=$client['email']?> </td>
						<td style="font-size:11px; text-align:right;"> <?=date("M j, Y h:i:s A", strtotime($b['date']))?></td>
					</tr>
				<? 
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