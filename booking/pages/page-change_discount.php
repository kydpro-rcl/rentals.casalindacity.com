<? include('menu_CSS/menu-admin.php');?>

<p class="header">Change Discount</p>

	<form method="post" action="change_discount.php" >
		<p style="font-size:10px; padding-left:15px;">Reference number:<input type="text" name="ref" value="<?=$_POST['ref']?>"/><input class="book_but" type="submit" name="go" value="go"/></p>

	</form>
<hr />
<? if ($_POST){?>



	<?php
	$data= new getQueries ();
	$_POST['ref']=str_pad($_POST['ref'], 9, "0", STR_PAD_LEFT);
	//$invoices=$data->show_any_data('invoice', 'ref', $_POST['ref'], '=');
	$book=$data->see_occupancy_ref($_POST['ref']); 
	//$total_records=$data->getAffectedRows();?>

	<? if (!empty($book)){
		$v=$data->villa($book[0]['villa']);
		?>
			<table  align="center" cellpadding="2" cellspacing="2" border="0">
				<tr class="title">
					<td class='centro' id="td">REFERENCE</td>
					<td class='centro' id="td">CHECKIN</td>
					<td class='centro' id="td">CHECKOUT</td>
					<td class='centro' id="td">VILLA</td>
					<td class='centro' id="td">DATE</td>
					<td class='centro' id="td">NIGHTS</td>
					<td class='centro' id="td">STATUS</td>
					<td class='centro' id="td">&nbsp;</td>
				</tr>

			<?
			$x=0;
			$link= new DB();
			if($book[0]){
			$k=$book[0];
			
			/*echo "<pre>";
			print_r($k);
			echo "</pre>";*/
			#echo $customers['4']['name'];
			?>
			<tr class='fila<?=$x?>' >
				<td id='td'><?=$k['ref']?></td>
				<td id='td'><?=$k['start']?></td>
				<td id='td'><?=$k['end']?></td>
				<td id='td'><?=$v[0]['no']?></td>
				<td id='td'><?=$k['date']?></td>
				<td id='td'><?=$k['nights']?></td>
				<td id='td'>
				<?php
					$estados=select_status();
					$estado_actual=$k['status'];
				?>
					<select name="">
						<?php 
						foreach($estados AS $k=>$v){?>
							<option value="<?=$k?>" <? if($estado_actual==$k){ echo 'Selected="selected"'; } ?>><?=$v?></option>
						<?}?>
					</select><?/*=$k['status']*/?>
				</td>
				<td id='td'><input type="submit" name="change" value="Change"/></td>
			</table>

			<?}
		}else{ echo "<h2>No booking found</h2>";}?>
<? }?>