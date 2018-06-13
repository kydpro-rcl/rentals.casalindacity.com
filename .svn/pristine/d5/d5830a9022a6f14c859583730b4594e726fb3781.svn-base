<? include('menu_CSS/menu-admin.php');?>
<p class="header">Create New User</p>
<hr />
<form name="new_villa" method="post"  action="new-user.php">
<table border="0" align="center" width="700" cellpadding="2" cellspacing="0"> <tr><td width="50%">
<!--<fieldset><legend>FEATURES</legend>-->
<p id="fields">Name:<input class="input" type="text" name="name"  value="<?=$_POST['name']?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields">Last Name<input class="input" type="text" name="lastname"  value="<?=$_POST['lastname']?>" /><br /><span id="error_s"><?=$_GET['error']['lastname']?></span></p>
<p id="fields">E-mail: <input class="input" type="text" name="email"  value="<?=$_POST['email']?>" /><br /><span id="error_s"><?=$_GET['error']['email']?></span></p>
<p id="fields">Phone: <input class="input" type="text" name="phone"  value="<?=$_POST['phone']?>" /><br /><span id="error_s"><?=$_GET['error']['phone']?></span></p>


</td>
<td>
<p id="fields">Username: <input class="input" type="text" name="username"  value="<?=$_POST['username']?>" /><br /><span id="error_s"><?=$_GET['error']['user']?></span></p>
<p id="fields">Password: <input class="input" type="password" name="password"  value="<?=$_POST['password']?>" /><br /><span id="error_s"><?=$_GET['error']['pass']?></span></p>
<p id="fields">Level: <select class="input" name="level" ><!--only for admin empty for others-->
<!--<option value="1">Level 1</option>--><!--ESTA OPTION DEBE APARECER COMENTADA-->
<option value="2" selected="selected">Level 2</option>
<option value="3">Level 3</option>
<option value="4">Level 4</option>
<option value="5">Level 5</option>
<option value="6">Tickets</option>
</select></p>
<p id="fields">Active:<select name="active" class="input" >
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</p>
<p id="fields">
Receive Tickets:
<select name="report" class="input" >
<?php
	$options=departments();
	foreach($options as $k=>$v){
		echo "<option value=\"$k\">$v</option>";
	}
?>
</select>
</p>
<p id="fields">Receive Email:<select name="noemails" class="input" >
	<option value="0" <? if ($u['noemails']==0) echo 'Selected=\"selected\"';?> >Yes</option>
	<option value="1" <? if ($u['noemails']==1) echo 'Selected=\"selected\"';?> >No</option>
	</select>
	</p>
</td></tr><tr><td colspan="2">
<p id="fields">Aditional Info: <textarea class="input" name="info" style="max-width:400px;" cols="50" rows="5"> <?=$_POST['info']?> </textarea></p>

<!--</fieldset>-->
<input type="submit" name="new"  value="Create" class="book_but" />&nbsp;<input type="reset" name="clear"  value="Clean" class="book_but" /></td></tr></table>
</form>
<hr />
