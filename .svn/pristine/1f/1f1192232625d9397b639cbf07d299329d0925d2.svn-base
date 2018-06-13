

<div class="art-box-body art-post-body">
<p>&nbsp;</p>
 <? if(!$_GET['msg']){?>
  <form  method="post" ation="modify_item.php">
  <input type="hidden" name="item" value="<?=$_GET['i']?>"/>
  <?
    if(($_GET['i'])&&($_GET['id'])){      $data=new Consultas();
      $villas=$data->consulta_activos($table='villa');    }

  ?>
	  <? switch($_GET['i']){	     	case 1:
             $ki=$data->get_id($id=$_GET['id'], $table='villa');
	     	?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CHANGING VILLA</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2"><input type="text" name="villa" value="<?=$ki['no']?>"/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" colspan="2" align="right">
		   		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		   		<input type="submit" name="submit" value="Update"/>
		   		</td>
		   	</tr>
		   </table>
	    <? break;
	  		case 2:
	  		  $ki=$data->get_id($id=$_GET['id'], $table='doc_number');
	  		?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CHANGING DOC #</b></td>
		   	</tr>

		   		<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>" <? if($ki['id_villa']==$k['id']){?> selected="selected" <?}?> ><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Doc. No.</td>
		   		<td class="cell2"><input type="text" name="doc" value="<?=$ki['doc_no']?>"/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" colspan="2" align="right">
		   		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		   		<input type="submit" name="submit" value="Update"/>
		   		</td>
		   	</tr>
		   </table>
	  <? break;
	  		case 3:
	  		  $ki=$data->get_id($id=$_GET['id'], $table='villa_details');
	  		?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="4" align="center" style="background-color:#58c1df;"><b>CHANGING DETAILS OF CONSTRUCTION</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>" <? if($ki['id_villa']==$k['id']){?> selected="selected" <?}?>><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
			  		<td class="cell2" align="right">Builder:</td>
		   		<td class="cell2" align="left"><input type="text" name="build" value="<?=$ki['builder']?>"/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Rental</td>
		   		<td class="cell2" align="left">
		   		       <select name="rental">
		   		           <option value="1" <? if($ki['rental']=='1'){?> selected="selected" <?}?>>Not known</option>
		   		           <option value="2" <? if($ki['rental']=='2'){?> selected="selected" <?}?>>Prospect</option>
		   		           <option value="3" <? if($ki['rental']=='3'){?> selected="selected" <?}?>>Yes</option>
		   		           <option value="4" <? if($ki['rental']=='4'){?> selected="selected" <?}?>>No</option>
		   		       </select>
		   		</td>
		   		<td class="cell2" align="right">Stage</td>
		   		<td class="cell2" align="left">
		   		     <select name="stage">
		   		      		<option value="0" <? if($ki['stage']=='0'){?> selected="selected" <?}?>>&nbsp;</option>
		   		     	   <option value="1" <? if($ki['stage']=='1'){?> selected="selected" <?}?>>Under construction</option>
		   		           <option value="2" <? if($ki['stage']=='2'){?> selected="selected" <?}?>>Near completion</option>
		   		           <option value="3" <? if($ki['stage']=='3'){?> selected="selected" <?}?>>Owner occupied</option>
		   		       </select>
		   		</td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Delivered:</td>
		   		<td class="cell2" align="left">
		   			<select name="delivered">
		   		           <option value="0" <? if($ki['delivered']=='0'){?> selected="selected" <?}?>>No</option>
		   		           <option value="1" <? if($ki['delivered']=='1'){?> selected="selected" <?}?>>Yes</option>
		   		     </select></td>
		   		<td class="cell2" align="right">Date delivered:</td>
		   		<td class="cell2" align="left"><?=fecha_insert($name_add='1', $fecha=$ki['deliver_date'])?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Deficiencies Promised:</td>
		   		<td class="cell2" align="left"><?=fecha_insert($name_add='2', $fecha=$ki['promised'])?></td>
		   		<td class="cell2">&nbsp;</td>
		   		<td class="cell2">&nbsp;</td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="4" align="right">
		   		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		   		<input type="submit" name="submit" value="Update"/>
		   		</td>
		   	</tr>
		   </table>
	  <? break;
	  		case 4:
	  		 $ki=$data->get_id($id=$_GET['id'], $table='deficiencies');
	  		?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CHANGING A DEFICIENCY</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>" <? if($ki['id_villa']==$k['id']){?> selected="selected" <?}?>><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Details of deficiency</td>
		   		<td class="cell2" align="left"><textarea name="deficiency" cols="80" rows="10"><?=$ki['details']?></textarea></td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="2" align="right">
		   		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		   		<input type="submit" name="submit" value="Update"/>
		   		</td>
		   	</tr>
		   </table>
	  <? break;
	  		case 5:
	  		 $ki=$data->get_id($id=$_GET['id'], $table='maintenance');
	  		?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="6" align="center" style="background-color:#0091c0;"><b>CHANGING MAINTENANCE</b></td>
		   	</tr>
		   <tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>" <? if($ki['id_villa']==$k['id']){?> selected="selected" <?}?>><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
			  		<td class="cell2" align="right">Title</td>
			  		<td class="cell2" align="left">
			  		   <select name="title">
		   		     	   <option value="1" <? if($ki['title']=='1'){?> selected="selected" <?}?>>Renovation</option>
		   		           <option value="2" <? if($ki['title']=='2'){?> selected="selected" <?}?>>Repairing pool</option>
		   		           <option value="3" <? if($ki['title']=='3'){?> selected="selected" <?}?>>Regular maintenance</option>
		   		           <option value="4" <? if($ki['title']=='4'){?> selected="selected" <?}?>>Painting the house</option>
		   		           <option value="5" <? if($ki['title']=='5'){?> selected="selected" <?}?>>Appliance repair</option>
		   		           <option value="6" <? if($ki['title']=='6'){?> selected="selected" <?}?>>Roof filtration</option>
		   		           <option value="7" <? if($ki['title']=='7'){?> selected="selected" <?}?>>Deep cleaning</option>
		   		       </select>
			  		</td>
			  		<td class="cell2" align="right">Importance</td>
			  		<td class="cell2" align="left">
			  		   <select name="prio">
		   		     	   <option value="1" <? if($ki['priority']=='1'){?> selected="selected" <?}?>>Very high</option>
		   		           <option value="2" <? if($ki['priority']=='1'){?> selected="selected" <?}?>>High</option>
		   		           <option value="3" <? if($ki['priority']=='1'){?> selected="selected" <?}?>>Medium</option>
		   		           <option value="4" <? if($ki['priority']=='1'){?> selected="selected" <?}?>>Low</option>
		   		       </select>
			  		</td>
		   	</tr>
		   	 <tr class="row_head">
		   		<td class="cell2" align="right">From.</td>
		   		<td class="cell2" align="left" colspan="5"><!--//<input type="text" name="from" value="<?=$ki['desde']?>"/>//--><?=modifica_fecha_hora($name_add='f',$ki['desde'])?></td>
		   	</tr>
		   	<tr class="row_head">
		   			<td class="cell2" align="right">Until:</td>
			  		<td class="cell2" align="left" colspan="5"><!--//<input type="text" name="until" value="<?=$ki['hasta']?>"/>//--><?=modifica_fecha_hora($name_add='u',$ki['hasta'])?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Note:</td>
		   		<td class="cell2" align="left" colspan="5"><textarea name="note" cols="80" rows="10"><?=$ki['note']?></textarea></td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="6" align="right">
		   		<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
		   		<input type="submit" name="submit" value="Update"/>
		   		</td>
		   	</tr>
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