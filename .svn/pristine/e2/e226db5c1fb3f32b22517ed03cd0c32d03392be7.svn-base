<? include('menu_CSS/menu-villas.php');?>
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

		<td class='centro' id="td">% S</td>
		<td class='centro' id="td">% L</td>
		<td class='centro' id="td"><a href="view-interm.php?o=5" alt="">ST.</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=6" alt="">Clients</a></td>
		<td class='centro' id="td"><a href="view-interm.php?o=6" alt="">Bookings</a></td>
		<?
	if ($_SESSION ['info'] ['level'] == 1) {
		?>
		<td class='centro' id="td"><a  alt="">&nbsp;</a></td>
		<?
	}
	?>
	</tr>
<?php
$x = 0;
foreach ( $commisioners as $k ) {
	#echo $customers['4']['name'];
	?>
<tr class="fila<?=$x?>"		onmouseover="this.style.backgroundColor='#87a2fa';"	onmouseout="this.style.backgroundColor=''"	>
		<td id='td'><?=$k ['id']?></td>
		<td class='derecha' id='td'><?=$k ['lastname']?></td>
		<td class='derecha' id='td'><?=$k ['name']?></td>
		<td id='td'><span style="font-size:10px;"><?=$k ['email']?></span></td>

		<td id='td'><?=($k ['percent'] *100)?></td>
		<td id='td'><?=($k ['long_percent'] *100)?></td>
		
<?
	if ($k ['active'] == 1) {
		echo "<td class='centro' id='td'>on</td>";
	} else {
		echo "<td class='centro rojo' id='td'>off</td>";
	}

	/*if ($k ['tipo'] == 1) {
		echo "<td class='centro' id='td'>WebSite</td>";
	} else {
		echo "<td style='color:blue;' class='centro' id='td'><span style=\"font-size:8px;\">Referal&nbsp;Agent</span></td>";
	}*/

	if ($x==0){$x++;} elseif ($x==1){$x--;}
	
	if ($_SESSION ['info'] ['level'] == 1) {
		$customers=$data->show_data('customers', "`id_commission`='".$k['id']."'", 'country');
		$bookings_found=$data->bookings_referal($k['id']);//show bookings per referals
	?>
	<td class='derecha' id='td'><a href="search_clients_referal.php?re=<?=$k['id']?>" alt="" target="_blank"><?=count($customers)?></a></td>
	<td class='derecha' id='td'><a href="search_bookings_referal.php?re=<?=$k['id']?>" alt="" target="_blank"><?=count($bookings_found)?></a></td>
	<td class='derecha' id='td'><a href="edit-interm.php?id=<?=$k ['id']?>" alt="" target="_blank">Edit</a></td>
	
	<?
	}
}
?>


</table>
