<? if (!$_SESSION['rqc']){?>
<div class="art-box-body art-post-body">

 <p>&nbsp;</p>
 <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
	<form name="login" method="post" action="login.php">

    <table align="center" cellpadding="2" cellspacing="2" style="border-style:solid; border-color:#f9a80b; border-width:thin;"><tr><td colspan="2" align="center"><strong>LOGIN</strong></td></tr><tr><td>

	Username:</td><td><input type="text" name="user" value="<?=$_POST['user']?>
<?php

?>
<?php

?>" /></td></tr>
	<tr><td>Password:</td><td><input type="password" name="pass" value="<?=$_POST['pass']?>" /></td></tr>
	<tr><td colspan="2" align="right"><input style="background:none repeat scroll 0 0 green; border:1px solid #f9a80b; color:#FFFFFF;" type="submit" value="Login" /></td></tr></table>
	</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
 <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

	<?
	//echo $numero=strtoupper(uniqid());// numero de session
    $_POST['pass']=trim($_POST['pass']); $_POST['user']=trim($_POST['user']);  //clear white spaces to inputs

	if($_POST['pass']!='' && $_POST['user']!=''){     //only if both input are not empty
	$coneccion=new Consultas();
	   $user_id=$coneccion->checkUser($_POST['user'],$_POST['pass']);
		if ($user_id) {
			$_SESSION['user_id']= $user_id;
			$userinfo=$coneccion->getUserDetails($user_id);
			$_SESSION['rqc'] = $userinfo;

			//--------------GUARDAR LA SESSION DE LOGIN DE ESTE USUARIO----------------------------
				#$db=new DB;
				#$_SESSION['log']['id_session']=strtoupper(uniqid());
                 #$db->insert_user_access($user_id=$_SESSION['info']['id'], $date_time=date("Y-m-d G:i:s"), $in_out='1', $session=$_SESSION['log']['id_session'], $ip=$_SERVER['REMOTE_ADDR']);
			//-----------------------------------------------------------------------------------
			echo("<meta http-equiv=\"refresh\" content=\"0;url=index.php\">");
		}else{
		echo "<h2 style=\"color:red; text-align:center;\">Unknown Username or Password</h2>";
		}
	}
}else{

echo("<meta http-equiv=\"refresh\" content=\"0;url=index.php\">");


}
?>

</div>