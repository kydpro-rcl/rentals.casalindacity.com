<p class="header">NEW TICKET</p>
<?php
	$data= new getQueries ();
	
	$villasrcl=$data->all_villas();
	
	?>
<?php if(!$_GET['success']){?>

<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
<form method="post" action="ticketnew_mobile.php">
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr >
				<td>
					Villa:
				</td>
				<td>
					 <select name="villa_id">
						<? foreach ($villasrcl as $k){?>
							<option value="<?=$k['id']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
						<? }?>
					</select>
					Villa Status: 
					<select name="villastatus" ><!--onchange="window.location='ticketnew.php?villas='+this.value"-->
						<option value="1">Empty</option>
						<option value="2">Occupied</option>
						<option value="3">Arriving</option>
					</select>
					 If arriving, date:<input type="text" name="arrivingdate" value="<?=date('Y-m-d')?>"/>
				</td>
			</tr>
			<tr >
				<td>
					Need
				</td>
				<td>
					<select name="subject" >
						<?php
						$options=tickets_subjects();
						foreach($options as $k=>$v){?>
							<option value="<?=$k?>"
							<?php if(($k==1)||($k==26)||($k==27)||($k==28)||($k==39)||($k==40)||($k==42)||($k==43)||($k==44)||($k==59)||($k==60)||($k==61)){?>
							disabled
							<?}?>
							><?=$v?></option>
						<?php
						}
						?>
					</select>
					Priority:
					<select name="priority">
						<option value="1">Immediately (Urgent)</option>
						<option value="2">Level 1 - (Top priority)</option>
						<option value="3">Level 2 - (Important)</option>
						<option value="4">Level 3 - (As possible)</option>
					</select>
				</td>
			</tr>
			<tr >
				<td>
					Details
				</td>
				<td>
					<textarea name="details" cols="50" rows="10" required="required"></textarea>
				</td>
			</tr>
				<tr >
				<td colspan=2>
				<input type="submit" name="create" value="Create Ticket">
				</td>
			</tr>
		</table>
</form>
<?php }else{
	echo "<p style='text-align:center; color:red; font-size:16px;'>".$_GET['success']."</p>";
}