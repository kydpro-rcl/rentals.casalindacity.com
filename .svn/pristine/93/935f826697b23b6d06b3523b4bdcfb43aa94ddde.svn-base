<?php
require_once('inc/session.php');
header('Content-type: application/vnd.ms-excel');
$an=$_GET['start']; $mes=$_GET['end'];
header("Content-Disposition: attachment; filename=housekeeping-electricity$an.$mes.xls");
header("Pragma: no-cache");
header("Expires: 0");

if ($_SESSION['info']){

	require_once('init.php');
	   $db= new getQueries();
		 $villas=$db->showTable_restrinted($v="villas",$cond="able_r=1",$order="no");

		if ($villas){
			?>
			<p class="header">Report of Electricity / Housekeeping</p>
			<hr />
			<? 
			//echo "all";
			$start_date=date('Y-m-d', strtotime($_GET['start'])); $end_date=date('Y-m-d', strtotime($_GET['end']));
			if($villas){
				$total_housekeeping=array();
				$total_electricity=array();
				?>
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

		}else{
			echo "<p>&nbsp;</p>";
			echo "<hr/>";
			echo "<p class='centro' style='font-weight:bold; font-size:16px;'>No bookings found for your search</p>";
		}

}else{
	 header('Location:login.php');
	die();
	 // echo ("<meta http-equiv=\"refresh\" content=\"0;url=../login.php\">");
  }
?>