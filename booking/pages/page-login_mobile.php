<? if (!$_SESSION['info']){?>
<?php

?> .
 <p>&nbsp;</p>
<!--//<h1 style="color:#F26C04; text-align:center;">Log in to access our Booking System</h1>//--><hr/>

<p>&nbsp;</p>
	<form name="login" method="post" action="login_mobile.php">
    <!--<fieldset><legend>Loging in</legend>-->
    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#f9a80b; border-width:thin;"><tr><td colspan="2" align="center"><strong>LOGIN</strong></td></tr><tr><td>

	Username:</td><td><input type="text" name="user" value="<?=$_POST['user']?>" /></td></tr>
	<tr><td>Password:</td><td><input type="password" name="pass" value="<?=$_POST['pass']?>" /></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 #004879; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Login" /></td></tr></table><!--</fieldset>-->
	</form>
    <table align="center"><tr><td><img align="middle" src="images/login_icon.gif"  /></td></td></tr></table>

	<?

	//echo $numero=strtoupper(uniqid());// numero de session

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
			$_SESSION['user_id']= $user_id;

			//}
			//foreach ($user_id as $k)
			//echo $k['id']."<br/>";
			#echo $user_id."<br/>";
			//if (!$_SESSION['info']){
			$userinfo=$coneccion->userDetails($user_id);
			$_SESSION['info'] = $userinfo;

			//--------------GUARDAR LA SESSION DE LOGIN DE ESTE USUARIO----------------------------
				$db=new DB;
				$_SESSION['log']['id_session']=strtoupper(uniqid());
                 $db->insert_user_access($user_id=$_SESSION['info']['id'], $date_time=date("Y-m-d G:i:s"), $in_out='1', $session=$_SESSION['log']['id_session'], $ip=$_SERVER['REMOTE_ADDR']);
			//-----------------------------------------------------------------------------------
			if ($_SESSION['info']['level']<=5){ 
				echo("<meta http-equiv=\"refresh\" content=\"0;url=emaint_mobile.php\">");
				#echo $_POST['user']." ".$_POST['pass'];
			}else{
				echo("<meta http-equiv=\"refresh\" content=\"0;url=reported.php\">");
			}
		}else{
		echo "<h2 style=\"color:red; text-align:center;\">Unknown User or Password</h2>";
		}
	 // }
	//echo "Hola";
	}
}else{
echo "Hi, ".$_SESSION['info']['name']."<br>";
echo "<a href=\"logout.php\">Do you wish Logout?</a><br>";

}
?>