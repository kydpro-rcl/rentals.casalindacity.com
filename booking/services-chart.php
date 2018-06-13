<?
require_once('inc/session.php');
if (!$_SESSION['info']){
	header('Location:login.php');
	die();
}
require_once('init.php');
$db= new getQueries();
$villa=$db->services_contracted_villas()
//services_contracted($villaid)
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Residencial Casa Linda - Booking system</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" media="screen">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" media="screen">
	
	<!-- Print css -->
	<link rel="stylesheet" href="css/gistfile1.css" media="print" >

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
			padding: 8px;
			/*line-height: 1;*/
			vertical-align: top;
			border-top: 1px solid #ddd;
			margin-bottom:0px; margin-top:0px;
			padding-bottom:0px; padding-top:0px;
			font-size:12px;
		}
		/*@media print {
		  section {
			width:100%;
		  }
		}*/
	</style>
  </head>
  <body>
	<section>
		<h1>VILLAS AND OWNERS CONTROL</h1>
		
		<div class="table-responsive">
		  <table class="table table-striped" border="1">
		    <tr>
				<th colspan="2" class="success">VILLA</th>
				<th colspan="9" class="warning">SERVICES</th>
				<th  class="danger">TOTAL</th>
				<th colspan="6" class="info">AGREEMENTS / CONTRACTS</th>
			</tr>
			<tr class="active">
				<th class="success">NO.</th>
				<th class="success">BDR</th>
				<th class="warning">SUBDIVISION</th>
				<th class="warning">POOL/GARDEN</th>
				<th class="warning">MAID</th>
				<th class="warning">INTERNET</th>
				<th class="warning">TV CABLE</th>
				<th class="warning">WATER</th>
				<th class="warning">ELECTRICITY</th>
				<th class="warning">ADMIN FEE</th>
				<th class="warning">ACCOUNTING</th>
				<th class="danger">MONTHLY</th>
				<th class="info">RENTAL</th>
				<th class="info">WAIVER OF FEE</th>
				<th class="info">RENTAL GUARANTEE</th>
				<th class="info">SPECIAL</th>
				<th class="info">HOUSE INSURANCE</th>
				<th class="info">OTHER</th>
			</tr>
			<?php 
			$m_gral=0;
			$m_sub=0;
			$m_pg=0;
			$m_maid=0;
			$m_wifi=0;
			$m_tv=0;
			$m_water=0;
			$m_elect=0;
			$m_adm=0;
			$m_acc=0;
			
			foreach($villa AS $k){
				$s=$db->services_contracted($k['id']);
			?>
			<tr>
				<td><?=$k['no']?></td>
				<td><?=$k['bed']?></td>
				<td><?=$s['subdivision']?> <? if($s['subdivisionfee']!='0.00'){ echo "$".$s['subdivisionfee'].""; }?></td>
				<td><?=$s['pool_garden']?> <? if($s['ppool']!='0.00'){ echo "$".$s['ppool'].""; }?></td>
				<td><?=$s['maid']?> <? if($s['pmaid']!='0.00'){ echo "$".$s['pmaid'].""; }?></td>
				<td><?=$s['wifi']?> <? if($s['pinternet']!='0.00'){ echo "$".$s['pinternet'].""; }?></td>
				<td><?=$s['cable']?> <? if($s['ptvcable']!='0.00'){ echo "$".$s['ptvcable'].""; }?></td>
				<td><?=$s['swater']?> <? if($s['pwater']!='0.00'){ echo "$".$s['pwater'].""; }?></td>
				<td><?=$s['electricity']?> <? if($s['pelect']!='0.00'){ echo "$".$s['pelect'].""; }?></td>
				<td><?=$s['admdetails']?> <? if($s['admin_fee']!='0.00'){ echo "$".$s['admin_fee'].""; }?></td>
				<td><?=$s['accdetails']?> <? if($s['acc_fee']!='0.00'){ echo "$".$s['acc_fee'].""; }?></td>
				<td style="text-align:right"><strong>$<?php $total_monthly=$s['subdivisionfee']+$s['ppool']+$s['pmaid']+$s['pinternet']+$s['ptvcable']+$s['pwater']+$s['pelect']+$s['admin_fee']+$s['acc_fee']; echo number_format($total_monthly,2);?></strong></td>
				<td><?=$s['agr_rental']?></td>
				<td><?=$s['agr_waiver']?></td>
				<td><?=$s['agr_rent_gua']?></td>
				<td><?=$s['agr_special']?></td>
				<td><?=$s['insurance']?></td>
				<td><?=$s['agr_other']?></td>
			</tr>
			<?php 
				$m_gral+=$total_monthly;
				$m_sub+=$s['subdivisionfee'];
				$m_pg+=$s['ppool'];
				$m_maid+=$s['pmaid'];
				$m_wifi+=$s['pinternet'];
				$m_tv+=$s['ptvcable'];
				$m_water+=$s['pwater'];
				$m_elect+=$s['pelect'];
				$m_adm+=$s['admin_fee'];
				$m_acc+=$s['acc_fee'];
			} 
			?>
			<tr class="active">
				<th class="success" colspan="2">&nbsp;</th>
				<th class="warning" style="text-align:right">SUBDIVISION</th>
				<th class="warning" style="text-align:right">POOL/GARDEN</th>
				<th class="warning" style="text-align:right">MAID</th>
				<th class="warning" style="text-align:right">INTERNET</th>
				<th class="warning" style="text-align:right">TV CABLE</th>
				<th class="warning" style="text-align:right">WATER</th>
				<th class="warning" style="text-align:right">ELECTRICITY</th>
				<th class="warning" style="text-align:right">ADMIN FEE</th>
				<th class="warning" style="text-align:right">ACCOUNTING</th>
				<th class="danger" style="text-align:right">GENERAL TOTAL</th>
				<th class="info">RENTAL</th>
				<th class="info">WAIVER OF FEE</th>
				<th class="info">RENTAL GUARANTEE</th>
				<th class="info">SPECIAL</th>
				<th class="info">HOUSE INSURANCE</th>
				<th class="info">OTHER</th>
			</tr>
			<tr >
				<th class="success" colspan="2">TOTAL MONTHLY</th>
				<th class="warning" align="right" style="text-align:right">$<?=number_format($m_sub,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_pg,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_maid,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_wifi,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_tv,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_water,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_elect,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_adm,2);?></th>
				<th class="warning" style="text-align:right">$<?=number_format($m_acc,2);?></th>
				<th class="danger" style="text-align:right">$<?=number_format($m_gral,2);?></th>
				<th class="info">&nbsp;</th>
				<th class="info">&nbsp;</th>
				<th class="info">&nbsp;</th>
				<th class="info">&nbsp;</th>
				<th class="info">&nbsp;</th>
				<th class="info">&nbsp;</th>
			</tr>
		  </table>
		</div>


	</section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>