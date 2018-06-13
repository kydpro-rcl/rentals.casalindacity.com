
<h1><a href="http://casalindacity.com/" alt="Go to our home page" title="Go to our home page"> <img src="images/logo.gif" alt="Residencial Casa Linda" border="0" /></a></h1>
 <? if ((!$_POST)||($_GET['error']['email'])){?>
	<p>Please type your email below to receive your password</p>
	<hr/>
	<p>&nbsp;</p>
	<form method="post" name="fogot_pass" action="forgot_pass.php" >
		<p class="center">Email <input type="text" name="email_forgot" value="<?=$_POST['email_forgot']?>">&nbsp;<input type="submit" class="book_but" name="send" value="send"/></p>
		<p id="error_s" class="center"><?=$_GET['error']['email'];?></p>
	</form>

 <?php
 }

	if ($_GET['notification']){
?>

      <hr/>
     <p><?=$_GET['notification'];?></p>

      <FORM>
		<p style="text-align:center"><INPUT class="book_but" TYPE='BUTTON' VALUE='Close' onClick='window.close()'><p>
		</FORM>
	<?}?>