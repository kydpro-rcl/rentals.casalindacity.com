<?



?>
<p class="header">Create New User</p>
<hr />
<form name="new_villa" method="post"  action="users.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" /></p>
<p id="fields">Last name: <input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" /></p>
<p id="fields">Fax: <input class="input" type="text" name="fax"  value="<?=$_POST['fax']?>" /></p>
<!-- <input class="input" type="hidden" name="ft2"  value="" />-->
<p id="fields">Zip: <input class="input" type="text" name="zip"  value="<?=$_POST['zip']?>" /></p>
<p id="fields">Adrres: <input class="input" type="text" name="address"  value="<?=$_POST['address']?>" /></p>
<p id="fields">Country: <input class="input" type="text" name="country"  value="<?=$_POST['country']?>" /></p>
<!-- <input class="input" type="hidden" name="capacity"  value="" />-->
<!--</fieldset>--></td>
<td>
<!--<fieldset><legend>PRICES</legend>-->
<p id="fields">Type: <select class="input" name="type" ><!--only for admin empty for others-->
<option value="1">Admin</option>
<option value="2">Reservations admin</option>
<option value="3">Reserve makers</option>
<option value="4">Owners</option>
<option value="5">Customers</option>
</select></p>
<? /*conectar a base de datos para extraer los id de los intermediarios*/?>
<p id="fields">Intermediario: <select class="input" name="intermediario" ><!--only for admin empty for others-->
<option value="0">------------</option>
<option value="1">Agencia Pueblo</option>
</select></p>
<p id="fields">User Name: <input class="input" type="text" name="username"  value="<?=$_POST['username']?>" /></p>
<p id="fields">Password: <input class="input" type="password" name="password"  value="<?=$_POST['password']?>" /></p>
<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" /></p>
<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" /></p>
<p id="fields">Photo: <input class="input" type="text" name="photo" size="35" value="<?=$_POST['photo']?>" /></p><!--only for admin empty for others-->

<!--</fieldset>--></td></tr><tr><td colspan="2">

<!--<fieldset><legend>DETAILS</legend>-->

<p id="fields">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"><?=$_POST['info']?></textarea></p>

<!--</fieldset>-->
<input type="submit" name="new"  value="Create User" class="submit" />&nbsp;<input type="reset" name="clear"  value="Clean" class="submit" /></td></tr></table>
</form>
<hr />