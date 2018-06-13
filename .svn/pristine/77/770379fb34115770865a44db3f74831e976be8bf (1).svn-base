
<h1><a href="http://casalindacity.com/" alt="Go to our home page" title="Go to our home page"> <img src="images/logo.gif" alt="Residencial Casa Linda" border="0" /></a></h1>
 <? if ((!$_POST)||($_GET['e']['both'])){?>
	<p>Please type your email and password below to change your password</p>
	<hr/>
	<p>&nbsp;</p>

    <form method="post" action="change_pass.php">
	<fieldset id="fieldsets"><legend id="legends">Login to change password</legend>
	<p style="text-align:center">Email:<input type="text" name="mail" value="<?=$_POST['mail']?>" /> Password: <input type="password" name="pass" value="<?=$_POST['pass']?>"  /> <input type="submit" name="login" value="go" class="book_but" /> </p>
	<p style="text-align:center" id="error_s"><?=$_GET['e']['both']?></p>
	</fieldset>
	</form>

 <?php
 }

	if (($_GET['logueado'])){?>
		<h1 style="color:#F26C04; text-align:center;">Changing my Password</h1><hr/>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
			<form name="login" method="post" action="change_pass.php">
			 <!--<fieldset><legend>Loging in</legend>-->
			    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#f9a80b; border-width:thin;"><tr><td colspan="2" align="center"><strong>CHANGE PASSWORD</strong></td></tr><tr><td>

				Old Password:</td><td><input type="password" name="old_pass" value="<?=$_POST['old_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['old_pass']?></span></td></tr>
				<tr><td>New Password:</td><td><input type="password" name="n_pass" value="<?=$_POST['n_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['new_pass']?></span></td></tr>
			    <tr><td>Verify New Password:</td><td><input type="password" name="v_n_pass" value="<?=$_POST['v_n_pass']?>" /><br /><span id="error_s"><?=$_GET['error']['v_new_pass']?></span></td></tr>
				<tr><td colspan="2" align="right">
				<input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" name="cambiar" value="Change" /></td></tr></table><!--</fieldset>-->
			    <input type="hidden" name="client_id" value="<?=$_GET['logueado']?>"/>
			</form>
	<? }?>

  <?/* echo  $_GET['logueado']*/?>

<? if ($_GET['changed']){?>
	<hr/>
	<p><?=$_GET['changed'];?></p>
	<p>&nbsp;</p>
	<FORM>
		<p style="text-align:center"><INPUT class="book_but" TYPE='BUTTON' VALUE='Close' onClick='window.close()'><p>
	</FORM>
<?}?>
