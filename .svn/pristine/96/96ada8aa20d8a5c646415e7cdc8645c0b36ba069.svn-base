<? include('menu_CSS/menu-admin.php');?>

<?php
$data= new getQueries ();
$services=$data->show_all('special_events', 'id');
?>
<style>#web-buttons-idk366t a{display:block;color:transparent;} #web-buttons-idk366t a:hover{background-position:left bottom;}a#web-buttons-idk366ta {display:none}</style>
<p class="header" style="text-align:left">Booking system - Special Events Management </p>

<p id="web-buttons-idk366t"><a href="special_events_new.php" title="Create a new Event " style="background-image:url(images/btk366t.png);width:173px;height:35px;display:block;"><br/></a></p>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="90%">
	<tr class="title" >
		<td class='centro' id="td">NAME</td>
		<td class='centro' id="td">FROM</td>
		<td class='centro' id="td">TO</td>
		<td class='centro' id="td">QTY</td>
		<td class='centro' id="td">TYPE</td>
		<td class='centro' id="td">ACTION</td>
		<td class='centro' id="td">ACTIVE</td>
		<td>&nbsp;</td></tr>
<?php
$x=0;
	foreach ($services as $k){
	#echo $customers['4']['name'];
	?>
	<tr class="fila<?=$x?>">
		<td class="derecha" id='td'><?=$k['name']?></td>
		<td class="derecha" id='td'><?=date('l j \of F Y',strtotime($k['from_date']))?></td>
		<td class='centro' id='td'><?=date('l j \of F Y',strtotime($k['to_date']))?> </td>
		<td class='derecha' id='td'><?=$k['qty']?></td>
		<td class='derecha' ><? if ($k['type']==1){ echo "Percentage";}else{ echo "Amount"; } ?></td>
		<td class='derecha' ><? if($k['increase']==1){ echo "Increase"; }else{ echo "Decrease"; }?></td>



	<?
		if ($k['active']==1){
			?>
			<td class='centro' id='td'>Active</td>
			<?
		}else{
			?>
			<td class='centro rojo' id='td'>Disabled</td>
		<?
		}
		?>

	  <td><a href="special_events_edit.php?id=<?=$k['id']?>">Edit</a></td>

	 <?
	 if ($x==0){$x++;} elseif ($x==1){$x--;}
	 ?>

	  </tr>
	 <?
	}
	?>


	</table>
