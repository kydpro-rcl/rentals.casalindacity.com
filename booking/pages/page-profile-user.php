<? include('menu_CSS/menu-admin.php');?>
<? $user=$_SESSION['info'];?>
<h1 style="color:#F26C04; text-align:center;">Updating my profile</h1><hr/>
<p>&nbsp;</p>

	<form name="new_villa" method="post"  action="profile-user.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Name: <input class="input" type="text" name="name"  value="<?=$user['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields">Last Name: <input class="input" type="text" name="lastname"  value="<?=$user['lastname']?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$user['email']?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$user['phone']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>


</td>
<td >
<p id="fields" style="text-align:left;">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"> <?=$user['info']?> </textarea></p></td></tr>

<!--</fieldset>-->
<tr><td colspan="2"><p style="padding:5px 0px 5px 150px;"><input type="submit" name="update"  value="update" class="book_but" /></p></td></tr></table>
</form>
<hr />