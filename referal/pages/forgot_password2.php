	<?
	$data= new getQueries ();
	$interm=$data->show_id('commission', $_SESSION['referal']['id']);
	$it=$interm[0];
	// $link= new getQueries();
	$detalles_anterior=$data->show_any_data_limit1('referral_details', 'referral', $it['id'], '=');
	$det=$detalles_anterior[0];
	?>

   <img src="images/new-casa-linda-logo.gif" />
	<p class="header" style="clear:both;">New Password</p>
    <hr/>

    <? if ($_GET['success']!="close"){?>
	<form name="new_villa" method="post"  action="forgot_password2.php">

	<p id="fields" style="text-align:right">New Password:<input class="input" type="password" name="new_pass"  value="<? if ($_POST['name']){ echo $_POST['name']; }else{ echo $it['name']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>
<p id="fields" style="text-align:right">Confirm New Password:<input class="input" type="password" name="confirm"  value="<? if ($_POST['name']){ echo $_POST['name']; }else{ echo $it['name']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>


	<p style="text-align:right"><input type="submit" name="update"  value="change" class="book_but" /></p>
     <p style="color:red;"><?=$_GET['error']['psd'];?></p>
	</form>
	<hr />
	<?}else{ ?>      <h1>Password Sucessfully Changed</h1>
      <p><a href="#" onclick="window.close()" >Click here to Close this Window</a></p>	<?} ?>