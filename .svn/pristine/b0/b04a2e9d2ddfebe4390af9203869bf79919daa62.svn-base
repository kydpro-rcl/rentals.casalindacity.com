<?



?>
<p class="header">Create New Villa</p>
<hr />
<form name="new_villa" method="post"  action="new_villa.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<fieldset><legend>FEATURES</legend>
<p id="fields">Villa No.<input class="input" type="text" name="no"  value="<?=$_POST['no']?>" /></p>
<p id="fields">Villa Type: <input class="input" type="text" name="type"  value="<?=$_POST['type']?>" /></p>
<p id="fields">Square Meters: <input class="input" type="text" name="m2"  value="<?=$_POST['m2']?>" /></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
<p id="fields">Bedrooms: <input class="input" type="text" name="bed"  value="<?=$_POST['bed']?>" /></p>
<p id="fields">Aircontioners: <input class="input" type="text" name="AC"  value="<?=$_POST['AC']?>" /></p>
<p id="fields">Bathrooms: <input class="input" type="text" name="bath"  value="<?=$_POST['bath']?>" /></p>
<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
</fieldset></td>
<td>
<fieldset><legend>PRICES</legend>
<p id="fields">Low Season US$: <input class="input" type="text" name="p_low"  value="<?=$_POST['p_low']?>" /></p>
<p id="fields">High Season US$: <input class="input" type="text" name="p_high"  value="<?=$_POST['p_high']?>" /></p>
<p id="fields">Long Terms Low US$: <input class="input" type="text" name="p_long"  value="<?=$_POST['p_long']?>" /></p>
<p id="fields">Long Terms High US$: <input class="input" type="text" name="long_high"  value="<?=$_POST['long_high']?>" /></p>
<p id="fields">Sale Price US$: <input class="input" type="text" name="p_sale"  value="<?=$_POST['p_sale']?>" /></p>
<p id="fields">Clean inside nights US$: <input class="input" type="text" name="p_in_clear"  value="<?=$_POST['p_in_clear']?>" /></p>
<p id="fields">Clean outside nights US$: <input class="input" type="text" name="p_out_clear"  value="<?=$_POST['p_out_clear']?>" /></p>
</fieldset></td></tr><tr><td colspan="2">

<fieldset><legend>DETAILS</legend>
<table><tr><td>
<p id="fields">Features: <textarea class="input" name="head" cols="30"  style="max-width:300px;" rows="2"><?=$_POST['head']?></textarea></p>
<p id="fields">Description: <textarea class="input" name="desc" style="max-width:400px;" cols="50" rows="5"><?=$_POST['desc']?></textarea></p>
<p id="fields">Picture: <input class="input" type="text" name="pic" size="50" value="<?=$_POST['pic']?>" /></p></td><td>
<p id="fields">Available for Rent?: <select class="input" name="able_r" >
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</p>
<p id="fields">Available for Sale?: <select class="input" name="able_s" >
<option value="1">Yes</option>
<option value="0">No</option>

</select></p>
        <? $link = new getQueries; $owner=$link->owners();?>
<p id="fields">Villa Owner:<select name="owner" SIZE=1><? foreach ($owner as $o ) {     //$owner as $k => $v
							?><option value=<?=$o['id']?><? if ($post['owner'] == $o['id']) {echo " SELECTED";} ?>><?=$o['name']?><?
						} ?></select><!-- <br /><select class="input" name="owner" >
<option value="4">Xavier</option> -->
<!--<option value="0">Pedro</option>-->
</select></p></td></tr></table>
</fieldset>
<input type="submit" name="create"  value="Create villa" class="submit" />&nbsp;<input type="reset" name="clear"  value="Clean" class="submit" /></td></tr></table>
</form>
<hr />