<?php require_once('fancybox2.php');
if($_GET['search']==1){
	//ticketsSearch('ticketcancelled');
}else{
	//echo "<p><a href='ticketcancelled.php?search=1'>Show search</a></p>";
}
	if($_POST['buscar']){
		$snr=$_POST['nr'];
		$svilla=$_POST['villa_id'];
		$sdep=$_POST['dep'];
		$ssub=$_POST['subject'];
		$ssta=$_POST['start'];
		$send=$_POST['end'];
	}
	$data= new getQueries ();
	$villasrcl=$data->all_villas();	
?>
<p class="header">Maintenance request history</p>
<p>Villa to Show:
	<select name="toshow" onchange="window.location='emainthistory.php?id='+this.value">
		<option value="0">All Villas</option>
		<? foreach ($villasrcl as $k){?>
			<option value="<?=$k['no']?>" <? if ($k['no']==$_GET['id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
		<? }?>
	 </select></p>
<?php
	if((!$_GET['id']) OR ($_GET['id']=='0')){
		$tickets=$data->emaint($type=1);
	}else{
		$tickets=$data->emaintvilla($no=$_GET['id']);
	}
	
	?>

	<? if ($tickets){
	   /* echo "<pre>";
		print_r($tickets);
		echo "</pre>";*/
		?>
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr class="title">
			
				<td class="tickets">
					<a href="ticketcancelled.php?sort=1" title="" alt="">ID.</a>
				</td>
				
				<td class="tickets">
					<a href="ticketcancelled.php?sort=3" title="" alt="">Who sent</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=4" title="" alt="">When</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=2" title="" alt="">Villa</a>
				</td>
				<td class="tickets">
					<a href="ticketcancelled.php?sort=5" title="" alt="">Details</a>
				</td>
			</tr>
			<?php
			$x=0;
		foreach($tickets AS $k){
			//$username=$data->givemeUsername($proccess['userid']);
			?>
			<tr  class="fila<?=$x?>">
				<td class="tickets">
					<?=$k['id']?>
				</td>
				<td class="tickets">
					<?=$k['desde']?>
				</td>
				<td class="tickets">
					<?/*=$k['fecha']*/?>
				</td>
				<td class="tickets">
					<?=$k['villa']?>
				</td>
				<td class="tickets">
					<? echo "<pre>"; echo $k['detalles']; echo "</pre>";?>
				</td>
			</tr>
		<?php
			if ($x==0){$x++;} elseif ($x==1){$x--;}
		}
		?>
		</table>
		<?php
	}else{
        echo "<p style='text-align:center; color:red; font-size:16px;'>NO MAINTENANCE REQUEST FOUND</p>";
	 }?>