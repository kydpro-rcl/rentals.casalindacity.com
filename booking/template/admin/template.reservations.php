<?



?>
<p class="header">Create New Reservation</p>
<hr />
<form name="new_villa" method="post"  action="new_villa.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Vila No: <select class="input" name="type" >
<option value="1">1</option>
<option value="2">2</option>
<option value="3">10</option>
<option value="4">15</option>
<option value="5">30</option>
</select></p>
<p id="fields">Customer:<input class="input" type="text" name="id_user"  value="<?=$_POST['no']?>" /></p>
<p id="fields">Last name: <input class="input" type="text" name="lastname"  value="<?=$_POST['type']?>" /></p>
<p id="fields">From date: <input class="input" type="text" name="m2"  value="<?=$_POST['m2']?>" /></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
<p id="fields">To date: <input class="input" type="text" name="zip"  value="<?=$_POST['bed']?>" /></p>
<p id="fields">Adrres: <input class="input" type="text" name="address"  value="<?=$_POST['AC']?>" /></p>
<p id="fields">Country: <input class="input" type="text" name="country"  value="<?=$_POST['bath']?>" /></p>
<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
<!--</fieldset>--></td>
<td>
<!--<fieldset><legend>PRICES</legend>-->

<p id="fields">User Name: <input class="input" type="text" name="username"  value="<?=$_POST['p_low']?>" /></p>
<p id="fields">Password: <input class="input" type="password" name="password"  value="<?=$_POST['p_high']?>" /></p>
<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['p_long']?>" /></p>
<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['p_sale']?>" /></p>
<p id="fields">Photo: <input class="input" type="text" name="photo" size="35" value="<?=$_POST['p_in_clear']?>" /></p>

<!--</fieldset>--></td></tr><tr><td colspan="2">

<!--<fieldset><legend>DETAILS</legend>-->

<p id="fields">Comment: <textarea class="input" name="comment" style="max-width:400px;" cols="50" rows="5"><?=$_POST['head']?></textarea></p>

<!--</fieldset>-->
<input type="submit" name="new"  value="Create" class="submit" />&nbsp;<input type="reset" name="clear"  value="Clean" class="submit" /></td></tr></table>
</form>
<hr />