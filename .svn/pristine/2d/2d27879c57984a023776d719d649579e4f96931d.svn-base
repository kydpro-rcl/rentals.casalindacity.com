<? include('menu_CSS/menu-admin.php');?>
<? $user=$_SESSION['info'];?>
<h1 style="color:#F26C04; text-align:center;">Changing my Password</h1><hr/>
<p>&nbsp;</p>
<p>&nbsp;</p>
	<form name="login" method="post" action="pass-user.php">
    <!--<fieldset><legend>Loging in</legend>-->
    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#f9a80b; border-width:thin;"><tr><td colspan="2" align="center"><strong>CHANGE PASSWORD</strong></td></tr><tr><td>

	Old Password:</td><td><input type="password" name="old_pass" value="<?=$_POST['old_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['old_pass']?></span></td></tr>
	<tr><td>New Password:</td><td><input type="password" name="n_pass" value="<?=$_POST['n_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['new_pass']?></span></td></tr>
    <tr><td>Verify New Password:</td><td><input type="password" name="v_n_pass" value="<?=$_POST['v_n_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['v_new_pass']?></span></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Change" /></td></tr></table><!--</fieldset>-->
	</form>