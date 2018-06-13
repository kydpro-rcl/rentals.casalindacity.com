<?php
$data= new getQueries ();
$villas=$data->show_id('villas', $_GET['id']);
$v=$villas[0];
?>

<p class="header">Updating Villa</p>
<hr />
<form name="new_villa" method="post"  action="edit-villas-details.php" enctype="multipart/form-data" >
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<fieldset><legend>FEATURES</legend>
<p id="fields"><span id="error_s">*</span>Villa No.<input class="input" type="text" name="no"  value="<? if ($_POST['no']){ echo $_POST['no'];}else{ echo $v['no']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['no']?></span></p>
<p id="fields">Villa Type: <input class="input" type="text" name="type"  value="<? if ($_POST['type']){ echo $_POST['type'];}else{ echo $v['type']; } ?>" /></p>
<p id="fields"><span id="error_s">*</span>Square Meters: <input class="input" type="text" name="m2"  value="<? if ($_POST['m2']){ echo $_POST['m2'];}else{ echo $v['m2']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['size']?></span></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
<p id="fields"><span id="error_s">*</span>Bedrooms: <input class="input" type="text" name="bed"  value="<? if ($_POST['bed']){ echo $_POST['bed'];}else{ echo $v['bed']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['bed']?></span></p>
<p id="fields"><span id="error_s">*</span>Aircontioners: <input class="input" type="text" name="AC"  value="<? if ($_POST['AC']){ echo $_POST['AC'];}else{ echo $v['AC']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['ac']?></span></p>
<p id="fields"><span id="error_s">*</span>Bathrooms: <input class="input" type="text" name="bath"  value="<? if ($_POST['bath']){ echo $_POST['bath'];}else{ echo $v['bath']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['bath']?></span></p>
<p id="fields">Title: <textarea name="title" cols="35" rows="2"><? if ($_POST['title']){ echo $_POST['title'];}else{ echo $v['head']; } ?></textarea></p>
<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
</fieldset></td>
<td>
<fieldset><legend>PRICES</legend>
<p id="fields"><span id="error_s">*</span>Low Season US$: <input class="input" type="text" name="p_low"  value="<? if ($_POST['p_low']){ echo $_POST['p_low'];}else{ echo number_format($v['p_low'],2); } ?>" /><br /><span id="error_s"><?=$_GET['error']['pl']?></span></p>
<p id="fields"><span id="error_s">*</span>High Season US$: <input class="input" type="text" name="p_high"  value="<? if ($_POST['p_high']){ echo $_POST['p_high'];}else{ echo number_format($v['p_high'],2); } ?>" /><br /><span id="error_s"><?=$_GET['error']['ph']?></span></p>
<p id="fields" style="color: #06C;">Long Term Price US$: <input class="input" type="text" name="p_long"  value="<? if ($_POST['p_long']){ echo $_POST['p_long'];}else{ echo $v['p_long']; } ?>" /></p>
<p id="fields" style="color: #06C;">Maintenance service US$: <input class="input" type="text" name="maintenance"  value="<? if ($_POST['maintenance']){ echo $_POST['maintenance'];}else{ echo $v['maintenance']; } ?>" /></p>
<p id="fields" style="color: #06C;">Water service US$: <input class="input" type="text" name="water"  value="<? if ($_POST['water']){ echo $_POST['water'];}else{ echo $v['water_long']; } ?>" /></p>
<p id="fields" style="color: #06C;">Maid service US$: <input class="input" type="text" name="p_in_clear"  value="<? if ($_POST['p_in_clear']){ echo $_POST['p_in_clear'];}else{ echo $v['p_in_clear']; } ?>" /></p>
<p id="fields" style="color: #06C;">Garden and Pool US$: <input class="input" type="text" name="p_out_clear"  value="<? if ($_POST['p_out_clear']){ echo $_POST['p_out_clear'];}else{ echo $v['p_out_clear']; } ?>" /></p>
<p id="fields">Sale Price US$: <input class="input" type="text" name="p_sale"  value="<? if ($_POST['p_sale']){ echo $_POST['p_sale'];}else{ echo number_format($v['p_sale'],2); } ?>" /></p>
</fieldset></td></tr><tr><td colspan="2">

<fieldset><legend>DETAILS</legend>
<table><tr><td width="50%">

 <? $link = new getQueries; $owner=$link->owners();?>
<p id="fields">Villa Owner:
		 	<select name="owner" SIZE=1>
                          <option value="0" <? if ($v['id_owner'] == 0) {echo " SELECTED";} ?>><b>None</b></option>
						<? foreach ($owner as $o ) {     //$owner as $k => $v
							?>

                           <option value="<?=$o['id']?>" <? if ($v['id_owner'] == $o['id']) {echo " SELECTED";} ?>><? echo $o['name'].' '.$o['lastname']?></option>

					<?	} ?>

			</select>
</p>
<p id="fields">Picture:<input type="hidden" name="MAX_FILE_SIZE" value="500000"><!--500 KB-->
<input class="input" name="pic" type="file" value=""> <br /><span id="error_s"><?=$_GET['error']['pic']?></span><span style="color:#999"><?=$v['pic']?></span></p>

<p id="fields" style="color: #06C;">Referal wished? : <select class="input" name="wish_referal" >
	<option value="0" <? if ($v['wish_referal']==0){ echo 'selected="selected"'; }?>>Yes</option>
	<option value="1" <? if ($v['wish_referal']==1){ echo 'selected="selected"'; }?>>No</option>
</select></p>

</td><td >

<p id="fields">Available for Rent? : <select class="input" name="able_r" >
	<option value="1" <? if ($v['able_r']==1){ echo 'selected="selected"'; }?>>Yes</option>
	<option value="0" <? if ($v['able_r']==0){ echo 'selected="selected"'; }?>>No</option>
</select>
</p>
<p id="fields" style="color: #06C;">Available long term? : <select class="input" name="long_able" >
	<option value="0" <? if ($v['long_able']==0){ echo 'selected="selected"'; }?>>Yes</option>
	<option value="1" <? if ($v['long_able']==1){ echo 'selected="selected"'; }?>>No</option>
</select></p>

<p id="fields">Available for Monthly Rent? : <select class="input" name="able_s" >
<option value="1" <? if ($v['able_s']==1){ echo 'selected="selected"'; } ?>>No</option>
<option value="0" <? if ($v['able_s']==0){ echo 'selected="selected"'; } ?>>Yes</option>
</select></p>
<p id="fields">Classification: <select class="input" name="vclass" >
<!--<option value="1" <? if ($v['classification']==1){ echo 'selected="selected"'; } ?>>Budget</option>
<option value="0" <? if ($v['classification']==0){ echo 'selected="selected"'; } ?>>Normal</option>
<option value="2" <? if ($v['classification']==2){ echo 'selected="selected"'; } ?>>Premium</option>
<option value="3" <? if ($v['classification']==3){ echo 'selected="selected"'; } ?>>Superior</option>-->
<option value="1" <? if ($v['classification']==1){ echo 'selected="selected"'; } ?>>Premium</option>
<option value="2" <? if ($v['classification']==2){ echo 'selected="selected"'; } ?>>Deluxe</option>

</select></p>

<p id="fields">Online ?: <select class="input" name="vonline" >
<option value="1" <? if ($v['vonline']==1){ echo 'selected="selected"'; } ?>>NO</option>
<option value="0" <? if ($v['vonline']==0){ echo 'selected="selected"'; } ?>>Yes</option>
</select></p>
<p id="fields">At Referral?: <select class="input" name="vrap" >
<option value="1" <? if ($v['vrap']==1){ echo 'selected="selected"'; } ?>>NO</option>
<option value="0" <? if ($v['vrap']==0){ echo 'selected="selected"'; } ?>>Yes</option>
</select></p>

</td></tr></table>
</fieldset>
<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<input type="submit" name="update"  value="Update" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />