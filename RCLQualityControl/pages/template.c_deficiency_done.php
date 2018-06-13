

<div class="art-box-body art-post-body">
<p>&nbsp;</p>
  	 <?   $data=new Consultas();
	  		$villas=$data->consulta_def_done();
	     	?>
		 <table border="0" cellspacing="2" cellspacing="2" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="7" align="center" style="background-color:blue;"><b>SHOWING DEFICIENCIES DONE</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2">Details</td>
		   		<td class="cell2">Status</td>
		   		<td class="cell2">Date</td>
		   		<td class="cell2">Created by</td>
                <td class="cell2">Done by</td>
                <td class="cell2">Done date</td>
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
			   		<td><?
			   		  $d=$data->SeeTable($table='deficiencies_done', $condition_sql='id_def='.$k['id'], $order_field='id', $order_type='ASC');
			   		  $ud=$data->get_id($id=$d[0]['user_id'], $table='users'); ?> <?=$ud['name']?> </td>
			   		  <td><?=fecha($d[0]['date'])?></td>
			   	</tr>
			<?
			if ($x==0){$x++;} elseif ($x==1){$x--;}
			}?>
		   </table>
 <p>&nbsp;</p>

</div>