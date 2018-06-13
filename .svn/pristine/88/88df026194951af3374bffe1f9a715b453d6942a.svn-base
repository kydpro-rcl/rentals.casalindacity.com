<? if (!$_SESSION['info']){?>
<?php

?>
<?php

?> .
 <p>&nbsp;</p>
<!--//<h1 style="color:#F26C04; text-align:center;">Log in to access our Booking System</h1>//--><hr/>

<p>&nbsp;</p>
	<form name="login" method="post" action="login.php">
    <!--<fieldset><legend>Loging in</legend>-->
    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#f9a80b; border-width:thin;"><tr><td colspan="2" align="center"><strong>LOGIN</strong></td></tr><tr><td>

	Username:</td><td><input type="text" name="user" value="<?=$_POST['user']?>" /></td></tr>
	<tr><td>Password:</td><td><input type="password" name="pass" value="<?=$_POST['pass']?>" /></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Login" /></td></tr></table><!--</fieldset>-->
	</form>
   <!--// <table align="center"><tr><td><img align="middle" src="images/login_icon.gif"  /></td></td></tr></table>//-->

	<?
    $_POST['pass']=trim($_POST['pass']); $_POST['user']=trim($_POST['user']);  //clear white spaces to inputs

	if($_POST['pass']!='' && $_POST['user']!=''){     //only if both input are not empty
	//require_once('booking/init.php');


	$coneccion=new subDB;
	//$user_id=$coneccion->checkUser($_POST['user'],$_POST['pass']);
	 // if (($_POST['user']) && ($_POST['pass'])){
	   $user_id=$coneccion->authenticateUser($_POST['user'],$_POST['pass']);
		//} else{
		//$user_id=$_SESSION['info']['id'];
		if ($user_id) {

			//if (!$_SESSION['info'])
			//{
			$_SESSION['user_id']   = $user_id;
			$_SESSION['time']     = time();
			//}
			//foreach ($user_id as $k)
			//echo $k['id']."<br/>";
			#echo $user_id."<br/>";
			//if (!$_SESSION['info']){
			$userinfo=$coneccion->userDetails($user_id);
			$_SESSION['info'] = $userinfo;
			//$_SESSION['consultas']=new getQueries;
			//$_SESSION['subDB']=new subDB;
		//	}
			#echo $_SESSION['info']['user']." usuario<br>";
		//	if (($_POST['user']) && ($_POST['pass'])){
			#echo "Hello, <strong>".$userinfo['name']." ".$userinfo['lastname']."</strong> Welcome<br/>"; // }else{
		//	echo "<strong>".$_SESSION['info']['name']."</strong> Gracias por estar devuelta.<br/>";
			//	}
			//echo "<a href=\"booking/index_calendar.php\">Booking</a><br>";
			//echo "<a href=\"#\">Booking</a><br>"; //ONCLICK PROPERTY FOR LINKS
			#echo "<a href=\"index.htm\">Booking</a><br>";
			#echo "<a href=\"logout.php\">Logout</a>";
			echo("<meta http-equiv=\"refresh\" content=\"0;url=index.php\">");
			#echo $_POST['user']." ".$_POST['pass'];

		}else{
		echo "<h2 style=\"color:red; text-align:center;\">Unknown User or Password</h2>";
		}
	 // }
	//echo "Hola";
	}
}else{
echo("<meta http-equiv=\"refresh\" content=\"0;url=index.php\">");
//infoecho "Hi, ".$_SESSION['info']['name']."<br>";
//echo "<a href=\"logout.php\">Do you wish Logout?</a><br>";
//echo "<a href=\"booking/index_calendar.php\">Booking</a><br>";
//echo "<a href=\"index.htm\">Booking</a><br>";
}
?>