<?php
$data = new getQueries ();
if(!$_GET['o']){
$commisioners = $data->show_all ( 'commission', 'name' );
}else{
	switch($_GET['o']){
		case 1:
			$commisioners = $data->show_all ( 'commission', 'name' );
			break;
		case 2:
			$commisioners = $data->show_all ( 'commission', 'email' );
			break;
		case 3:
		    $commisioners = $data->show_all ( 'commission', 'url' );
			break;
		case 4:
		    $commisioners = $data->show_all ( 'commission', 'phone' );
			break;
		case 5:
			$commisioners = $data->show_all ( 'commission', 'active' );
			break;
		case 6:
			$commisioners = $data->show_all ( 'commission', 'tipo' );
			break;
		case 8:
			$commisioners = $data->show_all ( 'commission', 'lastname' );
			break;
		default:
			$commisioners = $data->show_all ( 'commission', 'id' );
	}
}
?>

<!--<p>&nbsp;</p>-->
<br />
<p class="header">Referral Agents</p>
<p><a href="export_to_excel_referral.php">Export to Excel</a></p>
<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr class="title">
		<td class='centro' id="td"><a href="view-interm.php?o=7" alt="">ID Referral</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=8" alt="">LASTNAME</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=1" alt="">NAME</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=2" alt="">EMAIL</a></td>
		<!--<td class='centro' id="td"><a href="view-interm.php?o=3" alt="">URL</a></td>-->
		<td class='centro' id="td"><a href="view-interm.php?o=4" alt="">PHONE</a></td>
		<td class='centro' id="td">% SHORT</td>
		<td class='centro' id="td">% LONG</td>
		<td class='centro' id="td"><a href="view-interm.php?o=5" alt="">STATUS</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=6" alt="">TYPE</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=6" alt="">Bookings</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=6" alt="">Last date</a></td>

	</tr>
<?php
$x = 0;
foreach ( $commisioners as $k ) {
	#echo $customers['4']['name'];
	?>
<tr class="fila<?=$x?>" <?
	if ($_SESSION ['info'] ['level'] == 1) {
		?>
		onmouseover="this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';"
		onmouseout="this.style.backgroundColor=''"
		onclick="location.href='edit-interm.php?id=<?=$k ['id']?>'" <?
	}
	?>>
		<td id='td'><?=$k ['id']?></td>
		<td class='derecha' id='td'><?=$k ['lastname']?></td>
		<td class='derecha' id='td'><?=$k ['name']?></td>
		<td id='td'><span style="font-size:10px;"><?=$k ['email']?></span></td>
		<!--<td id='td' ><span style="font-size:8px;"><?=$k ['url']?></span></td>-->
		<td id='td'><span style="font-size:10px;"><?=$k ['phone']?></span></td>
		<td id='td'><?=($k ['percent'] *100)?></td>
		<td id='td'><?=($k ['long_percent'] *100)?></td>
<?
	if ($k ['active'] == 1) {
		echo "<td class='centro' id='td'>Active</td>";
	} else {
		echo "<td class='centro rojo' id='td'>Disabled</td>";
	}

	if ($k ['tipo'] == 1) {
		echo "<td class='centro' id='td'>WebSite</td>";
	} else {
		echo "<td style='color:blue;' class='centro' id='td'><span style=\"font-size:8px;\">Referal&nbsp;Agent</span></td>";
	}

	if ($x==0){$x++;} elseif ($x==1){$x--;}
	
	$bookings_found=$data->bookings_referal($k ['id']);//show bookings per referals
	$total_records=$data->getAffectedRows();
	?>
	
	<td id='td'><span style="font-size:10px;"><?=$total_records?></span></td>
<td id='td'><span style="font-size:10px;"><? echo(date('Y-m-d', strtotime($bookings_found[0]['date'])));?></span></td>
</tr>
<?php
}
?>
</table>
