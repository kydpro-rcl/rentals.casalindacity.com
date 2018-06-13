<script language="javascript">
function windowOpener(windowHeight, windowWidth, windowName, windowUri)
{
    var centerWidth = (window.screen.width - windowWidth) / 2;
    var centerHeight = (window.screen.height - windowHeight) / 2;

    newWindow = window.open(windowUri, windowName, 'resizable=yes, scrollbars=yes, toolbar=no,location=false, directories=no, status=no, menubar=no,width=' + windowWidth +
        ',height=' + windowHeight +
        ',left=' + centerWidth +
        ',top=' + centerHeight);

    newWindow.focus();
    return newWindow.name;
}

function open_booking()
{
windowOpener(665,856,'Booking','http://sosuacasa.com/rentestate.asp');
}
</script>

 <? if (!$_SESSION['cust_online']){
	if($_GET['em']){$_POST['mail']=$_GET['em'];}
	?>
<?php

?>
<?php

?>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<h3 style="text-align:center; text-transform:uppercase;">Login to online customers</h3>
	<p>&nbsp;</p>
<form method="post" action="login.php" >
 <table align="center" style="border:1px solid red;"><tr><td>

  <? if($_GET['e']['both']){?>
      <p style="text-align:center" id="error_s"><?=$_GET['e']['both']?></p>
  <?}?>

	<p style="text-align:right; color:#9c0000;">
		Email:<input type="text" name="mail" value="<?=$_POST['mail']?>"  size="20px" style="width:170px;"/>
		<input type="hidden" name="book" value="<?=$_GET['bk']?>"/>
	</p>

    <p style="text-align:right; color:#9c0000;">
		 Password: <input type="password" name="pass" value="<?=$_POST['pass']?>"  size="20px" style="width:170px;" />

	</p>

      <p style="text-align:right; color:#9c0000;">
     	<input type="submit" name="login" value="Login" class="boton" />
     </p>

	 <p style="text-align:center; color:#9c0000;">
		 <a style="color:#0089b7; font-size:10px; text-decoration:none;text-transform:uppercase;" href="JavaScript:void(0);" onclick="windowOpener('350','500','Fogotten_Password','forgot_pass.php');" alt="" ><b>Forgot your password?</b></a> /
		<a style="color:#0089b7; font-size:10px; text-decoration:none;text-transform:uppercase;" href="JavaScript:void(0);" onclick="windowOpener('350','500','Fogotten_Password','change_pass.php');" alt="" ><b>Change your password</b></a>
	</p>



  </td></tr></table>
</form>
 <?}/*else{?>
    <meta http-equiv="refresh" content="0;url=excursions.php">
    <a href="excursions.php">Continue with this booking</a>
 <?}*/?>
