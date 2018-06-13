 <div style="clear:both; height:300px; ">



<? if (!$_SESSION['referal']){?>
<?php

?>
<?php

?>
<!--//<h1 style="color:#F26C04; text-align:center;">Login for Referal Agents</h1><hr/>//-->

<p>&nbsp;</p>

<h1 style="text-align:center; color:#0192c1;">Login to Referal Agent Portal (RAP)</h1>
	<form name="login" method="post" action="login.php">
    <!--<fieldset><legend>Loging in</legend>-->
    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#000000; border-width:thin;" bgcolor="#05a5d9"><tr><td colspan="2" align="center"><strong>LOGIN</strong></td></tr><tr><td>

	Email:</td><td><input type="text" name="email" value="<?=$_POST['email']?>" /></td></tr>
	<tr><td>Password:</td><td><input type="password" name="pass" value="<?=$_POST['pass']?>" /></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Login" /></td></tr></table><!--</fieldset>-->
	</form>
    <table align="center"><tr><td><!--//<img align="middle" src="images/login_icon.gif"  />//--></td></td></tr></table>
<a href="#" onclick="windowOpener('350','510','Fortgot_Password','forgot_password.php');"><p style="text-align:center;">Did you forget your password?</p></a>
<?
 $_POST['pass']=trim($_POST['pass']); $_POST['email']=trim($_POST['email']);  //clear white spaces to inputs

	if($_POST['pass']!='' && $_POST['email']!=''){     //only if both input are not empty

	$coneccion=new subDB();

	   $agent_id=$coneccion->authenticateReferal($_POST['email'],$_POST['pass']);
        //echo $agent_id;

        #$agentinfo=$coneccion->referalDetails($agent_id);
			//$_SESSION['referal'] = $agentinfo;
			#print_r($agentinfo);

		if ($agent_id) {
			//$_SESSION['user_id']   = $user_id;
			//$_SESSION['time']     = time();
			$agentinfo=$coneccion->referalDetails($agent_id);
			$_SESSION['referal'] = $agentinfo;
			#print_r($agentinfo);
			echo("<meta http-equiv=\"refresh\" content=\"0;url=home_overview.php\">");
			//echo $_SESSION['referal']['name'];
			//die();
		}else{
		//echo "<p style=\"color:red; padding-right:10px; text-align:center; font-weight:bold; \"><marquee behavior=\"alternate\" scrolldelay=\"250\" bgcolor=yellow style=\"padding-right:10px;\">Mismatch Email and/or Password</marquee></p>";

		echo "<p style=\"color:blue; background-color:white; padding-right:10px; text-align:center; font-weight:bold; \">Mismatch Email and/or Password</p>";
		}
	}
}else{
//echo "Hi, ".$_SESSION['referal']['name']."<br>";
//echo "<a href=\"logout.php\">Do you wish Logout?</a><br>";
echo("<meta http-equiv=\"refresh\" content=\"0;url=home_overview.php\">");
}
?>

</div>