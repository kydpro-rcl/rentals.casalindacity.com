<? include('menu_CSS/menu-admin.php');?>
<script type="text/javascript" src="js/confirm.js"></script>
<?
$data= new getQueries ();
$promotions=$data->show_all('promotion', 'id');
//$users=$data->show_all_different_to('users', $_SESSION['info']['id']);
rsort($promotions); // sort arrays in descending order
	?>
<p class="header">Showing all our promotions</p><hr />
	<table align="center" cellpadding="2" cellspacing="2" border="0">
	<tr class="title">
		<td>id</td>
		<td class='centro' id="td">CODE</td>
		<td class='centro' id="td">QTY</td>
		<td class='centro' id="td">TYPE</td>
		<td class='centro' id="td">TRAVEL FROM</td>
		<td class='centro' id="td">TRAVEL TO</td>
		<td class='centro' id="td">BOOKING FROM</td>
		<td class='centro' id="td">BOOKING TO</td>
		<td class='centro' id="td">STATUS</td>
		<td class='centro' id="td">Min. Nights</td>
		<td class='centro' id="td">Max. Nights</td>
	</tr>
	<?php
	$x=0;
	//onclick=\"location.href='edit-user.php?id=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\"
	foreach ($promotions as $k){
		#echo $customers['4']['name'];
		
		echo "<tr class='fila$x' onclick=\"location.href='edit_promotion.php?oj=".$k['id']."'\" onmouseout=\"this.style.backgroundColor=''\" onmouseover=\"this.style.backgroundColor='#87a2fa'; this.style.cursor='hand';this.style.cursor='pointer';\">"; ?>

		<?php
		echo "<td id='td'>".$k['id']."</td>";
		echo "<td class='derecha' id='td'>".$k['code']."</td>".
		"<td id='td' class='derecha'> ".number_format($k['qty'],0)."</td>";
		if ($k['tipo']==1){echo "<td class='centro' id='td'>Percent</td>";}elseif($k['tipo']==3){ echo "<td class='centro' id='td'>Nights</td>"; }else{echo "<td class='centro' id='td'>Amount</td>"; }

		echo "<td id='td'>".$k['desde']."</td>".
		"<td id='td'>".$k['hasta']."</td>";
		
		echo "<td id='td'>".$k['bookingfrom']."</td>".
		"<td id='td'>".$k['bookingto']."</td>";
		
		 if ($k['active']==1){echo "<td class='centro' id='td'>Active</td>";}else{echo "<td class='centro rojo' id='td'>Disabled</td>"; }

		 if ($x==0){$x++;} elseif ($x==1){$x--;}
		
		echo "<td id='td'>".$k['min_days']."</td>";
		echo "<td id='td'>".$k['max_days']."</td></tr>";
	}
	
	
	echo '</table>';

	?>