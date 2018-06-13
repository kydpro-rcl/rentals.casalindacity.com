

<div class="art-box-body art-post-body">
<p>&nbsp;</p>
 <? if(!$_GET['msg']){?>
  <form  method="post" ation="modify_item.php">
  <input type="hidden" name="item" value="<?=$_GET['i']?>"/>
  <?
    if($_GET['i']){       $data=new Consultas();    }

  ?>
	  <? switch($_GET['i']){	     	case 1:
	     	 $villas=$data->consulta_activos($table='villa');
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>SHOWING VILLAS</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
                <td class="cell2">&nbsp;</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($villas AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><?=$k['no']?></td>
			   		<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
	    <? break;
	  		case 2:
	  		$villas=$data->consulta_v($table='doc_number');
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="3" align="center" style="background-color:#58c1df;"><b>SHOWING DOC #</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Doc #.</td>
		   		<td class="cell2">Villa No.</td>
                <td class="cell2">&nbsp;</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($villas AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><?=$k['doc_no']?></td>
			   		<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no'];?></td>
			   		<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
	  <? break;
	  		case 3:
	  		$villas=$data->consulta($table='villa_details');
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="7" align="center" style="background-color:#58c1df;"><b>SHOWING DETAILS OF CONSTRUCTION</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2">Builder</td>
		   		<td class="cell2">Stage</td>
		   		<td class="cell2">Rental</td>
		   		<td class="cell2">Delivered</td>
		   		<td class="cell2">Def. Promised</td>
                <td class="cell2">&nbsp;</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($villas AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>
			   		<td class="cell2" align="center"><?=$k['builder']?></td>
			   		<td class="cell2" align="center"><?
			   		   switch($k['rental']){
				   			case 2: echo 'Prospect';
				   					break;
				   			case 3: echo 'Yes';
				   					break;
				   			case 4: echo 'No';
				   					break;
				   		}
			   		?></td>
			   		<td class="cell2" align="center"><?
			   		     switch($k['stage']){
				   			case 1: echo 'Under construction';
				   					break;
				   			case 2: echo 'Near completion';
				   					break;
				   			case 3: echo 'Owner occupied';
				   					break;
				   		}
			   		?></td>
			   		<td class="cell2" align="center"><? if($k['delivered']==1){echo "Yes";?> (<?=date("d M Y",strtotime($k['deliver_date']))?>)<?}?></td>
			   		<td class="cell2" align="center"><?if($k['promised']!='1969-12-31'){?> <?=date("d M Y",strtotime($k['promised']));?> <?}?></td>
			   		<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
	  <? break;
	  		case 4:
	  		/*$villas=$data->consulta($table='deficiencies'); */
	  		$villas=$data->consulta_def_undone();
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="6" align="center" style="background-color:#58c1df;"><b>SHOWING DEFICIENCIES</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2">Details</td>
		   		<td class="cell2">Status</td>
		   		<td class="cell2">Date</td>
		   		<td class="cell2">Created by</td>
                <td class="cell2">&nbsp;</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($villas AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>
			   		<td class="cell2" align="left"><?=$k['details']?></td>
			   		<td class="cell2" align="center"><? if($k['status']==1){ echo 'pending';}else{ echo 'Done';}?></td>
			   		<td class="cell2" align="center"><?=fecha($k['date'])?></td>
			   		<td class="cell2" align="center"><? $us=$data->get_id($id=$k['user_id'], $table='users'); echo $us['name']?></td>
			   		<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
	  <? break;
	  		case 5:
	  		$villas=$data->consulta_v($table='maintenance');
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="8" align="center" style="background-color:#58c1df;"><b>SHOWING MAINTENACE</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2">Title</td>
		   		<td class="cell2">Note</td>
		   		<td class="cell2">Priority</td>
		   		<td class="cell2">From</td>
		   		<td class="cell2">Until</td>.
		   		<td class="cell2">by</td>
                <td class="cell2">&nbsp;</td>
		   	</tr>
		   	<?
		   	$x=0;
		   	foreach($villas AS $k){?>
			   	<tr class="fi<?=$x?>">
			   		<td class="cell2" align="center"><? $vi=$data->get_id($id=$k['id_villa'], $table='villa'); echo $vi['no']; ?></td>
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
			   		<td><a href="modify_item.php?i=<?=$_GET['i']?>&id=<?=$k['id']?>">Edit</a></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
	  <? break;
	  		/*case 2:*/
	  } ?>
  </form>
 <?}else{?>
  <h2 class="msg"><?=$_GET['msg']?></h2>
 <?}?>
 <p>&nbsp;</p>

</div>