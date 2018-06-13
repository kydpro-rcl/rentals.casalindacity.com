<? include('menu_CSS/menu-admin.php');?>

 <? if (!$_GET['date']){?>
	<h2>Occupation overview for <? if(!$_POST['fecha']){?>today <span style="font-size:10px; color:black;">[<? echo date('M j, Y'); }else{ echo $_POST['fecha']; }?>] </span><span style="font-size:10px; color:blue;"><a href="dailyoccupation.php?date=yes" alt="Go to a different date" title="Go to a different date">Search a date</a></span></h2>
<?}?>

	<? if ($_GET['date']=="yes"){
		
		if(!$_POST['fecha']){ $_POST['fecha']=date('Y-m-d'); }
		
		?>
	
	
	<form method="post" name="date" action="#">
	 <p class="centro" style="font-weight:bold;">DATE <span style="font-size:9px; font-weight:bold; color:blue;">(YYYY-MM-DD)</span>
	 		<input type="text" name="fecha" size="10" value="<?=$_POST['fecha']?>"/>
			<input type="submit" name="go" value="Search" class="book_but"/> <span style="font-size:10px; color:blue;"><a href="dailyoccupation.php" alt="Go to today" title="Go to today">Go to Today</a></span></p>
	</form>
	<?}?>
<hr/>

<?php
$data= new getQueries ();

$villasrenta=$data->villas_for_rent_online2($beds=10);

foreach($villasrenta AS $v){
	$qtybdrs+=$v['bed'];
	$fecha=$_POST['fecha'];
	if(!$_POST['fecha']){
		$fecha=date('Y-m-d');
	}
	
	$BOOKING=$data->occupancyvilladate($villaid=$v['id'], $date=$fecha);
	
	
	if($BOOKING){
		$bdrbusy+=$v['bed'];
		$vbusy+=1;
	}else{
		$bdravai+=$v['bed'];
		$vavai+=1;
	}
}
$gralvilla=count($villasrenta);
?>

<table style="border: 0px solid black;" border="1" cellpadding="2" cellspacing="2">
	<tr>
		<td></td>
		<td><strong>Total qty</strong></td>
		<td><strong>Percent</strong></td>
	</tr>
	<tr>
		<td>Villas total</td>
		<td><?=$gralvilla?></td>
		<td>100%</td>
	</tr>
	<tr>
		<td>Bedrooms total</td>
		<td><?=$qtybdrs?></td>
		<td>100%</td>
	</tr>
	<tr style="background-color:yellow;">
		<td>Villas occupied</td>
		<td><?=$vbusy?></td>
		<td><? $percentvillabusy=(($vbusy*100)/$gralvilla); echo round($percentvillabusy); echo '%'; ?></td>
	</tr>
	<tr style="background-color:yellow;">
		<td>Bedrooms occupied</td>
		<td><?=$bdrbusy?></td>
		<td><? $percentbdrbusy=(($bdrbusy*100)/$qtybdrs); echo round($percentbdrbusy); echo '%'; ?></td>
	</tr>
	<tr style="background-color:lime;">
		<td>Villas Available</td>
		<td><?=$vavai?></td>
		<td><? $percentvillaavailable=(($vavai*100)/$gralvilla); echo round($percentvillaavailable); echo '%'; ?></td>
	</tr>
	<tr style="background-color:lime;">
		<td>Bedrooms Available</td>
		<td><?=$bdravai?></td>
		<td><? $percentbdravailable=(($bdravai*100)/$qtybdrs); echo round($percentbdravailable); echo '%'; ?></td>
	</tr>
</table>
<?php
//save gral info in db and keep id
$ocupacionencontrada=$data->occratesaved($date=date('Y-m-d'));

if(!$ocupacionencontrada){/*only save it if there is no record saved*/
		$link= new subDB (); 
		$inf5=array('vtotal'=>$gralvilla,
					'btotal'=>$qtybdrs,
					'vo'=>$vbusy,
					'bo'=>$bdrbusy,
					'va'=>$vavai,
					'ba'=>$bdravai,
					'date'=>time(),
					'fecha'=>date('Y-m-d'),
					'userid'=>$_SESSION['info']['id'],
					'ip'=>$_SERVER['REMOTE_ADDR']);
		$id_occ=$link->insert_gral($inf5, $table='dailyocc');
}
?>
<p>&nbsp;</p>
<table border="0" align="center" cellpadding="2" cellspacing="2" width="100%" style="border: 2px solid black;">
	<tr>
		<td colspan="3">&nbsp;</td>
		<td colspan="2" align="center" class="title" style="background-color:yellow;">Busy</td>
		<td colspan="2" align="center" class="title" style="background-color:lime;">Available</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="title">Type</td>
		<td class="title">Villa</td>
		<td class="title" >Bdr</td>
		<td class="title" style="background-color:yellow;">Qty House</td>
		
		<td class="title" style="background-color:yellow;">Qty Bdr</td>
		<td class="title" style="background-color:lime;">Qty House</td>
		<td class="title" style="background-color:lime;">Qty Bdr</td>
		<td class="title">Ref</td>
	</tr>
	<?php 
	$c=0;
	$x=0;
	foreach($villasrenta AS $v){
		$qtybdrs2+=$v['bed'];
		$BOOKING=$data->occupancyvilladate($villaid=$v['id'], $date=$fecha);
		if($BOOKING){
			$totalbdrbusy+=$v['bed'];
			$totalvillabusy+=1;
			
			$currentbdrbusy=$v['bed'];
			$currentvillaocc=1;
			$currentbdrdisponible='';
			$currentvilladisponible='';
		}else{
			$totalbdravai+=$v['bed'];
			$totalvillaavai+=1;
			
			$currentbdrbusy='';
			$currentvillaocc='';
			$currentbdrdisponible=$v['bed'];
			$currentvilladisponible=1;
		}
		//================save in database==========================================
		if($fecha==date('Y-m-d')){
			if($id_occ!=''){/*only save if already has an occ total record saved*/
				if($BOOKING['ref']!=''){
					$occupado=1;
				}else{
					$occupado=2;
				}
				$inf6=array('iddailyocc'=>$id_occ,
							'vno'=>$v['no'],
							'vid'=>$v['id'],
							'bdr'=>$v['bed'],
							'occ'=>$occupado,
							'ref'=>$BOOKING['ref'],
							'status'=>$BOOKING['status']);
				$inf_desc=$link->insert_gral($inf6, $table='dailyoccdetails');
			}
		}
		  //===========================save in database================================= 
		?>
	<tr class='fila<?=$x?>'>
		<td><?=$v['type']?></td>
		<td><?=$v['no']?></td>
		<td><?=$v['bed']?></td>
		<td><?=$currentvillaocc?></td>
		<td><?=$currentbdrbusy?></td>
		<td><?=$currentvilladisponible?></td>
		<td><?=$currentbdrdisponible?></td>
		<td><?=$BOOKING['ref']?></td>
	</tr>
	<?php 
		$c++;
		if ($x==0){$x++;} elseif ($x==1){$x--;}
	} ?>
	<tr>
		<th>total</th>
		<th><strong><?=$c?></strong></th>
		<th> <?=$qtybdrs2?> </th>
		
		<th style="background-color:yellow;"><?=$totalvillabusy?></th>
		<th style="background-color:yellow;"><?=$totalbdrbusy?></th>
		<th style="background-color:lime;"><?=$totalvillaavai?></th>
		<th style="background-color:lime;"><?=$totalbdravai?></th>
		<th></th>
	</tr>
	<tr>
		<th>Percent</th>
		<th>100%</th>
		<th>100%</th>
		<th style="background-color:yellow;"><? $percent1=(($totalvillabusy*100)/$c); echo round($percent1); echo '%'; ?></th>
		<th style="background-color:yellow;"><? $percent2=(($totalbdrbusy*100)/$qtybdrs2); echo round($percent2); echo '%'; ?></th>
		<th style="background-color:lime;"><? $percent3=(($totalvillaavai*100)/$c); echo round($percent3); echo '%'; ?></th>
		<th style="background-color:lime;"><? $percent4=(($totalbdravai*100)/$qtybdrs2); echo round($percent4); echo '%'; ?></th>
		<th></th>
	</tr>
</table>