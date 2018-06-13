<p class="header">NEW MAINTENANCE REQUEST</p>
<?php
	$data= new getQueries ();
	
	$villasrcl=$data->all_villas();
	
	?>
<?php if(!$_GET['success']){?>

<? if($_GET['error']){?>

		<p style="text-align:center;font-size:16px;background-color:yellow; margin:5px; padding:5px;"><?php echo $_GET['error'];?></p>
		
		<? }?>
<form method="post" action="emaint.php">
		<table align="center" cellpadding="2" cellspacing="2" border="0" >
			<tr >
				<td>
					Villa:
					<select name="villa_no">
						<? foreach ($villasrcl as $k){?>
							<option value="<?=$k['no']?>" <? if ($k['id']==$_POST['villa_id']){ echo 'selected="selected"';}?>><?=$k['no']?></option>
						<? }?>
					</select>
				</td>
				<td>
					 Problem type:
					<select class="form-control" name="problem" required>
						<option value="">Select</option>
						<option value="Pool and Garden Package">Pool and Garden package</option>
						<option value="AC">AC</option>
						
						<option value="appliances">appliances</option>
						<option value="carpentry">carpentry</option>
						<option value="electrical">electrical</option>
						<option value="doors/windows">doors/windows</option>
						<option value="gas">gas</option>
						<option value="jacuzzi">jacuzzi</option>
						<option value="lights">lights</option>
						<option value="masonry/tiles">masonry/tiles</option>
						<option value="not hot water">not hot water</option>
						<option value="not water">not water</option>
						<option value="painting">painting</option>
						<option value="pipes and drains">pipes and drains</option>
						<option value="pump">pump</option>
						<option value="safe">safe</option>
						<option value="TV">TV</option>
						<option value="inspection">inspection</option>
						<option value="New quote">new quote</option>
						<option value="others">others</option>
						
					</select>
				</td>
			</tr>
			<tr >
				<td colspan="2">Detail every separete item in the villa<br/>
					<!--<textarea name="details" cols="70" rows="10" required="required"></textarea>-->
					<?php
					for($i=1; $i<=6; $i++){?>
					<p>Item <?=$i?>: <input type="text" size="70" name="item<?=$i?>" /></p>
					<? }?>
				</td>
			</tr>
				<tr >
				<td colspan=2>
				<input type="submit" name="create" value="Send request">
				</td>
			</tr>
		</table>
</form>
<?php }else{
	echo "<p style='text-align:center; color:red; font-size:16px;'>".$_GET['success']."</p>";
}