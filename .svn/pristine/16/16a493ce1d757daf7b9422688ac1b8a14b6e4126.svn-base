

<div class="art-box-body art-post-body">
<p>&nbsp;</p>
 <? if(!$_GET['msg']){?>
  <form  method="post" ation="new_item.php">
  <input type="hidden" name="item" value="<?=$_GET['i']?>"/>
  <?
    if($_GET['i']){    	if($_GET['i']!=1){/*si no es crear una villa*/          $data=new Consultas();
          $villas=$data->consulta_activos($table='villa');    	}    }

  ?>
	  <? switch($_GET['i']){	     	case 1:?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CREATING A NEW VILLA</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2"><input type="text" name="villa" value=""/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" colspan="2" align="right"><input type="submit" name="submit" value="Create"/></td>
		   	</tr>
		   </table>
	    <? break;
	  		case 2:?>


		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CREATING A NEW DOC #</b></td>
		   	</tr>

		   		<tr class="row_head2">
		   		<td class="cell2">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>"><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2">Doc. No.</td>
		   		<td class="cell2"><input type="text" name="doc" value=""/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" colspan="2" align="right"><input type="submit" name="submit" value="Create"/></td>
		   	</tr>
		   </table>
	  <? break;
	  		case 3:?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="4" align="center" style="background-color:#58c1df;"><b>CREATING DETAILS OF CONSTRUCTION</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>"><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
			  		<td class="cell2" align="right">Builder:</td>
		   		<td class="cell2" align="left"><input type="text" name="build" value=""/></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Rental</td>
		   		<td class="cell2" align="left">
		   		       <select name="rental">
		   		           <option value="1">Not known</option>
		   		           <option value="2">Prospect</option>
		   		           <option value="3">Yes</option>
		   		           <option value="4">No</option>
		   		       </select>
		   		</td>
		   		<td class="cell2" align="right">Stage</td>
		   		<td class="cell2" align="left">
		   		     <select name="stage">
		   				   <option value="0">&nbsp;</option>
		   		     	   <option value="1">Under construction</option>
		   		           <option value="2">Near completion</option>
		   		           <option value="3">Owner occupied</option>
		   		       </select>
		   		</td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Delivered:</td>
		   		<td class="cell2" align="left">
		   			<select name="delivered">
		   		           <option value="0">No</option>
		   		           <option value="1">Yes</option>
		   		     </select></td>
		   		<td class="cell2" align="right">Date delivered:</td>
		   		<td class="cell2" align="left"><?=fecha_insert($name_add='1', $fecha=date('Y-m-d'))?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Deficiencies Promised:</td>
		   		<td class="cell2" align="left"><?=fecha_insert($name_add='2', $fecha)?></td>
		   		<td class="cell2">&nbsp;</td>
		   		<td class="cell2">&nbsp;</td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="4" align="right"><input type="submit" name="submit" value="Create"/></td>
		   	</tr>
		   </table>
	  <? break;
	  		case 4:?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="2" align="center" style="background-color:#58c1df;"><b>CREATING A DEFICIENCY</b></td>
		   	</tr>
		   	<tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>"><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Details of deficiency</td>
		   		<td class="cell2" align="left"><textarea name="deficiency" cols="80" rows="10"></textarea></td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="2" align="right"><input type="submit" name="submit" value="Create"/></td>
		   	</tr>
		   </table>
	  <? break;
	  		case 5:?>
		 <table border="0" cellspacing="0" align="center" class="main_table2" >
		   <tr class="row_head2">
		   		<td class="cell2" colspan="6" align="center" style="background-color:#0091c0;"><b>CREATING A NEW MAINTENANCE</b></td>
		   	</tr>
		   <tr class="row_head2">
		   		<td class="cell2" align="right">Villa No.</td>
		   		<td class="cell2" align="left"><?
			  		if($villas){?>
			  		<select name="villa_id">
			  			<? foreach($villas AS $k){?>
			  			 <option value="<?=$k['id']?>"><?=$k['no']?></option>
			  			<?}?>
			  		</select>
			  		<?}?></td>
			  		<td class="cell2" align="right">Title</td>
			  		<td class="cell2" align="left">
			  		   <select name="title">
		   		     	   <option value="1">Renovation</option>
		   		           <option value="2">Repairing pool</option>
		   		           <option value="3">Regular maintenance</option>
		   		           <option value="4">Painting the house</option>
		   		           <option value="5">Appliance repair</option>
		   		           <option value="6">Roof filtration</option>
		   		           <option value="7">Deep cleaning</option>
		   		       </select>
			  		</td>
			  		<td class="cell2" align="right">Importance</td>
			  		<td class="cell2" align="left">
			  		   <select name="prio">
		   		     	   <option value="1">Very high</option>
		   		           <option value="2">High</option>
		   		           <option value="3">Medium</option>
		   		           <option value="4">Low</option>
		   		       </select>
			  		</td>
		   	</tr>
		   	 <tr class="row_head">
		   		<td class="cell2" align="right">From.</td>
		   		<td class="cell2" align="left" colspan="5"><!--//<input type="text" name="from" value=""/>//--><?=escribe_fecha_hora($name_add='f')?></td>
		   	</tr>
		   	<tr class="row_head">
			  		<td class="cell2" align="right">Until:</td>
			  		<td class="cell2" align="left" colspan="5"><!--//<input type="text" name="until" value=""/>//--><?=escribe_fecha_hora($name_add='u')?></td>
		   	</tr>
		   		<tr class="row_head2">
		   		<td class="cell2" align="right">Note:</td>
		   		<td class="cell2" align="left" colspan="5"><textarea name="note" cols="80" rows="10"></textarea></td>
		   	</tr>
		   	<tr class="row_head">
		   		<td class="cell2" colspan="6" align="right"><input type="submit" name="submit" value="Create"/></td>
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