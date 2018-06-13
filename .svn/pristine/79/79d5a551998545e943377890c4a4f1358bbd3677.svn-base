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
<p class="header">Report of Renters Insurance Coverage</p>
	<form method="post" action="renters-insurance-coverage.php" >
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

		$start_date=date('Y-m-d', strtotime($_POST['start'])); $end_date=date('Y-m-d', strtotime($_POST['end']));
		$reservaciones=$db->renters_insurance_coverage($villa_id=$_POST['villa_id'], $start_date, $end_date);
		
		if($reservaciones){

			?>
			<table align="center" cellpadding="2" cellspacing="2">
				<tr bgcolor="#a6cdf4">
					<td>Booking No.</td>
					<td>Checkin</td>
					<td>Checkout</td>
					<td>Nights</td>
					<td>Status</td>
					<td>Bedrooms</td>
					<td>Insurance</td>
				</tr>
				<?php
				
				$total_insurance="";
				foreach($reservaciones AS $r){
					$fee=services_franco($bed=$r['bedrooms'], $r['nights']);
					$insurance=wear_tear_funds($beds=$r['bedrooms'], $r['nights']);
					
					$total_insurance+=$insurance;
					?>
					<tr bgcolor="#CCCCCC" onclick="reserva('reserva_details.php?id=<?=$r['reserveid']?>','Details for Selection', 530, 800)" title="Click to see Reservation" onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';" onmouseout="this.style.backgroundColor=''">
						<td><?=$r['ref']?></td>
						<td><?=$r['start']?></td>
						<td><?=$r['end']?></td>
						<td><?=$r['nights']?></td>
						<td><?=booking_status($r['status'])?></td>
						<td><?=$r['bedrooms']?></td>
						<td align="right"><?=number_format($insurance,2)?></td>
						
					</tr>
					<?
					
				}
				?>
				<tr bgcolor="#a6cdf4" >
						
						<td colspan="6"><strong>Total USD</strong></td>
						<td align="right"><strong><?=number_format($total_insurance,2)?></strong></td>
					</tr>
			</table>
			<?
		}else{
			echo "<h1>There are not short term reservations for this period with renters insurance coverage.";
		}
	}elseif($_POST['villa_id']=='all'){
		//echo "all";
		$start_date=date('Y-m-d', strtotime($_POST['start'])); $end_date=date('Y-m-d', strtotime($_POST['end']));
		if($villas){
			$total_insurance_coverage=array();
			?>
			
			<table align="center" cellpadding="2" cellspacing="2">
				<tr bgcolor="#a6cdf4">
					<td>No.</td>
					<td>Villa No.</td>
					<td>From date</td>
					<td>To date</td>
					<td>Bedrooms</td>
					<td>Insurance</td>
				</tr>
				<?
			//encabezado tabla
			$x=1;
			$total_h='';
			$total_e='';
			 foreach($villas AS $v){
					$reservaciones=$db->renters_insurance_coverage($villa_id=$v['id'], $start_date, $end_date);
					if($reservaciones){
						foreach($reservaciones AS $r){
							$total_insurance_coverage[$v['no']]+=wear_tear_funds($beds=$r['bedrooms'], $r['nights']);
						}
					}else{
						$total_insurance_coverage[$v['no']]=0;
					}
					$total_h+=$total_insurance_coverage[$v['no']];
					//$total_e+=$total_electricity[$v['no']];
			?>				
				<tr <? if($total_insurance_coverage[$v['no']]!=0){?> bgcolor="#CCCCCC" <?}else{?> bgcolor="#cffcdb" <?}?>>
					<td><?=$x?></td>
					<td><?=$v['no']?></td>
					<td><?=$start_date?></td>
					<td><?=$end_date?></td>
					<td><?=$v['bed']?></td>
					<td align="right"><?=number_format($total_insurance_coverage[$v['no']],2)?></td>
				</tr>
					<?
					$x++;
			 }
			 ?>
				<tr bgcolor="#a6cdf4" >
					<td colspan="5"><strong>Total USD</strong></td>
					<td align="right"><strong><?=number_format($total_h,2)?></strong></td>
				</tr>
			</table>
			<?
		}
	}
	?>