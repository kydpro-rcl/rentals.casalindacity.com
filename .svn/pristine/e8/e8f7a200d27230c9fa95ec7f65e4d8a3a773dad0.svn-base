<?session_start();
if ($_SESSION['rqc']){?>

<html>

<head>
  <title></title>
</head>

<body>
 <div style="width:800px;">
<?php

require_once('inc/all_files.php');
$data=new Consultas();
$k['id']=$_GET['v'];

	if($_GET['i']=='m'){ /*if maintenance*/
		/*$maint=$data->SeeTable($table='maintenance', $condition_sql='id_villa='.$k['id'].' AND active=\'1\'', $order_field='id', $order_type='ASC');// show maintenances*/
		/*$ma=$maint[0];
		echo $ma['note'].'<br/>'; */
		$fecha_de_ahora=date("Y-m-d G:i:s");
        $maint=$data->SeeTable($table='maintenance', $condition_sql='id_villa='.$k['id'].' AND active=\'1\' AND  	desde<=\''.$fecha_de_ahora.'\' AND hasta>=\''.$fecha_de_ahora.'\'', $order_field='id', $order_type='ASC');

		?>
		     <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" width="100%">
		   <!--//<tr class="row_head2">
		   		<td class="cell2" colspan="7" align="center" style="background-color:#58c1df;"><b>SHOWING MAINTENACE</b></td>
		   	</tr>//-->
		   	<tr class="row_head2">
		   		<!--//<td class="cell2">Villa No.</td>//-->
		   		<td class="cell2">Title</td>
		   		<td class="cell2">Note</td>
		   		<td class="cell2">Priority</td>
		   		<td class="cell2">From</td>
		   		<td class="cell2">Until</td>
		   		<td class="cell2">By</td>
               <!--// <td class="cell2">&nbsp;</td>//-->
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($maint AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<!--//<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>//-->
			   		<td class="cell2" align="center">
			   		<? switch($k['title']){
			   			case 1: echo 'Renovation';
			   					break;
			   		    case 2:echo 'Repairing pool';
			   					break;
			   			case 3:echo 'Regular maintenance';
			   					break;
			   			case 4: echo 'Painting the house';
			   					break;
			   			case 5: echo 'Appliance repair';
			   					break;
			   			case 6: echo 'Roof filtration';
			   					break;
			   			case 7: echo 'Deep cleaning';
			   					break;
			   		}?>
	   				</td>
			   		<td class="cell2" align="left"><?=$k['note']?></td>
			   		<td class="cell2" align="center">
			   		<? switch($k['priority']){
			   			case 1: echo 'Very high';
			   					break;
			   		    case 2:echo 'High';
			   					break;
			   			case 3:echo 'Medium';
			   					break;
			   			case 4: echo 'Low';
			   					break;
			   		}?>
			   		</td>
			   		<td class="cell2" align="center"><?=fecha_h($k['desde']);?></td>
			   		<td class="cell2" align="center"><?=fecha_h($k['hasta'])?></td>
			   		<td class="cell2" align="center"><? $us=$data->get_id($id=$k['user_id'], $table='users'); echo $us['name']?></td>
			   		<!--//<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>//-->
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
		<?
	}
    //=================================================================================================================================================================
	if($_GET['i']=='d'){ /*if deficiencies*/
		$defi=$data->SeeTable($table='deficiencies', $condition_sql='id_villa='.$k['id'].' AND status=\'1\'', $order_field='id', $order_type='ASC'); // show deficiencies
		 $count=0;

		 /*
		foreach($defi AS $d){			$count++;			echo $count.'- '.$d['details'].'<br/>';		}*/
		?>
		  <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" width="100%">
		   <!--//<tr class="row_head2">
		   		<td class="cell2" colspan="6" align="center" style="background-color:#58c1df;"><b>SHOWING DEFICIENCIES</b></td>
		   	</tr>//-->
		   	<tr class="row_head2">
		   		<!--//<td class="cell2">Villa No.</td>//-->
		   		<td class="cell2">&nbsp;</td>
		   		<td class="cell2">Details</td>
		   		<td class="cell2">Status</td>
		   		<td class="cell2">Date</td>
		   		<td class="cell2">Created by</td>
                <!--//<td class="cell2">&nbsp;</td>//-->
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($defi AS $k){		   		 $count++;
		   		?>
			   	<tr class="fi<?=$x?>">
			   		<!--//<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>//-->
			   		<td class="cell2" align="left"><?=$count?></td>
			   		<td class="cell2" align="left"><?=$k['details']?></td>
			   		<td class="cell2" align="center"><? if($k['status']==1){ echo 'pending';}else{ echo 'Done';}?></td>
			   		<td class="cell2" align="center"><?=fecha($k['date'])?></td>
			   		<td class="cell2" align="center"><? $us=$data->get_id($id=$k['user_id'], $table='users'); echo $us['name']?></td>
			   		<!--//<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>//-->
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
		<?
	}

?>
</div>
</body>

</html>

<?}else{
	header('Location:login.php');
	die();
}?>