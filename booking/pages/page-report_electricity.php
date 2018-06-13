<link type="text/css" href="../for_rent/datapicker-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../for_rent/datapicker-ui/js/jquery-ui-1.8.16.custom.min.js"></script>
	<script>
	/*$(function() {
		$( "#datepicker" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
		$( "#datepicker2" ).datepicker({
			numberOfMonths: 1,
			showButtonPanel: true
		});
	});*/
	 <!--//
	$(function() {
		var dates = $( "#from, #to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: false,
			numberOfMonths: 2,
			onSelect: function( selectedDate ) {
				var option = this.id == "from" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
			}
		});
	});
	//-->
	</script>

<?php
   include('menu_CSS/menu-admin.php');
   require_once('inc/functions2.php');
 $db= new getQueries ();
 $villas=$db->showTable_restrinted($v="villas",$cond="able_r=1",$order="no");
?>
<p class="header">Report of Electricity / Housekeeping</p>
	<form method="post" action="report_electricity.php" >
		<p style="font-size:10px; padding-left:15px;">
		Villa (s):
		<select name="villa_id" required="required">
			<!--<option value="0">All</option>-->
			<option value="">Select</option>
			<option value="all" <?php if($_POST['villa_id']=='all'){ echo 'selected="selected"'; } ?>>ALL</option>
			<? foreach($villas AS $v){?>
		     <option value="<?=$v['id']?>" <? if($_POST['villa_id']==$v['id']) echo 'selected="selected"';?>><?=$v['no']?></option>
		    <?}?>
		</select>
		From: <input id="from" type="text" name="start" value="<?=$_POST['start']?>" required="required"/>
		To:<input id="to" type="text" name="end" value="<?=$_POST['end']?>" required="required"/>
		<input class="book_but" type="submit" name="go" value="Go"/>
        </p>

	</form>
<hr />

	<?php
	if(($_POST['villa_id'])&&($_POST['villa_id']!='all')){
		//$data= new getQueries ();
		//$comp=$data->show_data($table='comments', $condition="tipo='3' AND deleted<>'1'", $order='id');
		//$sql=" AND villa_id='".$_POST['villa_id']."'";
		//$villa=$db->villa($_POST['villa_id']);
		//$title.=" Villa ".$villa[0]['no'];
		$start_date=date('Y-m-d', strtotime($_POST['start'])); $end_date=date('Y-m-d', strtotime($_POST['end']));
		$reservaciones=$db->electricity_housekeeping_fee($villa_id=$_POST['villa_id'], $start_date, $end_date);
		
		if($reservaciones){
			/*echo $_POST['villa_id'];
			echo "<pre>";
			print_r($reservaciones);
			echo "</pre>";*/
			?>
			<table align="center" cellpadding="2" cellspacing="2">
				<tr bgcolor="#a6cdf4">
					<td>Booking No.</td>
					<td>Checkin</td>
					<td>Checkout</td>
					<td>Nights</td>
					<td>Status</td>
					<td>Bedrooms</td>
					<td>Housekeeping</td>
					<td>Electricity</td>
				</tr>
				<?php
				$total_housekeeping="";
				$total_electricity="";
				foreach($reservaciones AS $r){
					$fee=services_franco($bed=$r['bedrooms'], $r['nights']);
					$electricity=$fee['electricity'];
					$housekeeping=$fee['housekeeping'];
					$total_housekeeping+=$housekeeping;
					$total_electricity+=$electricity;
					?>
					<tr bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$r['reserveid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''">
						<td><?=$r['ref']?></td>
						<td><?=$r['start']?></td>
						<td><?=$r['end']?></td>
						<td><?=$r['nights']?></td>
						<td><?=booking_status($r['status'])?></td>
						<td><?=$r['bedrooms']?></td>
						<td align="right"><?=number_format($housekeeping,2)?></td>
						<td align="right"><?=number_format($electricity,2)?></td>
					</tr>
					<?
					
				}
				?>
				<tr bgcolor="#a6cdf4" >
						
						<td colspan="6"><strong>Total USD</strong></td>
						<td align="right"><strong><?=number_format($total_housekeeping,2)?></strong></td>
						<td align="right"><strong><?=number_format($total_electricity,2)?></strong></td>
					</tr>
			</table>
			<?
		}else{
			echo "<h1>There are not short term reservations for this period with electricity or housekeeping fee.";
		}
	}elseif($_POST['villa_id']=='all'){
		//echo "all";
		$start_date=date('Y-m-d', strtotime($_POST['start'])); $end_date=date('Y-m-d', strtotime($_POST['end']));
		if($villas){
		
			$total_housekeeping=array();
			$total_electricity=array();
			?>
			<!--<a href="exp_exc_services_fees.php?start=<?=$_POST['start']?>&end=<?=$_POST['end']?>" alt="" target="_blank">Export to Excel</a>-->
			<table align="center" cellpadding="2" cellspacing="2">
				<tr bgcolor="#a6cdf4">
					<td>No.</td>
					<td>Villa No.</td>
					<td>From date</td>
					<td>To date</td>
					<td>Bedrooms</td>
					<td>Housekeeping</td>
					<td>Electricity</td>
				</tr>
				<?
			//encabezado tabla
			$x=1;
			$total_h='';
			$total_e='';
			 foreach($villas AS $v){
				 //echo $v['no']; echo "<br/>";
					$reservaciones=$db->electricity_housekeeping_fee($villa_id=$v['id'], $start_date, $end_date);
					if($reservaciones){
						foreach($reservaciones AS $r){
							$fee=services_franco($bed=$r['bedrooms'], $r['nights']);
							$electricity=$fee['electricity'];
							$housekeeping=$fee['housekeeping'];
							$total_housekeeping[$v['no']]+=$housekeeping;
							$total_electricity[$v['no']]+=$electricity;
						}
						
					}else{
						$total_housekeeping[$v['no']]=0;
						$total_electricity[$v['no']]=0;
					}
					
					$total_h+=$total_housekeeping[$v['no']];
					$total_e+=$total_electricity[$v['no']];
				//total villa
			?>				
				<tr <? if(($total_housekeeping[$v['no']]!=0)&&($total_electricity[$v['no']]!=0)){?> bgcolor="#CCCCCC" <?}else{?> bgcolor="#cffcdb" <?}?>>
					<td><?=$x?></td>
					<td><?=$v['no']?></td>
					<td><?=$start_date?></td>
					<td><?=$end_date?></td>
					
					<td><?=$v['bed']?></td>
					<td align="right"><?=number_format($total_housekeeping[$v['no']],2)?></td>
					<td align="right"><?=number_format($total_electricity[$v['no']],2)?></td>
				</tr>
					<?
					$x++;
			 }
			 ?>
				<tr bgcolor="#a6cdf4" >
					<td colspan="5"><strong>Total USD</strong></td>
					<td align="right"><strong><?=number_format($total_h,2)?></strong></td>
					<td align="right"><strong><?=number_format($total_e,2)?></strong></td>
				</tr>
			</table>
			<?
		}
	}
	?>