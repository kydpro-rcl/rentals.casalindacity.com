 <div style="clear:both; height:300px; ">

  <script type="text/javascript">
				$(document).ready(function(name) {
				$("#forgotpass").fancybox({
						'width'				: '50%',
						'height'			: '50%',
						'autoScale'			: true,
						'transitionIn'		: 'elastic',
						'transitionOut'		: 'elastic',
						'type'				: 'iframe'
					});
				});
			</script>

<? if (!$_SESSION['owner']){?>
<?php

?>
<?php

?>
<!--//<h1 style="color:#F26C04; text-align:center;">Login for Referal Agents</h1><hr/>//-->

<p>&nbsp;</p>
<hr style="border:1px solid #f9a80b;" />
<h1 style="text-align:center; color:#0192c1;">&nbsp;</h1>
	<form name="login" method="post" action="login.php">
    <!--<fieldset><legend>Loging in</legend>-->
    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#000000; border-width:thin;" bgcolor="#28a4fb"><tr><td colspan="2" align="center" style="color:white;"><strong>LOGIN</strong></td></tr><tr><td style="color:white;">

	Username:</td><td><input type="text" name="user" value="<?=$_POST['user']?>" /></td></tr>
	<tr><td style="color:white;">Password:</td><td><input type="password" name="pass" value="<?=$_POST['pass']?>" /></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Login" /></td></tr></table><!--</fieldset>-->
	</form>
    <table align="center"><tr><td><!--//<img align="middle" src="images/login_icon.gif"  />//--></td></td></tr></table>
<a href="forgot_pass.php"  target="_blank" id="forgotpass"><p style="text-align:center; color:#28a4fb;">Did you forget your username and/or password?</p></a>
<?
 $_POST['pass']=trim($_POST['pass']); $_POST['user']=trim($_POST['user']);  //clear white spaces to inputs

	if($_POST['pass']!='' && $_POST['user']!=''){     //only if both input are not empty

	$coneccion=new subDB();

	   $owner_id=$coneccion->authenticateOwners($_POST['user'],$_POST['pass']);
        //echo $agent_id;

        #$agentinfo=$coneccion->referalDetails($agent_id);
			//$_SESSION['referal'] = $agentinfo;
			#print_r($agentinfo);

		if ($owner_id) {
			//$_SESSION['user_id']   = $user_id;
			//$_SESSION['time']     = time();
			$Ownerinfo=$coneccion->OwnerDetails($owner_id);
			$_SESSION['owner'] = $Ownerinfo;
			#print_r($agentinfo);
			echo("<meta http-equiv=\"refresh\" content=\"0;url=home.php\">");
			//echo $_SESSION['referal']['name'];
			//die();
		}else{
		//echo "<p style=\"color:red; padding-right:10px; text-align:center; font-weight:bold; \"><marquee behavior=\"alternate\" scrolldelay=\"250\" bgcolor=yellow style=\"padding-right:10px;\">Mismatch Email and/or Password</marquee></p>";

		echo "<p style=\"color:red; background-color:yellow; padding-right:10px; text-align:center; font-weight:bold; \">Mismatch Username and/or Password</p>";
		}
	}
}else{
//echo "Hi, ".$_SESSION['referal']['name']."<br>";
//echo "<a href=\"logout.php\">Do you wish Logout?</a><br>";
echo("<meta http-equiv=\"refresh\" content=\"0;url=home.php\">");
}
?>

</div>