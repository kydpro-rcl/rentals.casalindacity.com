	<?
	$data= new getQueries ();
	$interm=$data->show_id('commission', $_SESSION['referal']['id']);
	$it=$interm[0];
	// $link= new getQueries();
	$detalles_anterior=$data->show_any_data_limit1('referral_details', 'referral', $it['id'], '=');
	$det=$detalles_anterior[0];
	?>

   <img src="images/new-casa-linda-logo.gif" />
	<p class="header" style="clear:both;">I forgot my password</p>
    <hr/>
	<form name="new_villa" method="post"  action="forgot_password.php">

	<p id="fields" style="text-align:left;">Email:<input class="input" type="text" name="email"  value="<? if ($_POST['email']){ echo $_POST['email']; } ?>" /><br /><span id="error_s"><?=$_GET['error']['name']?></span></p>


	<p style="text-align:left;"><input type="submit" name="update"  value="Continue" class="book_but" /></p>

	</form>
	<p style="color:red; text-align:center;"><?=$_GET['error']['email'];?></p>
	<hr />