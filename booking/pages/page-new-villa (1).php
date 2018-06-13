<p class="header">Create New Villa</p>
<hr />
<form name="new_villa" method="post"  action="new-villa.php" enctype="multipart/form-data" >
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<fieldset><legend>FEATURES</legend>
<p id="fields"><span id="error_s">*</span>Villa No.<input class="input" type="text" name="no"  value="<?=$_POST['no']?>" /><br /><span id="error_s"><?=$_GET['error']['no']?></span></p>
<p id="fields">Villa Type: <input class="input" type="text" name="type"  value="<?=$_POST['type']?>" /></p>
<p id="fields"><span id="error_s">*</span>Square Meters: <input class="input" type="text" name="m2"  value="<?=$_POST['m2']?>" /><br /><span id="error_s"><?=$_GET['error']['size']?></span></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
<p id="fields"><span id="error_s">*</span>Bedrooms: <input class="input" type="text" name="bed"  value="<?=$_POST['bed']?>" /><br /><span id="error_s"><?=$_GET['error']['bed']?></span></p>
<p id="fields"><span id="error_s">*</span>Aircontioners: <input class="input" type="text" name="AC"  value="<?=$_POST['AC']?>" /><br /><span id="error_s"><?=$_GET['error']['ac']?></span></p>
<p id="fields"><span id="error_s">*</span>Bathrooms: <input class="input" type="text" name="bath"  value="<?=$_POST['bath']?>" /><br /><span id="error_s"><?=$_GET['error']['bath']?></span></p>
<p id="fields">Title: <textarea name="title" cols="35" rows="2"><?=$_POST['title']?></textarea></p>
<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
</fieldset></td>
<td>
<fieldset><legend>PRICES</legend>
<p id="fields"><span id="error_s">*</span>Low Season US$: <input class="input" type="text" name="p_low"  value="<?=$_POST['p_low']?>" /><br /><span id="error_s"><?=$_GET['error']['pl']?></span></p>
<p id="fields"><span id="error_s">*</span>High Season US$: <input class="input" type="text" name="p_high"  value="<?=$_POST['p_high']?>" /><br /><span id="error_s"><?=$_GET['error']['ph']?></span></p>

<p id="fields" style="color: #06C;">Long Term Price US$: <input class="input" type="text" name="p_long"  value="<?=$_POST['p_long']?>" /></p>
<p id="fields" style="color: #06C;">Maintenance service US$: <input class="input" type="text" name="maintenance"  value="<?=$_POST['maintenance']?>" /></p>
<p id="fields" style="color: #06C;">Water service US$: <input class="input" type="text" name="water"  value="<?=$_POST['water']?>" /></p>

<p id="fields" style="color: #06C;">Maid service US$: <input class="input" type="text" name="p_in_clear"  value="<? if ($_POST['p_in_clear']){ echo $_POST['p_in_clear'];}else{ echo $v['p_in_clear']; } ?>" /></p>
<p id="fields" style="color: #06C;">Garden and Pool US$: <input class="input" type="text" name="p_out_clear"  value="<? if ($_POST['p_out_clear']){ echo $_POST['p_out_clear'];}else{ echo $v['p_out_clear']; } ?>" /></p>
<p id="fields">Sale Price US$: <input class="input" type="text" name="p_sale"  value="<?=$_POST['p_sale']?>" /></p>
</fieldset></td></tr><tr><td colspan="2">

<fieldset><legend>DETAILS</legend>
<table><tr><td width="50%">
<!--<p id="fields">Features: <textarea class="input" name="head" cols="30"  style="max-width:300px;" rows="2"><?/*=$_POST['head']*/?></textarea></p>
<p id="fields">Description: <textarea class="input" name="desc" style="max-width:400px;" cols="50" rows="5"><?/*=$_POST['desc']*/?></textarea></p>-->

<? $link = new getQueries; $owner=$link->owners();?>
<p id="fields">Villa Owner:
	<select name="owner" SIZE=1>
    	 <option value="0" <? if ($_POST['owner']==0) {echo " SELECTED";} ?>><b>None</b></option>
		<? foreach ($owner as $o ) {     //$owner as $k => $v
			?>
         <option value=<?=$o['id']?><? if ($post['owner'] == $o['id']) {echo " SELECTED";} ?>><? echo $o['name'].' '.$o['lastname']?></option>
		<?	} ?>
	</select>
</p>

<p id="fields">Picture:<input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<input class="input" name="pic" type="file" value=""> <br /><span id="error_s"><?=$_GET['error']['pic']?></span></p>
<p id="fields" style="color: #06C;">Referal wished?: <select class="input" name="wish_referal" >
	<option value="0">Yes</option>
	<option value="1" selected="selected">No</option>
</select></p>
</td><td>

<p id="fields">Available for Rent?: <select class="input" name="able_r" >
	<option value="1">Yes</option>
	<option value="0" selected="selected">No</option>
</select>
</p>
<p id="fields" style="color: #06C;">Available long term?: <select class="input" name="long_able" >
	<option value="0">Yes</option>
	<option value="1" selected="selected">No</option>
</select></p>

<p id="fields">Available for Monthly Rent?: <select class="input" name="able_s" >
<option value="0">Yes</option>
<option value="1" selected="selected">No</option>
</select></p>

<p id="fields">Classification: <select class="input" name="vclass" >
<!--<option value="1">Budget</option>
<option value="0" selected="selected">Normal</option>
<option value="2">Premium</option>
<option value="3">Superior</option>-->
<option value="1">Premium</option>
<option value="2">Deluxe</option>
</select></p>

<p id="fields">Online ?: <select class="input" name="vonline" >
<option value="1">NO</option>
<option value="0">Yes</option>
</select></p>
<p id="fields">At Referral?: <select class="input" name="vrap" >
<option value="1">NO</option>
<option value="0">Yes</option>
</select></p>

</td></tr></table>
</fieldset>
<input type="submit" name="create"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />