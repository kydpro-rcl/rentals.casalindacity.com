<p class="header">EDIT TICKET <?=$_GET['t']?></p>
<?php
	$data= new getQueries ();
	$villasrcl=$data->all_villas();
	$ticket=$data->singleTicket($ticketid=$_GET['t']);
	
	?>
<?php if(!$_GET['success']){?>

<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
<form method="post" action="ticketedit.php">
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr >
				<td>
					Villa:
				</td>
				<td>
					<select name="villa_id">
						<? foreach ($villasrcl as $k){?>
							<option value="<?=$k['id']?>" <? if ($k['id']==$ticket['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
						<? }?>
					</select>
					Villa Status: 
					<select name="villastatus">
						<option value="1"  <? if ($ticket['villastatus']==1){ echo 'selected="selected"';}?>>Empty</option>
						<option value="2"  <? if ($ticket['villastatus']==2){ echo 'selected="selected"';}?>>Occupied</option>
						<option value="3"  <? if ($ticket['villastatus']==3){ echo 'selected="selected"';}?>>Arriving</option>
					</select>
					If arriving, date:<input type="text" name="arrivingdate" value="<?=$k['arrivalsdate']?>"/>
				</td>
			</tr>
			<tr >
				<td>
					Need
				</td>
				<td>
					<select name="subject" >
						<?php
						$options=tickets_subjects_maint();
						foreach($options as $k=>$v){
							?>
							<option value="<?=$k?>" <?php if(($k==1)||($k==26)||($k==27)||($k==28)||($k==39)||($k==40)||($k==42)||($k==43)||($k==44)||($k==59)||($k==60)||($k==61)){ echo "disabled"; } if($k==$ticket['subject']){ echo 'selected="selected"'; }?>><?=$v?></option>
						<?php
						}
						?>
					</select>
					Priority:
					<select name="priority">
						<option value="1" <? if ($ticket['priority']==1){ echo 'selected="selected"';}?>>Immediately (Urgent)</option>
						<option value="2" <? if ($ticket['priority']==2){ echo 'selected="selected"';}?>>Level 1 - (Top priority)</option>
						<option value="3" <? if ($ticket['priority']==3){ echo 'selected="selected"';}?>>Level 2 - (Important)</option>
						<option value="4" <? if ($ticket['priority']==4){ echo 'selected="selected"';}?>>Level 3 - (As possible)</option>
					</select>
				</td>
			</tr>
			<tr >
				<td>
					Details
				</td>
				<td>
					<textarea name="details" cols="50" rows="10" required="required"><?=$ticket['details']?></textarea>
					<input type="hidden" name="ticketno" value="<?=$ticket['id']?>"/>
					<input type="hidden" name="status" value="<?=$ticket['status']?>"/>
				</td>
			</tr>
				<tr >
				<td colspan=2>
				<input type="submit" name="create" value="Change Ticket">
				</td>
			</tr>
		</table>
</form>
<?php }else{
	echo "<p style='text-align:center; color:red; font-size:16px;'>".$_GET['success']."</p>";
}